<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use App\Models\Certificate;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;
class CertificateController extends Controller

{
   
    public function index()
    {
       
        return view('form');
    }

public function preview(Request $request, string $trainer_id = null)
{
    $paramTrainerId = $trainer_id ?: $request->query('trainer_id');
    if ($paramTrainerId) {
        $cert = Certificate::where('trainer_id', $paramTrainerId)->first();

       
        if (!$cert) {
            return view('no-certificate', ['message' => 'No Certificate Found for this ID.']);
        }

        $maskedAadhar = $cert->aadhar
            ? (str_repeat('X', max(0, strlen($cert->aadhar) - 4)) . substr($cert->aadhar, -4))
            : null;

        $payload = [
            'id' => $cert->id,
            'name' => $cert->name,
            'trainer_id' => $cert->trainer_id,
            'trainerId' => $cert->trainer_id,
            'qp_code' => $cert->qp_code,
            'qpCode' => $cert->qp_code,
            'aadhar' => $maskedAadhar,
            'grade' => $cert->grade,
            'issue_date' => ($cert->issue_date),
            'qrRef' => $cert->qr_ref,
            'qrCodePath' => $cert->qr_code_path,
        ];

        return view('Show', $payload);
    }

    $validated = $request->validate([
        'name' => ['required', 'string', 'max:120'],
        'trainer_id' => ['required', 'string', 'max:30'],
        'aadhar' => ['required', 'regex:/^\d{12}$/'],
        'grade' => ['required', 'string', 'max:10'],
        'issue_date' => ['required', 'date','before_or_equal:today'],
    ]);

    
    $validated['qp_code'] = 'Q' . random_int(1000, 9999);

   
    $cert = $this->createCertificate($validated);

    return redirect()->route('certificate.show', ['trainer_id' => $cert->trainer_id]);
}

    public function store(Request $request)
  {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:120'],
        'aadhar' => ['required', 'regex:/^\d{12}$/'],
        'trainer_id' => ['required', 'string', 'max:30'],
        'grade' => ['required', 'string', 'max:10'],
        'issue_date' => ['required', 'date'],
    ]);

  

$aadharExists = Certificate::where('aadhar', $validated['aadhar'])->exists();

$trainerExists = Certificate::where('trainer_id', $validated['trainer_id'])->exists();

