<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KegiatanModel;

class KegiatanController extends BaseController
{
    protected $kegiatanModel;

    public function __construct()
    {
        $this->kegiatanModel = new KegiatanModel();
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

    public function index()
    {
        $search = $this->request->getVar('search');
        $kategoriFilter = $this->request->getVar('kategori');

        $kegiatan = $this->kegiatanModel
            ->select('kegiatan.*, users.username')
            ->join('users', 'users.id = kegiatan.user_id', 'left');

        if ($search) {
            $kegiatan = $kegiatan->like('judul', $search)
                ->orLike('kategori', $search);
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

        return view('admin/kegiatan/index', $data);
    }

    public function updateStatus($id)
    {
        $rules = [
            'status' => [
                'rules' => 'required|in_list[pending,verified,rejected]',
                'errors' => [
                    'required' => 'Status harus diisi.',
                    'in_list' => 'Status tidak valid.'
                ]
            ]
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $status = $this->request->getPost('status');

        $this->kegiatanModel->update($id, ['status' => $status]);

        return redirect()->back()->with('success', 'Status kegiatan berhasil diperbarui.');
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kegiatan',
            'kategoriData' => $this->getKategoriData(),
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/kegiatan/create', $data);
    }

    public function store()
    {
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
        $slug   = $this->to_slug($judul);
        $konten = $this->request->getPost('konten');

        if (json_decode($konten) === null) {
            return redirect()->back()->withInput()->with('error', 'Format konten tidak valid.');
        }

        $data = [
            'judul'    => $judul,
            'slug'     => $slug,
            'kategori' => $this->request->getPost('kategori'),
            'konten'   => $konten,
            'user_id'  => session()->get('user_id'),
            'status'   => 'pending',
        ];

        if ($this->kegiatanModel->insert($data)) {
            return redirect()->to('/admin/kegiatan')->with('success', 'Kegiatan berhasil ditambahkan.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan kegiatan.');
    }

    public function edit($id)
    {
        $kegiatan = $this->kegiatanModel->find($id);
        if (!$kegiatan) {
            return redirect()->to('/admin/kegiatan')->with('error', 'Kegiatan tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Kegiatan',
            'kegiatan' => $kegiatan,
            'kategoriData' => $this->getKategoriData(),
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/kegiatan/edit', $data);
    }

    public function update($id)
    {
        $kegiatan = $this->kegiatanModel->find($id);
        if (!$kegiatan) {
            return redirect()->to('/admin/kegiatan')->with('error', 'Kegiatan tidak ditemukan.');
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
        $slug   = $this->to_slug($judul);
        $konten = $this->request->getPost('konten');

        if (json_decode($konten) === null) {
            return redirect()->back()->withInput()->with('error', 'Format konten tidak valid.');
        }

        $data = [
            'judul'    => $judul,
            'slug'     => $slug,
            'kategori' => $this->request->getPost('kategori'),
            'konten'   => $konten,
        ];

        if ($this->kegiatanModel->update($id, $data)) {
            return redirect()->to('/admin/kegiatan')->with('success', 'Kegiatan berhasil diperbarui.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui kegiatan.');
    }

    public function delete($id)
    {
        $kegiatan = $this->kegiatanModel->find($id);
        if (!$kegiatan) {
            return redirect()->to('/admin/kegiatan')->with('error', 'Kegiatan tidak ditemukan.');
        }

        if ($this->kegiatanModel->delete($id)) {
            return redirect()->to('/admin/kegiatan')->with('success', 'Kegiatan berhasil dihapus.');
        } else {
            return redirect()->to('/admin/kegiatan')->with('error', 'Gagal menghapus kegiatan.');
        }
    }

    public function show($slug)
    {
        $kegiatan = $this->kegiatanModel->where('slug', $slug)->first();
        if (!$kegiatan) {
            return redirect()->to('/admin/kegiatan')->with('error', 'Kegiatan tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail Kegiatan',
            'kegiatan' => $kegiatan,
        ];

        return view('admin/kegiatan/show', $data);
    }
}
