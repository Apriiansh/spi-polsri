<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\LaporanModel;
use CodeIgniter\HTTP\ResponseInterface;

class LaporanController extends BaseController
{
    protected $laporanModel;

    public function __construct()
    {
        $this->laporanModel = new LaporanModel();
    }

    public function index()
    {
        $laporanModel = new LaporanModel();

        $status = $this->request->getGet('status');
        $klasifikasi = $this->request->getGet('klasifikasi');
        $kategori = $this->request->getGet('kategori_laporan'); 

        $filters = [
            'status' => $status,
            'klasifikasi' => $klasifikasi,
            'kategori' => $kategori
        ];

        if (!empty($status)) {
            $laporanModel->where('status_laporan', $status);
        }
        if (!empty($klasifikasi)) {
            $laporanModel->where('klasifikasi_laporan', $klasifikasi);
        }
        if (!empty($kategori)) {
            $laporanModel->where('kategori_laporan', $kategori);
        }

        $klasifikasi_options = (new LaporanModel())
            ->distinct()
            ->where('klasifikasi_laporan IS NOT NULL')
            ->where('klasifikasi_laporan !=', '')
            ->findColumn('klasifikasi_laporan') ?? [];

        $kategori_options = (new LaporanModel())
            ->distinct()
            ->where('kategori_laporan IS NOT NULL')
            ->where('kategori_laporan !=', '')
            ->findColumn('kategori_laporan') ?? [];

        $laporanData = $laporanModel->orderBy('created_at', 'DESC')->paginate(10, 'default');

        $pager = $laporanModel->pager;
        $pager->setPath('admin/laporan');
        if (!empty(array_filter($filters))) {
            $pager->only(array_keys(array_filter($filters)));
        }

        // Debug: tambahkan untuk memeriksa data
        log_message('debug', 'Kategori options: ' . json_encode($kategori_options));
        log_message('debug', 'Klasifikasi options: ' . json_encode($klasifikasi_options));

        $data = [
            'title' => 'Manajemen Laporan',
            'laporan' => $laporanData,
            'pager' => $pager,
            'klasifikasi_options' => $klasifikasi_options,
            'kategori_options' => $kategori_options,
            'filters' => $filters
        ];

        return view('admin/laporan/index', $data);
    }

    public function show($id)
    {
        $laporan = $this->laporanModel->find($id);

        if (!$laporan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Laporan tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail Laporan',
            'laporan' => $laporan,
        ];
        return view('admin/laporan/show', $data);
    }

    public function updateStatus($id)
    {
        $session = session();
        $newStatus = $this->request->getPost('status_laporan');

        $laporan = $this->laporanModel->find($id);

        if (!$laporan) {
            $session->setFlashdata('error', 'Laporan tidak ditemukan.');
            return redirect()->back();
        }

        if (!in_array($newStatus, ['pending', 'in_progress', 'completed', 'not_actionable'])) {
            $session->setFlashdata('error', 'Status tidak valid.');
            return redirect()->back();
        }

        // Simpan status lama untuk perbandingan
        $oldStatus = $laporan['status_laporan'];

        // Update status laporan
        $updateResult = $this->laporanModel->update($id, ['status_laporan' => $newStatus]);

        if (!$updateResult) {
            $session->setFlashdata('error', 'Gagal memperbarui status laporan.');
            return redirect()->back();
        }

        // Jika email pelapor ada dan status berubah, arahkan ke halaman kirim email manual
        if (!empty($laporan['email_pelapor']) && $oldStatus !== $newStatus) {
            session()->setFlashdata('success', 'Status laporan berhasil diperbarui. Silakan kirim notifikasi email kepada pelapor.');
            return view('email/status_update_preview', [
                'laporan' => $laporan,
                'newStatus' => $newStatus
            ]);
        }

        $session->setFlashdata('success', 'Status laporan berhasil diperbarui.');
        return redirect()->to(site_url('admin/laporan/show/' . $id));
    }

