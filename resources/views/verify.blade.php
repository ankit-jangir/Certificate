<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Certificate Verification</title>

  <style>
    body {
      font-family: "Inter", sans-serif;
      background-color: #f4f6fa;
      margin: 0;
      padding: 40px 15px;
    }

    .table-container {
      max-width: 900px;
      margin: 0 auto;
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
      overflow: hidden;
      overflow-x: auto;
      border: 1px solid #e1e4ea;
    }

    h2 {
      text-align: center;
      margin: 20px 0;
      color: #1a1a1a;
      font-size: 1.6rem;
      font-weight: 700;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      min-width: 600px;
    }

    thead {
      background-color: #f9fbff;
      position: sticky;
      top: 0;
      z-index: 2;
    }

    th {
      text-align: left;
      background: #eef3ff;
      color: #2a4cb2;
      font-weight: 600;
      padding: 14px 18px;
      border-bottom: 2px solid #dee2f2;
      font-size: 0.95rem;
    }

    td {
      padding: 14px 18px;
      border-bottom: 1px solid #eceff5;
      color: #333;
      font-size: 0.95rem;
      word-wrap: break-word;
      white-space: normal;
    }

    tr:nth-child(even) td {
      background-color: #f9fbff;
    }

    tr:hover td {
      background-color: #eef4ff;
    }


    .table-container::-webkit-scrollbar {
      height: 6px;
    }
    .table-container::-webkit-scrollbar-thumb {
      background: #cbd5e0;
      border-radius: 3px;
    }

    @media (max-width: 768px) {
      h2 {
        font-size: 1.3rem;
      }

      th, td {
        padding: 10px 12px;
        font-size: 0.9rem;
      }
    }

    @media (max-width: 480px) {
      th, td {
        font-size: 0.85rem;
        padding: 8px 10px;
      }
    }
  </style>
</head>
<body>

  <h2>Certificate Verification Details</h2>

  <div class="table-container">
    <table>
      <thead>
        <tr>
          <th>Field</th>
          <th>Details</th>
        </tr>
      </thead>
      <tbody>
        <tr><td>Name</td><td>{{ $cert->name }}</td></tr>
        <tr><td>Trainer ID</td><td>{{ $cert->trainer_id }}</td></tr>
        <tr><td>Aadhar</td><td>{{ $cert->aadhar }}</td></tr>
        <tr><td>Batch Code</td><td>{{ $cert->qp_code }}</td></tr>
        <tr><td>Grade</td><td>{{ $cert->grade }}</td></tr>
        <tr><td>Issue Date</td><td>{{ $cert->issue_date }}</td></tr>
        <tr><td>Reference No.</td><td>{{ $cert->qr_ref }}</td></tr>
      </tbody>
    </table>
  </div>

</body>
</html>

