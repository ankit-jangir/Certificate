<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Bulk Certificates</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f3f4f6;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        .certificates-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 50px;
        }

        iframe {
            width: 100%;
            max-width: 1086px;
            height: 770px;
            border: 1px solid #ddd;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .print-btn {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .error-box {
            background: #fee2e2;
            color: #991b1b;
            padding: 10px 15px;
            border-radius: 6px;
            margin: 10px auto;
            max-width: 900px;
        }

        .error-box ul {
            margin: 0;
            padding-left: 20px;
        }
    </style>
</head>
<body>

    <h1>All Upload Certificates</h1>

    @if (!empty($errors))
        <div class="error-box">
            <strong>Some rows had issues:</strong>
            <ul>
                @foreach ($errors as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    <div class="certificates-container">
        @foreach ($certificates as $cert)
            <iframe src="{{ route('certificate.show', ['trainer_id' => $cert->trainer_id]) }}"></iframe>
        @endforeach
    </div>

</body>
</html>