    /**
     * Kirim email notifikasi update status
     */
    private function sendStatusUpdateEmail($laporan, $newStatus, $oldStatus)
    {
        try {
            $email = \Config\Services::email();
            
            // Set email penerima
            $email->setTo($laporan['email_pelapor']);
            
            // Set subject
            $email->setSubject('Update Status Laporan Anda [SPI POLSRI]');
            
            // Persiapkan data untuk email template (sesuai dengan template yang ada)
            $emailData = [
                'laporan' => $laporan,
                'newStatus' => $newStatus
            ];

            // Load email template
            $message = view('email/status_update', $emailData);
            $email->setMessage($message);

            // Kirim email
            if ($email->send()) {
                log_message('info', "Email status update berhasil dikirim ke {$laporan['email_pelapor']} untuk laporan ID: {$laporan['id']}");
                return true;
            } else {
                // Log error jika gagal
                $debugInfo = $email->printDebugger(['headers']);
                log_message('error', "Gagal mengirim email status update: " . $debugInfo);
                return false;
            }
            
        } catch (\Exception $e) {
            log_message('error', "Exception saat mengirim email: " . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        $session = session();
        $laporan = $this->laporanModel->find($id);

        if (!$laporan) {
            $session->setFlashdata('error', 'Laporan tidak ditemukan.');
            return redirect()->back();
        }

        if (!empty($laporan['gambar_bukti'])) {
            $filePath = ROOTPATH . 'public/uploads/bukti/' . $laporan['gambar_bukti'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $this->laporanModel->delete($id);

        $session->setFlashdata('success', 'Laporan berhasil dihapus.');
        return redirect()->to(site_url('admin/laporan'));
    }

    /**
     * Method untuk testing pengiriman email (DEVELOPMENT ONLY)
     * Akses: /admin/laporan/testEmail
     */
    public function testEmail()
    {
        // HANYA untuk testing - hapus atau comment di production!
        if (ENVIRONMENT === 'production') {
            return 'Method ini hanya tersedia di development mode.';
        }

        // Data dummy untuk testing
        $testLaporan = [
            'id' => 999,
            'judul' => 'Test Laporan - Pengadaan Barang Tidak Sesuai Prosedur',
            'tracking_code' => 'TEST-' . date('Ymd') . '-001',
            'email_pelapor' => 'apriansyahmlp@gmail.com', // GANTI dengan email Anda untuk testing
            'kategori_laporan' => 'Pengadaan Barang/Jasa',
            'klasifikasi_laporan' => 'Pengaduan',
            'status_laporan' => 'pending',
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Test berbagai status
        $statuses = ['pending', 'in_progress', 'completed', 'not_actionable'];
        $testStatus = $this->request->getGet('status') ?? 'in_progress';

        if (!in_array($testStatus, $statuses)) {
            $testStatus = 'in_progress';
        }

        $result = $this->sendStatusUpdateEmail($testLaporan, $testStatus, 'pending');

        if ($result) {
            return "✅ Email test berhasil dikirim!<br><br>" .
                   "Status: <strong>{$testStatus}</strong><br>" .
                   "Penerima: <strong>{$testLaporan['email_pelapor']}</strong><br><br>" .
                   "Cek inbox email Anda (termasuk folder spam/junk).<br><br>" .
                   "Test status lain:<br>" .
                   "- <a href='" . site_url('admin/laporan/testEmail?status=pending') . "'>Pending</a><br>" .
                   "- <a href='" . site_url('admin/laporan/testEmail?status=in_progress') . "'>In Progress</a><br>" .
                   "- <a href='" . site_url('admin/laporan/testEmail?status=completed') . "'>Completed</a><br>" .
                   "- <a href='" . site_url('admin/laporan/testEmail?status=not_actionable') . "'>Not Actionable</a>";
        } else {
            return "❌ Email gagal dikirim!<br><br>" .
                   "Cek log file untuk detail error:<br>" .
                   "- <code>writable/logs/log-" . date('Y-m-d') . ".log</code><br><br>" .
                   "Kemungkinan penyebab:<br>" .
                   "1. Kredensial Brevo salah di file .env<br>" .
                   "2. SMTP port diblokir oleh firewall/hosting<br>" .
                   "3. Koneksi internet bermasalah";
        }
    }
}