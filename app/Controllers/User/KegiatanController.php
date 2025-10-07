<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\KegiatanModel;

class KegiatanController extends BaseController
{
    protected $kegiatanModel;

    public function __construct()
    {
        $this->kegiatanModel = new KegiatanModel();

        if (!session()->has('user_id') || !session()->get('user_id')) {
            session()->setFlashdata('error', 'Silakan login terlebih dahulu');
            header('Location: ' . base_url('/login'));
            exit();
        }
    }

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

    private function getCurrentUserId()
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            throw new \Exception('User tidak terautentikasi');
        }

        return $userId;
    }

    public function index()
    {
        $search = $this->request->getVar('search');
        $kategoriFilter = $this->request->getVar('kategori');

        $kegiatan = $this->kegiatanModel->where('user_id', $this->getCurrentUserId());

        if ($search) {
            $kegiatan = $kegiatan->groupStart()
                ->like('judul', $search)
                ->orLike('kategori', $search)
                ->groupEnd();
        }

        if ($kategoriFilter) {
            $kegiatan = $kegiatan->where('kategori', $kategoriFilter);
        }

        $data = [
            'title' => 'Manajemen Kegiatan',
            'kegiatan' => $kegiatan->orderBy('created_at', 'DESC')->paginate(10),
            'pager' => $this->kegiatanModel->pager,
            'search' => $search,
            'kategori_filter' => $kategoriFilter,
            'kategoriData' => $this->getKategoriData(),
        ];

        return view('user/kegiatan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kegiatan',
            'kategoriData' => $this->getKategoriData(),
            'validation' => \Config\Services::validation(),
        ];

        return view('user/kegiatan/create', $data);
    }

    public function store()
    {
        try {
            $userId = $this->getCurrentUserId();
        } catch (\Exception $e) {
            return redirect()->to('/login')->with('error', 'Session expired. Silakan login kembali.');
        }

        $kategoriData = $this->getKategoriData();

        $rules = [
            'judul'    => 'required|min_length[5]|max_length[200]',
            'kategori' => 'required|in_list[' . implode(',', $kategoriData) . ']',
            'konten'   => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $judul  = $this->request->getPost('judul');
        $konten = $this->request->getPost('konten');

        if (json_decode($konten) === null) {
            return redirect()->back()->withInput()->with('error', 'Format konten tidak valid.');
        }

        $data = [
            'user_id'  => $userId,
            'judul'    => $judul,
            'slug'     => $this->to_slug($judul),
            'kategori' => $this->request->getPost('kategori'),
            'konten'   => $konten,
            'status'   => 'pending',
        ];

        if ($this->kegiatanModel->insert($data)) {
            return redirect()->to('/user/kegiatan')->with('success', 'Kegiatan berhasil ditambahkan. Menunggu verifikasi admin.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan kegiatan.');
    }

    public function edit($id)
    {
        $kegiatan = $this->kegiatanModel->find($id);

        if (!$kegiatan) {
            return redirect()->to('/user/kegiatan')->with('error', 'Kegiatan tidak ditemukan.');
        }

        if ($kegiatan['user_id'] != $this->getCurrentUserId()) {
            return redirect()->to('/user/kegiatan')->with('error', 'Anda tidak memiliki izin untuk mengakses sumber daya ini.');
        }

        $data = [
            'title' => 'Edit Kegiatan',
            'kegiatan' => $kegiatan,
            'kategoriData' => $this->getKategoriData(),
            'validation' => \Config\Services::validation(),
        ];

        return view('user/kegiatan/edit', $data);
    }

    public function update($id)
    {
        $kegiatan = $this->kegiatanModel->find($id);

        if (!$kegiatan) {
            return redirect()->to('/user/kegiatan')->with('error', 'Kegiatan tidak ditemukan.');
        }

        if ($kegiatan['user_id'] != $this->getCurrentUserId()) {
            return redirect()->to('/user/kegiatan')->with('error', 'Anda tidak memiliki izin untuk mengakses sumber daya ini.');
        }

        $kategoriData = $this->getKategoriData();

        $rules = [
            'judul'    => 'required|min_length[5]|max_length[200]',
            'kategori' => 'required|in_list[' . implode(',', $kategoriData) . ']',
            'konten'   => 'required',
        ];

        if ($this->request->getPost('judul') !== $kegiatan['judul']) {
            $rules['judul'] .= '|is_unique[kegiatan.judul]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $judul  = $this->request->getPost('judul');
        $konten = $this->request->getPost('konten');

        if (json_decode($konten) === null) {
            return redirect()->back()->withInput()->with('error', 'Format konten tidak valid.');
        }

        $data = [
            'judul'    => $judul,
            'slug'     => $this->to_slug($judul),
            'kategori' => $this->request->getPost('kategori'),
            'konten'   => $konten,
        ];

        if ($this->kegiatanModel->update($id, $data)) {
            return redirect()->to('/user/kegiatan')->with('success', 'Kegiatan berhasil diperbarui.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui kegiatan.');
    }

    public function delete($id)
    {
        $kegiatan = $this->kegiatanModel->find($id);

        if (!$kegiatan) {
            return redirect()->to('/user/kegiatan')->with('error', 'Kegiatan tidak ditemukan.');
        }

        if ($kegiatan['user_id'] != $this->getCurrentUserId()) {
            return redirect()->to('/user/kegiatan')->with('error', 'Anda tidak memiliki izin untuk menghapus kegiatan ini.');
        }

        if ($this->kegiatanModel->delete($id)) {
            return redirect()->to('/user/kegiatan')->with('success', 'Kegiatan berhasil dihapus.');
        }

        return redirect()->to('/user/kegiatan')->with('error', 'Gagal menghapus kegiatan.');
    }

    public function show($slug)
    {
        $kegiatan = $this->kegiatanModel->where('slug', $slug)->first();

        if (!$kegiatan) {
            return redirect()->to('/user/kegiatan')->with('error', 'Kegiatan tidak ditemukan.');
        }

        if ($kegiatan['user_id'] != $this->getCurrentUserId()) {
            return redirect()->to('/user/kegiatan')->with('error', 'Anda tidak memiliki izin untuk melihat kegiatan ini.');
        }

        $data = [
            'title' => 'Detail Kegiatan',
            'kegiatan' => $kegiatan,
        ];

        return view('user/kegiatan/show', $data);
    }
}