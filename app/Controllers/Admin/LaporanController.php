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

        return redirect()->to(site_url('admin/laporan/show/' . $id));
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
}