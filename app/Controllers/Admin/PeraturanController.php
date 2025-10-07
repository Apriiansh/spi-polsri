<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PeraturanModel;

class PeraturanController extends BaseController
{
    protected $peraturanModel;

    public function __construct()
    {
        $this->peraturanModel = new PeraturanModel();
    }

    /**
     * Display list of all regulations for admin.
     */
    public function index()
    {
        $search = $this->request->getVar('search');
        $statusFilter = $this->request->getVar('status');

        $builder = $this->peraturanModel
            ->select('peraturan.*, users.username')
            ->join('users', 'users.id = peraturan.user_id', 'left');

        if ($search) {
            $builder->groupStart()
                ->like('peraturan.judul', $search)
                ->orLike('peraturan.peraturan', $search)
                ->orLike('users.username', $search)
                ->groupEnd();
        }

        if ($statusFilter) {
            $builder->where('peraturan.status', $statusFilter);
        }

        $data = [
            'title' => 'Manajemen Peraturan',
            'peraturan' => $builder->orderBy('peraturan.created_at', 'DESC')->paginate(10, 'peraturan'),
            'pager' => $this->peraturanModel->pager,
            'search' => $search,
            'status_filter' => $statusFilter,
        ];

        return view('admin/peraturan/index', $data);
    }

    /**
     * Show detail of a regulation for admin.
     */
    public function show($id)
    {
        $peraturan = $this->peraturanModel->getPeraturanWithUser($id);

        if (!$peraturan) {
            return redirect()->to('/admin/peraturan')->with('error', 'Peraturan tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail Peraturan',
            'peraturan' => $peraturan,
        ];

        return view('admin/peraturan/show', $data);
    }

    /**
     * Update status of a regulation.
     */
    public function updateStatus($id)
    {
        $status = $this->request->getPost('status');

        if (!in_array($status, ['pending', 'published', 'rejected'])) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        $peraturan = $this->peraturanModel->find($id);
        if (!$peraturan) {
            return redirect()->to('/admin/peraturan')->with('error', 'Peraturan tidak ditemukan.');
        }

        if ($this->peraturanModel->update($id, ['status' => $status])) {
            // TODO: Implement email notification to user
            return redirect()->to('/admin/peraturan')->with('success', 'Status peraturan berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui status peraturan.');
    }

    /**
     * Download attachment file.
     */
    public function download($id)
    {
        $peraturan = $this->peraturanModel->find($id);

        if (!$peraturan) {
            return redirect()->to('/admin/peraturan')->with('error', 'Peraturan tidak ditemukan.');
        }

        $filePath = ROOTPATH . 'public/uploads/peraturan/' . $peraturan['file_lampiran'];

        if (!file_exists($filePath)) {
            return redirect()->to('/admin/peraturan')->with('error', 'File tidak ditemukan.');
        }

        return $this->response->download($filePath, null);
    }

    /**
     * Delete a regulation.
     */
    public function delete($id)
    {
        $peraturan = $this->peraturanModel->find($id);

        if (!$peraturan) {
            return redirect()->to('/admin/peraturan')->with('error', 'Peraturan tidak ditemukan.');
        }

        // Delete file
        $filePath = ROOTPATH . 'public/uploads/peraturan/' . $peraturan['file_lampiran'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $this->peraturanModel->delete($id);
        return redirect()->to('/admin/peraturan')->with('success', 'Peraturan berhasil dihapus.');
    }
}