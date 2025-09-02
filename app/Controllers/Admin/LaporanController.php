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
        $data = [
            'title' => 'Manajemen Laporan',
            'laporan' => $this->laporanModel->orderBy('created_at', 'DESC')->paginate(10),
            'pager' => $this->laporanModel->pager,
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

        $session->setFlashdata('success', 'Status laporan berhasil diperbarui.');
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

        // Delete associated image file if exists
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