if ($aadharExists || $trainerExists) {
    $errors = [];

    if ($aadharExists) {
        $errors['aadhar'] = 'Aadhaar number already exists.';
    }

    if ($trainerExists) {
        $errors['trainer_id'] = 'Trainer ID already exists.';
    }

    return back()->withErrors($errors)->withInput();
}


        $validated['qp_code'] = 'Q' . random_int(1000, 9999);

        $cert = $this->createCertificate($validated);

        if (class_exists(\Barryvdh\DomPDF\Facade\Pdf::class)) {
            try { @ini_set('memory_limit', '512M'); } catch (\Throwable $e) {}
            try { @ini_set('max_execution_time', '120'); } catch (\Throwable $e) {}

            $payload = [
                'isPdf' => true,
                'name' => $cert->name,
                'trainer_id' => $cert->trainer_id,
                'trainerId' => $cert->trainer_id,
                'qp_code' => $cert->qp_code,
                'qpCode' => $cert->qp_code,
                'aadhar' => $cert->aadhar
                    ? (str_repeat('X', max(0, strlen($cert->aadhar) - 4)) . substr($cert->aadhar, -4))
                    : null,
                'grade' => $cert->grade,
                'issue_date' => ($cert->issue_date),
                'qrRef' => $cert->qr_ref,
                'qrCodePath' => $cert->qr_code_path,
            ];

            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('Show', $payload)->setPaper('a4', 'landscape');

            try {
                $pdf->setOptions([
                    'isRemoteEnabled' => true,
                    'isHtml5ParserEnabled' => true,
                    'chroot' => public_path(),
                    'dpi' => 96,
                    'defaultFont' => 'DejaVu Sans',
                ]);
            } catch (\Throwable $e) {}

            $bytes = $pdf->output();

            try {
                $dir = public_path('certificates');
                if (!is_dir($dir)) {
                    @mkdir($dir, 0775, true);
                }
                $storedRelative = 'certificates/cert_' . $cert->id . '.pdf';
                @file_put_contents(public_path($storedRelative), $bytes);
                $cert->certificate_image_path = $storedRelative;
                $cert->save();
            } catch (\Throwable $e) {
                // ignore
            }

            $status = 'Certificate saved and PDF stored.';
        } else {
            $status = 'Certificate saved. Install DomPDF to enable PDF generation: composer require barryvdh/laravel-dompdf';
        }

        return redirect()->route('certificate.show', ['trainer_id' => $cert->trainer_id])
            ->with('status', $status);
    }

   private function createCertificate(array $validated): Certificate
{
    if (empty($validated['qr_ref'])) {
        $randA = str_pad((string)random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
        $randB = str_pad((string)random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
        $qp = strtoupper($validated['qp_code'] ?? '');
        $trainer = $validated['trainer_id'] ?? 'TR000000';
        $validated['qr_ref'] = "TOT/SSC/{$qp}V5.0/{$randA}/{$trainer}/{$randB}";
    }

    $cert = Certificate::create($validated);

    try {
        $verifyUrl = route('certificate.verify', ['trainer_id' => $cert->trainer_id], true);
        $qrUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=' . urlencode($verifyUrl);
        $img = @file_get_contents($qrUrl);

        if ($img !== false) {
            $qrDir = public_path('qr');
            if (!is_dir($qrDir)) {
                @mkdir($qrDir, 0775, true);
            }
            $qrPath = 'qr/qr_' . $cert->id . '.png';
            file_put_contents(public_path($qrPath), $img);
            $cert->qr_code_path = $qrPath;
            $cert->save();
        }
    } catch (\Throwable $e) {
        // ignore
    }

    return $cert;
}


public function verify($trainer_id)
{
    $cert = Certificate::where('trainer_id', $trainer_id)->first();

    if (!$cert) {
        return view('no-certificate', ['message' => 'Certificate not found.']);
    }

    return view('verify', ['cert' => $cert]);
}

public function bulkUpload(Request $request)
{
    $request->validate([
        'excel_file' => 'required|file|mimes:xlsx,xls',
    ]);

    $path = $request->file('excel_file')->getRealPath();
    $data = \PhpOffice\PhpSpreadsheet\IOFactory::load($path)->getActiveSheet()->toArray(null, true, true, true);

    $certificates = [];
    $errors = [];

    foreach (array_slice($data, 1) as $rowIndex => $row) {
        try {
            $rawDate = $row['E'] ?? null;
            if (!$rawDate) continue;

            if (is_numeric($rawDate)) {
                $issueDate = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($rawDate)->format('Y-m-d');
            } else {
                $issueDate = date('Y-m-d', strtotime(str_replace('/', '-', $rawDate)));
            }

            $validated = [
                'name' => trim($row['A'] ?? ''),
                'trainer_id' => trim($row['B'] ?? ''),
                'aadhar' => trim($row['C'] ?? ''),
                'grade' => trim($row['D'] ?? ''),
                'issue_date' => $issueDate,
                'qp_code' => 'Q' . random_int(1000, 9999),
            ];

            if (
                empty($validated['name']) ||
                empty($validated['trainer_id']) ||
                empty($validated['aadhar']) ||
                empty($validated['grade'])
            ) {
                $errors[] = "Row {$rowIndex}: Missing fields.";
                continue;
            }

            if (Certificate::where('trainer_id', $validated['trainer_id'])->exists()) {
                $errors[] = "Row {$rowIndex}: Trainer ID exists.";
                continue;
            }

            if (Certificate::where('aadhar', $validated['aadhar'])->exists()) {
                $errors[] = "Row {$rowIndex}: Aadhaar exists.";
                continue;
            }


            $cert = $this->createCertificate($validated);

            $payload = [
                'isPdf' => true,
                'name' => $cert->name,
                'trainer_id' => $cert->trainer_id,
                'trainerId' => $cert->trainer_id,
                'qp_code' => $cert->qp_code,
                'qpCode' => $cert->qp_code,
                'aadhar' => $cert->aadhar
                    ? (str_repeat('X', max(0, strlen($cert->aadhar) - 4)) . substr($cert->aadhar, -4))
                    : null,
                'grade' => $cert->grade,
                'issue_date' => $cert->issue_date,
                'qrRef' => $cert->qr_ref,
                'qrCodePath' => $cert->qr_code_path,
            ];

            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('Show', $payload)->setPaper('a4', 'landscape');

            $pdfPath = 'certificates/cert_' . $cert->id . '.pdf';
            $fullPath = public_path($pdfPath);

            if (!is_dir(public_path('certificates'))) {
                @mkdir(public_path('certificates'), 0775, true);
            }

            file_put_contents($fullPath, $pdf->output());
            $cert->certificate_image_path = $pdfPath;
            $cert->save();
            $certificates[] = $cert;

        } catch (\Throwable $e) {
            $errors[] = "Row {$rowIndex}: " . $e->getMessage();
        }
    }

    if (empty($certificates)) {
        return back()->withErrors(['excel_file' => 'No certificates created.'])->withInput();
    }

    return view('bulk-show', [
        'certificates' => $certificates,
        'errors' => $errors,
    ]);
}



}
