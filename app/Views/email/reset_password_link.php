<html>
<head>
    <meta charset="UTF-8">
    <title>Template Email Reset Password</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .notice {
            background: #fffae5;
            border: 1px solid #facc15;
            color: #92400e;
            padding: 12px 16px;
            margin: 20px auto;
            max-width: 600px;
            border-radius: 6px;
            font-size: 14px;
            line-height: 1.5;
        }
        .copy-btn {
            display: inline-block;
            background-color: #3b82f6;
            color: #fff;
            padding: 10px 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 10px;
            transition: background-color 0.2s;
        }
        .copy-btn:hover {
            background-color: #2563eb;
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
    <!-- Notice section -->
    <div class="notice">
        <strong>Petunjuk Pengiriman Manual:</strong><br>
        Salin seluruh isi email di bawah ini, lalu tempel ke Gmail Anda untuk dikirim ke pengguna yang meminta reset password.<br>
        Pastikan Anda mengganti alamat penerima dengan email pengguna.
        <br><br>
        <button class="copy-btn" onclick="copyEmail()">Salin Email Ini</button>
        <span id="copy-status" style="margin-left:10px; color:green; font-weight:bold;"></span>
    </div>

    <!-- Email content -->
    <div class="container" id="emailContent">
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

            <p>Tombol di atas akan kedaluwarsa dalam 1 jam. Jika tidak berfungsi, salin dan tempel URL berikut di browser Anda:</p>
            <p><a href="<?= $resetLink ?>"><?= $resetLink ?></a></p>
            
            <p>Hormat kami,<br>Tim Satuan Pengawas Internal (SPI) POLSRI</p>
        </div>
        <div class="footer">
            <p>Ini adalah email otomatis. Mohon untuk tidak membalas email ini.</p>
        </div>
    </div>

    <!-- Script -->
    <script>
        function copyEmail() {
            const emailContent = document.getElementById('emailContent').outerHTML;
            const tempElement = document.createElement('textarea');
            tempElement.value = emailContent;
            document.body.appendChild(tempElement);
            tempElement.select();
            document.execCommand('copy');
            document.body.removeChild(tempElement);

            const status = document.getElementById('copy-status');
            status.textContent = "✓ Email berhasil disalin!";
            setTimeout(() => status.textContent = "", 3000);
        }
    </script>
</body>
</html>
