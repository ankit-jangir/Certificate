<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Certificate Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell;
            background-color: #f9fafb;
            padding: 40px;
        }

        .card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 30px;
            background: #fff;
            max-width: 800px;
            margin: auto;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease-in-out;
        }

        .card h3 {
            text-align: center;
            font-size: 1.8rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 25px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 10px;
        }

        .nav-tabs {
            justify-content: center;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 10px;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #555;
            font-weight: 500;
            padding: 10px 20px;
            border-radius: 6px;
            transition: all 0.3s;
        }

        .nav-tabs .nav-link.active {
            background-color: #0d6efd;
            color: #fff;
            font-weight: 600;
        }

        .nav-tabs .nav-link:hover {
            background-color: #e7f0ff;
            color: #0d6efd;
        }

        label {
            font-weight: 600;
            font-size: 14px;
            color: #333;
        }

        .form-control {
            border-radius: 6px;
            border: 1px solid #d1d5db;
            padding: 10px 12px;
            font-size: 15px;
            transition: border-color 0.2s ease;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.15);
        }


        .error {
            color: #b91c1c;
            font-size: 12px;
            margin-top: 4px;
        }

        .actions {
            margin-top: 25px;
            text-align: center;
        }

        button.btn {
            padding: 10px 20px;
            font-size: 15px;
            border-radius: 8px;
            font-weight: 500;
        }

        @media (max-width: 1024px) {
            body {
                padding: 25px;
            }

            .card {
                max-width: 100%;
                padding: 25px;
                border-radius: 10px;
            }

            .card h3 {
                font-size: 1.5rem;
            }

            .form-control {
                font-size: 14px;
                padding: 9px 11px;
            }

            label {
                font-size: 13px;
            }

            button.btn {
                font-size: 14px;
            }
        }

        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .card {
                max-width: 100%;
                padding: 20px;
                border-radius: 8px;
            }

            .card h3 {
                font-size: 1.3rem;
                margin-bottom: 20px;
            }

            .nav-tabs {
                flex-wrap: wrap;
                gap: 6px;
            }

            .nav-tabs .nav-link {
                flex: 1;
                text-align: center;
                font-size: 13px;
                padding: 8px;
            }

            label {
                font-size: 12.5px;
            }

            .form-control {
                font-size: 13px;
                padding: 7px 9px;
            }

            button.btn {
                width: 100%;
                font-size: 13.5px;
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="card">
        <h3 class="mb-3">Trainer Certificate</h3>

        <ul class="nav nav-tabs" id="certificateTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="single-tab" data-bs-toggle="tab" data-bs-target="#single"
                    type="button" role="tab">
                    Single Add
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="bulk-tab" data-bs-toggle="tab" data-bs-target="#bulk" type="button"
                    role="tab">
                    Bulk Upload (Excel)
                </button>
            </li>
        </ul>

        <div class="tab-content mt-4" id="certificateTabsContent">
            <div class="tab-pane fade show active" id="single" role="tabpanel" aria-labelledby="single-tab">
                <form method="post" action="{{ route('certificate.store') }}">
                    @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger mb-4">
                            <strong>Please fix the errors below.</strong>
                        </div>
                    @endif

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name">Full Name</label>
                            <input  class="form-control" id="name" name="name" type="text"
                                value="{{ old('name') }}" placeholder="Enter full name">
                            @error('name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="trainer_id">Trainer ID</label>
                            <input  class="form-control" id="trainer_id" name="trainer_id" type="text"
                                value="{{ old('trainer_id') }}" placeholder="e.g. TR200150">
                            @error('trainer_id')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="aadhar">Aadhaar Number</label>
                            <input  class="form-control" id="aadhar" name="aadhar" type="text"
                                maxlength="12" pattern="\d{12}" inputmode="numeric" value="{{ old('aadhar') }}"
                                placeholder="12-digit Aadhaar number">
                            @error('aadhar')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="grade">Grade</label>
                            <input  class="form-control" id="grade" name="grade" type="text"
                                value="{{ old('grade') }}" placeholder="e.g. A, B, C">
                            @error('grade')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="issue_date">Issue Date</label>
                            <input  class="form-control" id="issue_date" name="issue_date" type="date"
                                 value="{{ old('issue_date') }}" placeholder="dd-mm-yy">
                            @error('issue_date')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="actions">
                        <button type="submit" class="btn btn-primary">Save & Preview</button>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade" id="bulk" role="tabpanel" aria-labelledby="bulk-tab">
                <form method="post" action="{{ route('certificate.bulkUpload') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="excel_file" class="form-label">Upload Excel File (.xlsx)</label>
                        <input  class="form-control" id="excel_file" name="excel_file" type="file"
                            accept=".xlsx,.xls">
                            @error('excel_file')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        <div class="form-text">Ensure the Excel file contains columns: <b>name, trainer_id, aadhar,
                                grade, issue_date</b></div>
                    </div>

                    <div class="actions">
                        <button type="submit" class="btn btn-success">Upload & Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
document.addEventListener("DOMContentLoaded", function () {
    const tabs = document.querySelectorAll('.nav-tabs .nav-link');
    const storedTab = localStorage.getItem('activeTab');
    if (storedTab) {
        const activeTab = document.querySelector(`.nav-tabs .nav-link[data-bs-target="${storedTab}"]`);
        if (activeTab) {
            new bootstrap.Tab(activeTab).show();
        }
    }
    tabs.forEach(tab => {
        tab.addEventListener('shown.bs.tab', function (e) {
            const activeTabTarget = e.target.getAttribute('data-bs-target');
            localStorage.setItem('activeTab', activeTabTarget);
        });
    });
});
</script>

</body>

</html>
