<?php

namespace App\Controllers\User;

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
     * Get kategori data (sesuai dengan menu navigasi)
     */
    private function getKategoriData()
    {
        return [
            'Akuntansi/Keuangan',
            'Hukum',
            'Manajemen SDM',
            'Manajemen Aset',
            'Ketatalaksanaan'
        ];
    }

    private function to_slug($string)
    {
        $string = strtolower($string);
        $string = preg_replace('/[^a-z0-9\s\-]/', '', $string);
        $string = str_replace(' ', '-', $string);
        $string = preg_replace('/-+/', '-', $string);
        return trim($string, '-');
    }

    /**
     * Get current user ID
     */
    private function getCurrentUserId()
    {
        $userId = session()->get('user_id');
        if (!$userId) {
            throw new \Exception('User tidak terautentikasi');
        }
        return $userId;
    }

    /**
     * Display list of peraturan
     */
    public function index()
    {
        $userId = $this->getCurrentUserId();
        $search = $this->request->getVar('search');
        $kategoriFilter = $this->request->getVar('kategori');
        $statusFilter = $this->request->getVar('status');

        $builder = $this->peraturanModel->where('user_id', $userId);

        if ($search) {
            $builder->groupStart()
                ->like('judul', $search)
                ->orLike('peraturan', $search)
                ->groupEnd();
        }

        if ($kategoriFilter) {
            $builder->where('kategori', $kategoriFilter);
        }

        if ($statusFilter) {
            $builder->where('status', $statusFilter);
        }

        $data = [
            'title' => 'Manajemen Peraturan',
            'peraturan' => $builder->orderBy('created_at', 'DESC')->paginate(10),
            'pager' => $this->peraturanModel->pager,
            'search' => $search,
            'kategori_filter' => $kategoriFilter,
            'status_filter' => $statusFilter,
            'kategoriData' => $this->getKategoriData(),
        ];

        return view('user/peraturan/index', $data);
    }

    /**
     * Show create form
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Peraturan',
            'kategoriData' => $this->getKategoriData(),
            'validation' => \Config\Services::validation(),
        ];

        return view('user/peraturan/create', $data);
    }

    /**
     * Store new peraturan
     */
    public function store()
    {
        try {
            $userId = $this->getCurrentUserId();
        } catch (\Exception $e) {
            return redirect()->to('/login')->with('error', 'Session expired. Silakan login kembali.');
        }

        $kategoriData = $this->getKategoriData();

        $rules = [
            'judul' => 'required|min_length[5]|max_length[255]',
            'kategori' => 'required|in_list[' . implode(',', $kategoriData) . ']',
            'peraturan' => 'required|max_length[255]',
            'file_lampiran' => [
                'rules' => 'uploaded[file_lampiran]|max_size[file_lampiran,10240]|ext_in[file_lampiran,pdf,doc,docx]',
                'errors' => [
                    'uploaded' => 'File lampiran wajib diunggah',
                    'max_size' => 'Ukuran file maksimal 10MB',
                    'ext_in' => 'File harus berformat PDF, DOC, atau DOCX'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $file = $this->request->getFile('file_lampiran');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/peraturan', $newName);

            $data = [
                'user_id' => $userId,
                'judul' => $this->request->getPost('judul'),
                'kategori' => $this->request->getPost('kategori'),
                'peraturan' => $this->request->getPost('peraturan'),
                'file_lampiran' => $newName,
                'status' => 'pending'
            ];

            if ($this->peraturanModel->insert($data)) {
                return redirect()->to('/user/peraturan')->with('success', 'Peraturan berhasil ditambahkan dan menunggu verifikasi admin.');
            }
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan peraturan.');
    }

    /**
     * Show detail peraturan
     */
    public function show($id)
    {
        $userId = $this->getCurrentUserId();
        $peraturan = $this->peraturanModel
            ->where('user_id', $userId)
            ->find($id);

        if (!$peraturan) {
            return redirect()->to('/user/peraturan')->with('error', 'Peraturan tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail Peraturan',
            'peraturan' => $peraturan,
        ];

        return view('user/peraturan/show', $data);
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $userId = $this->getCurrentUserId();
        $peraturan = $this->peraturanModel
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->find($id);

        if (!$peraturan) {
            return redirect()->to('/user/peraturan')->with('error', 'Peraturan tidak ditemukan atau sudah diverifikasi.');
        }

        $data = [
            'title' => 'Edit Peraturan',
            'peraturan' => $peraturan,
            'kategoriData' => $this->getKategoriData(),
            'validation' => \Config\Services::validation(),
        ];

        return view('user/peraturan/edit', $data);
    }

    /**
     * Update peraturan
     */
    public function update($id)
    {
        $userId = $this->getCurrentUserId();
        $peraturan = $this->peraturanModel
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->find($id);

        if (!$peraturan) {
            return redirect()->to('/user/peraturan')->with('error', 'Peraturan tidak ditemukan atau sudah diverifikasi.');
        }

        $kategoriData = $this->getKategoriData();

        $rules = [
            'judul' => 'required|min_length[5]|max_length[255]',
            'kategori' => 'required|in_list[' . implode(',', $kategoriData) . ']',
            'peraturan' => 'required|max_length[255]',
            'file_lampiran' => [
                'rules' => 'permit_empty|max_size[file_lampiran,10240]|ext_in[file_lampiran,pdf,doc,docx]',
                'errors' => [
                    'max_size' => 'Ukuran file maksimal 10MB',
                    'ext_in' => 'File harus berformat PDF, DOC, atau DOCX'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'judul' => $this->request->getPost('judul'),
            'kategori' => $this->request->getPost('kategori'),
            'peraturan' => $this->request->getPost('peraturan'),
        ];

        // Handle file upload if new file is provided
        $file = $this->request->getFile('file_lampiran');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Delete old file
            $oldFilePath = ROOTPATH . 'public/uploads/peraturan/' . $peraturan['file_lampiran'];
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }

            // Upload new file
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/peraturan', $newName);
            $data['file_lampiran'] = $newName;
        }

        if ($this->peraturanModel->update($id, $data)) {
            return redirect()->to('/user/peraturan')->with('success', 'Peraturan berhasil diperbarui.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui peraturan.');
    }

    /**
     * Delete peraturan
     */
    public function delete($id)
    {
        $userId = $this->getCurrentUserId();
        $peraturan = $this->peraturanModel
            ->where('user_id', $userId)
            ->find($id);

        if (!$peraturan) {
            return redirect()->to('/user/peraturan')->with('error', 'Peraturan tidak ditemukan.');
        }

        // Delete file
        $filePath = ROOTPATH . 'public/uploads/peraturan/' . $peraturan['file_lampiran'];
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        if ($this->peraturanModel->delete($id)) {
            return redirect()->to('/user/peraturan')->with('success', 'Peraturan berhasil dihapus.');
        }

        return redirect()->to('/user/peraturan')->with('error', 'Gagal menghapus peraturan.');
    }

    /**
     * Download file peraturan
     */
    public function download($id)
    {
        $userId = $this->getCurrentUserId();
        $peraturan = $this->peraturanModel
            ->where('user_id', $userId)
            ->find($id);

        if (!$peraturan) {
            return redirect()->to('/user/peraturan')->with('error', 'Peraturan tidak ditemukan.');
        }

        $filePath = ROOTPATH . 'public/uploads/peraturan/' . $peraturan['file_lampiran'];

        if (!file_exists($filePath)) {
            return redirect()->to('/user/peraturan')->with('error', 'File tidak ditemukan.');
        }

        return $this->response->download($filePath, null);
    }

    /**
     * Get the count of published regulations
     */
    public function getPublishedRegulationsCount()
    {
        $userId = $this->getCurrentUserId();
        return $this->peraturanModel
            ->where('user_id', $userId)
            ->where('status', 'published')
            ->countAllResults();
    }
}
