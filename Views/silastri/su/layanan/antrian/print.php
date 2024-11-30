<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        h1 {
            color: #333;
        }

        .container {
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
        }

        .section {
            margin-bottom: 15px;
        }

        .label {
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Bukti Registrasi Layanan</h1>
        <div class="section">
            <p><span class="label">Nama:</span> <?= "Nama"; ?></p>
            <p><span class="label">NIK:</span> <?= "NIK" ?></p>
            <p><span class="label">Nomor Layanan:</span> <?= "No Permohonan" ?></p>
            <p><span class="label">Tanggal Registrasi:</span> <?= "Created At" ?></p>
        </div>
        <hr>
        <div class="footer">
            <p>Terima kasih telah mendaftar layanan kami.</p>
        </div>
    </div>
</body>

</html>