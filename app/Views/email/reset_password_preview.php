<?php
    // Siapkan konten untuk link mailto
    $subject = "Reset Password Akun SPI POLSRI";

    // Buat body email dalam format plain text untuk kompatibilitas maksimum
    $plainTextBody = "Yth. " . esc($username) . ",

"
        . "Kami menerima permintaan untuk mereset password akun Anda. Jika Anda merasa tidak melakukan permintaan ini, Anda bisa mengabaikan email ini.

"
        . "Untuk melanjutkan proses reset password, silakan buka link di bawah ini:
"
        . $resetLink . "

"
        . "Link di atas akan kedaluwarsa dalam 1 jam.

"
        . "Hormat kami,
"
        . "Tim Satuan Pengawas Internal (SPI) POLSRI";

    // URL-encode subject dan body
    $encodedSubject = rawurlencode($subject);
    $encodedBody = rawurlencode($plainTextBody);

    // Buat link mailto
    $mailtoLink = "mailto:" . esc($emailAddress) . "?subject=" . $encodedSubject . "&body=" . $encodedBody;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kirim Email Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50 flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-md mx-auto bg-white shadow-xl rounded-2xl p-8 md:p-10 text-center border border-slate-200">
        
        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-blue-100 text-blue-600 mb-5">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-8 w-8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
            </svg>
        </div>

        <h1 class="text-2xl md:text-3xl font-bold text-slate-800 mb-3">Siapkan Email Reset</h1>
        <p class="text-slate-500 mb-8">
            Klik tombol di bawah untuk membuka aplikasi email dan mengirimkan link reset password.
        </p>

        <div class="mb-8 p-4 border border-dashed border-slate-300 rounded-lg bg-slate-50/80">
            <p class="text-sm text-slate-500">Akan dikirim ke:</p>
            <p class="font-semibold text-blue-600 text-lg tracking-wide"><?= esc($emailAddress) ?></p>
        </div>

        <a href="<?= $mailtoLink ?>" 
           target="_blank"
           class="group inline-flex w-full items-center justify-center rounded-lg bg-blue-600 px-6 py-4 text-lg font-semibold text-white shadow-lg shadow-blue-500/30 transition-all duration-200 ease-in-out hover:bg-blue-700 hover:shadow-xl hover:shadow-blue-500/40 focus:outline-none focus:ring-4 focus:ring-blue-300 transform hover:-translate-y-1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mr-3 h-6 w-6 transform transition-transform duration-200 group-hover:rotate-12">
                <path d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
            </svg>
            Buka Aplikasi & Kirim
        </a>

        <div class="text-center mt-10">
            <a href="<?= site_url('/admin/dashboard') ?>" class="text-sm text-slate-500 hover:text-blue-600 hover:underline transition-colors">
                Kembali ke Dashboard
            </a>
        </div>
    </div>
</body>
</html>
