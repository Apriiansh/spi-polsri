<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status Laporan</title>
    <style>
        body {
            font-family: sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #004a99;
            color: #fff;
            padding: 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .header h2 {
            margin: 0;
            font-size: 22px;
        }
        .content {
            padding: 30px 20px;
            line-height: 1.6;
        }
        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #004a99;
            padding: 15px;
            margin: 20px 0;
        }
        .info-box p {
            margin: 5px 0;
        }
        .status-box {
            padding: 15px 20px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            font-size: 16px;
        }
        .status-pending { 
            background-color: #fff8e1; 
            color: #f57f17; 
            border: 2px solid #f57f17; 
        }
        .status-in_progress { 
            background-color: #e3f2fd; 
            color: #1565c0; 
            border: 2px solid #1565c0; 
        }
        .status-completed { 
            background-color: #e8f5e9; 
            color: #2e7d32; 
            border: 2px solid #2e7d32; 
        }
        .status-not_actionable { 
            background-color: #f5f5f5; 
            color: #616161; 
            border: 2px solid #616161; 
        }
        .status-description {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            font-size: 14px;
        }
        .footer {
            background-color: #f8f9fa;
            text-align: center;
            font-size: 12px;
            color: #777;
            padding: 20px;
            border-radius: 0 0 8px 8px;
        }
        .footer p {
            margin: 5px 0;
        }
        strong {
            color: #004a99;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>🔔 Update Status Laporan Anda</h2>
            <p style="margin: 5px 0 0 0; font-size: 14px;">Satuan Pengawasan Internal POLSRI</p>
        </div>

        <div class="content">
            <p>Yth. Pelapor,</p>
            
            <p>Kami memberitahukan bahwa status laporan Anda telah diperbarui dengan detail sebagai berikut:</p>

            <div class="info-box">
                <p><strong>Judul Laporan:</strong> <?= esc($laporan['judul'] ?? 'Tidak ada judul'); ?></p>
                <p><strong>ID Laporan:</strong> #<?= esc($laporan['id']); ?></p>
                <?php if (isset($laporan['tracking_code'])): ?>
                <p><strong>Kode Tracking:</strong> <?= esc($laporan['tracking_code']); ?></p>
                <?php endif; ?>
                <?php if (isset($laporan['kategori_laporan'])): ?>
                <p><strong>Kategori:</strong> <?= esc($laporan['kategori_laporan']); ?></p>
                <?php endif; ?>
                <p><strong>Tanggal Update:</strong> <?= date('d F Y, H:i', strtotime($laporan['updated_at'] ?? 'now')); ?> WIB</p>
            </div>

            <p style="font-weight: bold; margin-bottom: 10px;">Status Terbaru Laporan Anda:</p>

            <?php
            $statusText = 'Tidak Diketahui';
            $statusClass = '';
            $statusDescription = '';
            
            switch ($newStatus) {
                case 'pending':
                    $statusText = '⏱️ Pending';
                    $statusClass = 'status-pending';
                    $statusDescription = 'Laporan Anda telah diterima dan sedang menunggu untuk ditinjau oleh tim kami.';
                    break;
                case 'in_progress':
                    $statusText = '🔄 Sedang Diproses';
                    $statusClass = 'status-in_progress';
                    $statusDescription = 'Laporan Anda sedang dalam proses tindak lanjut. Tim kami sedang bekerja untuk menangani laporan ini.';
                    break;
                case 'completed':
                    $statusText = '✅ Selesai';
                    $statusClass = 'status-completed';
                    $statusDescription = 'Laporan Anda telah selesai ditindaklanjuti. Terima kasih atas kontribusi Anda dalam meningkatkan tata kelola di lingkungan Politeknik Negeri Sriwijaya.';
                    break;
                case 'not_actionable':
                    $statusText = 'ℹ️ Tidak Dapat Ditindaklanjuti';
                    $statusClass = 'status-not_actionable';
                    $statusDescription = 'Mohon maaf, berdasarkan evaluasi kami, laporan ini tidak dapat ditindaklanjuti. Silakan hubungi kami untuk informasi lebih lanjut.';
                    break;
            }
            ?>

            <div class="status-box <?= $statusClass; ?>">
                <?= $statusText; ?>
            </div>

            <?php if (!empty($statusDescription)): ?>
            <div class="status-description">
                <?= $statusDescription; ?>
            </div>
            <?php endif; ?>

            <?php if (!empty($update_keterangan)): ?>
            <div class="status-description" style="margin-top: 15px; border-left-color: #6c757d; background-color: #f1f3f5; color: #495057;">
                <p style="font-weight: bold; color: #343a40;">Keterangan dari Tim SPI:</p>
                <p style="margin-top: 5px;"><?= nl2br(esc($update_keterangan)); ?></p>
            </div>
            <?php endif; ?>

            <p style="margin-top: 30px;">Terima kasih atas partisipasi Anda dalam menjaga integritas dan kualitas layanan di lingkungan Politeknik Negeri Sriwijaya.</p>

            <p style="margin-top: 20px;">
                Jika Anda memiliki pertanyaan atau memerlukan informasi lebih lanjut, silakan hubungi kami melalui:<br>
                📧 Email: spi@polsri.ac.id<br>
                🌐 Website: spi.polsri.ac.id
            </p>

            <p style="margin-top: 20px;">Hormat kami,<br><strong>Tim Satuan Pengawasan Internal (SPI) POLSRI</strong></p>
        </div>

        <div class="footer">
            <p><strong>Satuan Pengawasan Internal</strong></p>
            <p>Politeknik Negeri Sriwijaya</p>
            <p style="margin-top: 10px; font-size: 11px;">Ini adalah email otomatis. Mohon untuk tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>