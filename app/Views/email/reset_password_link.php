<html>
<head>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            width: 90%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #004a99;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .content {
            padding: 20px;
            line-height: 1.6;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 20px;
        }
        .button {
            display: inline-block;
            background-color: #3b82f6;
            color: #ffffff;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Reset Password Akun Anda</h2>
        </div>
        <div class="content">
            <p>Yth. Pengguna,</p>
            <p>Kami menerima permintaan untuk mereset password akun Anda. Jika Anda merasa tidak melakukan permintaan ini, Anda bisa mengabaikan email ini.</p>
            
            <p>Untuk melanjutkan proses reset password, silakan klik tombol di bawah ini:</p>

            <div style="text-align: center;">
                <a href="<?= $resetLink ?>" class="button">Reset Password</a>
            </div>

            <p>Tombol di atas akan kedaluwarsa dalam 1 jam. Jika tidak berfungsi, silakan salin dan tempel URL berikut di browser Anda:</p>
            <p><a href="<?= $resetLink ?>"><?= $resetLink ?></a></p>
            
            <p>Hormat kami,<br>Tim Satuan Pengawas Internal (SPI) POLSRI</p>
        </div>
        <div class="footer">
            <p>Ini adalah email otomatis. Mohon untuk tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>
