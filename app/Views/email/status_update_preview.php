<?php
    // Data dari controller
    $laporan = $laporan ?? [];
    $newStatus = $newStatus ?? 'tidak diketahui';
    $updateKeterangan = $update_keterangan ?? '';
    $statusMapping = [
        'pending' => 'Pending',
        'in_progress' => 'Sedang Diproses',
        'completed' => 'Selesai',
        'not_actionable' => 'Tidak Dapat Ditindaklanjuti',
    ];
    $statusText = $statusMapping[$newStatus] ?? 'Tidak Diketahui';

    // Siapkan konten untuk link mailto
    $subject = "Update Status Laporan Anda: #" . ($laporan['id'] ?? 'N/A');

    // Buat body email dalam format plain text
    $plainTextBody = "Yth. Pelapor,\n\n" 
        . "Kami memberitahukan bahwa status laporan Anda telah diperbarui.\n\n"
        . "------------------------------------
"
        . "DETAIL LAPORAN
"
        . "------------------------------------
"
        . "Judul: " . esc($laporan['judul'] ?? 'Tidak ada judul') . "\n"
        . "Tanggal Update: " . date('d F Y, H:i') . " WIB\n\n"
        . "Status Laporan: " . esc($statusText) . "\n";

    if (!empty($updateKeterangan)) {
        $plainTextBody .= "Keterangan: " . esc($updateKeterangan) . "\n";
    }

    $plainTextBody .= "------------------------------------\n\n"
        . "Terima kasih atas partisipasi Anda dalam menjaga integritas di lingkungan Politeknik Negeri Sriwijaya.\n\n"
        . "Hormat kami,\n"
        . "Tim Satuan Pengawas Internal (SPI) POLSRI";

    // URL-encode subject dan body
    $encodedSubject = rawurlencode($subject);
    $encodedBody = rawurlencode($plainTextBody);

    // Buat link mailto
    $mailtoLink = "mailto:" . esc($laporan['email_pelapor'] ?? '') . "?subject=" . $encodedSubject . "&body=" . $encodedBody;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kirim Notifikasi Status Laporan</title>
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
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>

        <h1 class="text-2xl md:text-3xl font-bold text-slate-800 mb-3">Status Diperbarui</h1>
        <p class="text-slate-500 mb-8">
            Status laporan telah berhasil diubah. Klik tombol di bawah untuk mengirim notifikasi email kepada pelapor.
        </p>

        <div class="mb-8 p-4 border border-dashed border-slate-300 rounded-lg bg-slate-50/80 space-y-2">
            <p class="text-sm text-slate-500">Akan dikirim ke:</p>
            <p class="font-semibold text-blue-600 text-lg tracking-wide"><?= esc($laporan['email_pelapor'] ?? 'Tidak ada email') ?></p>
            <hr class="my-2">
            <p class="text-sm text-slate-500">Status Baru:</p>
            <p class="font-bold text-slate-800 text-lg"><?= esc($statusText) ?></p>
            <?php if (!empty($updateKeterangan)): ?>
                <hr class="my-2">
                <p class="text-sm text-slate-500">Keterangan:</p>
                <p class="text-slate-700 text-base"><?= esc($updateKeterangan) ?></p>
            <?php endif; ?>
        </div>

        <a href="<?= $mailtoLink ?>" 
           target="_blank"
           class="group inline-flex w-full items-center justify-center rounded-lg bg-blue-600 px-6 py-4 text-lg font-semibold text-white shadow-lg shadow-blue-500/30 transition-all duration-200 ease-in-out hover:bg-blue-700 hover:shadow-xl hover:shadow-blue-500/40 focus:outline-none focus:ring-4 focus:ring-blue-300 transform hover:-translate-y-1">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mr-3 h-6 w-6 transform transition-transform duration-200 group-hover:rotate-12">
                <path d="M3.478 2.404a.75.75 0 0 0-.926.941l2.432 7.905H13.5a.75.75 0 0 1 0 1.5H4.984l-2.432 7.905a.75.75 0 0 0 .926.94 60.519 60.519 0 0 0 18.445-8.986.75.75 0 0 0 0-1.218A60.517 60.517 0 0 0 3.478 2.404Z" />
            </svg>
            Buka Aplikasi & Kirim Notifikasi
        </a>

        <div class="text-center mt-10">
            <a href="<?= strpos(current_url(), 'admin') ? site_url('/admin/laporan/show/' . ($laporan['id'] ?? '')) : site_url('/user/laporan/show/' . ($laporan['id'] ?? '')) ?>" class="text-sm text-slate-500 hover:text-blue-600 hover:underline transition-colors">
                Kembali ke Detail Laporan
            </a>
        </div>
    </div>
</body>
</html>
