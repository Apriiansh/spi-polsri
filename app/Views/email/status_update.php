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
        .status-box {
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            margin: 15px 0;
        }
        .status-pending { background-color: #fff8e1; color: #f57f17; border: 1px solid #f57f17; }
        .status-in_progress { background-color: #e3f2fd; color: #1565c0; border: 1px solid #1565c0; }
        .status-completed { background-color: #e8f5e9; color: #2e7d32; border: 1px solid #2e7d32; }
        .status-not_actionable { background-color: #f5f5f5; color: #616161; border: 1px solid #616161; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Update Status Laporan Anda</h2>
        </div>
        <div class="content">
            <p>Yth. Pelapor,</p>
            <p>Kami memberitahukan bahwa status laporan Anda dengan detail sebagai berikut telah diperbarui:</p>
            
            <p>
                <strong>Judul Laporan:</strong> <?= esc($laporan['judul']); ?><br>
                <strong>ID Laporan:</strong> #<?= esc($laporan['id']); ?>
            </p>

            <p>Status baru laporan Anda adalah:</p>
            
            <?php
                $statusText = 'Tidak Diketahui';
                $statusClass = '';
                switch ($newStatus) {
                    case 'pending':
                        $statusText = 'Pending';
                        $statusClass = 'status-pending';
                        break;
                    case 'in_progress':
                        $statusText = 'Sedang Diproses';
                        $statusClass = 'status-in_progress';
                        break;
                    case 'completed':
                        $statusText = 'Selesai';
                        $statusClass = 'status-completed';
                        break;
                    case 'not_actionable':
                        $statusText = 'Tidak Dapat Ditindaklanjuti';
                        $statusClass = 'status-not_actionable';
                        break;
                }
            ?>
            <div class="status-box <?= $statusClass; ?>">
                <?= $statusText; ?>
            </div>

            <p>Terima kasih atas partisipasi Anda dalam menjaga integritas dan kualitas layanan di lingkungan Politeknik Negeri Sriwijaya.</p>
            
            <p>Hormat kami,<br>Tim Satuan Pengawas Internal (SPI) POLSRI</p>
        </div>
        <div class="footer">
            <p>Ini adalah email otomatis. Mohon untuk tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>
