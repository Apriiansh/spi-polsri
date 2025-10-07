<?php

namespace App\Controllers\User;

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
        $session = session();

        $userBidang = $session->get('bidang');

        if (!$userBidang) {
            $session->setFlashdata('error', 'Bidang user tidak ditemukan.');
            return redirect()->to('login');
        }

        $laporanModel->groupStart()
            ->where('kategori_laporan', $userBidang)
            ->orWhere('kategori_laporan', 'penyuapan')
            ->groupEnd();

        // Get filter values
        $status = $this->request->getGet('status');
        $klasifikasi = $this->request->getGet('klasifikasi');

        $filters = [
            'status' => $status,
            'klasifikasi' => $klasifikasi
        ];

        if (!empty($status)) {
            $laporanModel->where('status_laporan', $status);
        }
        if (!empty($klasifikasi)) {
            $laporanModel->where('klasifikasi_laporan', $klasifikasi);
        }

        $klasifikasi_options = (new LaporanModel())
            ->distinct()
            ->groupStart()
            ->where('kategori_laporan', $userBidang)
            ->orWhere('kategori_laporan', 'penyuapan')
            ->groupEnd()
            ->where('klasifikasi_laporan IS NOT NULL')
            ->where('klasifikasi_laporan !=', '')
            ->findColumn('klasifikasi_laporan') ?? [];

        $laporanData = $laporanModel->orderBy('created_at', 'DESC')->paginate(10, 'default');

        $pager = $laporanModel->pager;
        $pager->setPath('user/laporan');
        if (!empty(array_filter($filters))) {
            $pager->only(array_keys(array_filter($filters)));
        }

        log_message('debug', 'User bidang: ' . $userBidang);
        log_message('debug', 'Klasifikasi options: ' . json_encode($klasifikasi_options));

        $data = [
            'title' => 'Manajemen Laporan',
            'laporan' => $laporanData,
            'pager' => $pager,
            'klasifikasi_options' => $klasifikasi_options,
            'filters' => $filters,
            'user_bidang' => $userBidang
        ];

        return view('user/laporan/index', $data);
    }

    public function show($id)
    {
        $session = session();
        $userBidang = $session->get('bidang');

        if (!$userBidang) {
            $session->setFlashdata('error', 'Bidang user tidak ditemukan.');
            return redirect()->to('login');
        }

        $laporan = $this->laporanModel
            ->groupStart()
            ->where('kategori_laporan', $userBidang)
            ->orWhere('kategori_laporan', 'penyuapan')
            ->groupEnd()
            ->find($id);

        if (!$laporan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Laporan tidak ditemukan atau tidak dapat diakses.');
        }

        $data = [
            'title' => 'Detail Laporan',
            'laporan' => $laporan,
        ];
        return view('user/laporan/show', $data);
    }

    public function updateStatus($id)
    {
        $session = session();
        $userBidang = $session->get('bidang');
        $newStatus = $this->request->getPost('status_laporan');

        if (!$userBidang) {
            $session->setFlashdata('error', 'Bidang user tidak ditemukan.');
            return redirect()->to('login');
        }

        $laporan = $this->laporanModel
            ->groupStart()
            ->where('kategori_laporan', $userBidang)
            ->orWhere('kategori_laporan', 'penyuapan')
            ->groupEnd()
            ->find($id);

        if (!$laporan) {
            $session->setFlashdata('error', 'Laporan tidak ditemukan atau tidak dapat diakses.');
            return redirect()->back();
        }

        if (!in_array($newStatus, ['pending', 'in_progress', 'completed', 'not_actionable'])) {
            $session->setFlashdata('error', 'Status tidak valid.');
            return redirect()->back();
        }

        $this->laporanModel->update($id, ['status_laporan' => $newStatus]);

        // Kirim email notifikasi
        $email = \Config\Services::email();
        $email->setTo($laporan['email_pelapor']);
        $email->setSubject('Update Status Laporan Anda [SPI POLSRI]');

        $message = view('email/status_update', [
            'laporan' => $laporan,
            'newStatus' => $newStatus
        ]);
        $email->setMessage($message);

        if ($email->send()) {
            $session->setFlashdata('success', 'Status laporan berhasil diperbarui dan notifikasi email telah dikirim.');
        } else {
            // Optional: Log the error for debugging
            // log_message('error', $email->printDebugger(['headers']));
            $session->setFlashdata('success', 'Status laporan berhasil diperbarui, tetapi notifikasi email gagal dikirim.');
        }

        return redirect()->to(site_url('user/laporan/show/' . $id));
    }

    public function delete($id)
    {
        $session = session();
        $userBidang = $session->get('bidang');

        if (!$userBidang) {
            $session->setFlashdata('error', 'Bidang user tidak ditemukan.');
            return redirect()->to('login');
        }

        $laporan = $this->laporanModel
            ->groupStart()
            ->where('kategori_laporan', $userBidang)
            ->orWhere('kategori_laporan', 'penyuapan')
            ->groupEnd()
            ->find($id);

        if (!$laporan) {
            $session->setFlashdata('error', 'Laporan tidak ditemukan atau tidak dapat diakses.');
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
        return redirect()->to(site_url('user/laporan'));
    }
}