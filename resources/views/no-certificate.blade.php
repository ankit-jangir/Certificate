<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>No Certificate Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9fafb;
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Ubuntu, Cantarell;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }
        .message-box {
            background: #fff;
            border-radius: 10px;
            padding: 40px 60px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>
    <div class="message-box">
        <h3 class="text-danger">⚠️ {{ $message }}</h3>
        {{-- <a href="{{ route('certificate.create') }}" class="btn btn-primary mt-3">Go Back</a> --}}
    </div>
</body>
</html>
