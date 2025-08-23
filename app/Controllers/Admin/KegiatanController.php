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
            'Asurans' => ['Audit', 'Reviu'],
            'Konsultasi' => ['Analisis dan Evaluasi', 'Pelatihan'],
        ];
    }

    public function index()
    {
        $search = $this->request->getVar('search');
        $kategoriFilter = $this->request->getVar('kategori');
        $subkategoriFilter = $this->request->getVar('subkategori');
        $kegiatan = $this->kegiatanModel;

        if ($search) {
            $kegiatan = $kegiatan->like('judul', $search)
                                 ->orLike('kategori', $search)
                                 ->orLike('sub_kategori', $search);
        }

        if ($kategoriFilter) {
            $kegiatan = $kegiatan->where('kategori', $kategoriFilter);
        }

        if ($subkategoriFilter) {
            $kegiatan = $kegiatan->where('sub_kategori', $subkategoriFilter);
        }

        $data = [
            'title' => 'Manajemen Kegiatan',
            'kegiatan' => $kegiatan->orderBy('created_at', 'DESC')->paginate(10),
            'pager' => $this->kegiatanModel->pager,
            'search' => $search,
            'kategori_filter' => $kategoriFilter,
            'subkategori_filter' => $subkategoriFilter,
            'kategoriData' => $this->getKategoriData(),
        ];

        return view('admin/kegiatan/index', $data);
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
        $kategoriKeys = array_keys($kategoriData);
        
        $subKategoriValues = [];
        foreach ($kategoriData as $subs) {
            $subKategoriValues = array_merge($subKategoriValues, $subs);
        }
        $subKategoriValues = array_unique($subKategoriValues);

        $rules = [
            'judul' => 'required|min_length[5]|max_length[200]',
            'kategori' => 'required|in_list[' . implode(',', $kategoriKeys) . ']',
            'sub_kategori' => 'required|in_list[' . implode(',', $subKategoriValues) . ']',
            'konten' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $konten = $this->request->getPost('konten');
        if (json_decode($konten) === null) {
            return redirect()->back()->withInput()->with('error', 'Format konten tidak valid.');
        }

        $data = [
            'judul' => $this->request->getPost('judul'),
            'kategori' => $this->request->getPost('kategori'),
            'sub_kategori' => $this->request->getPost('sub_kategori'),
            'konten' => $konten,
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
        $kategoriKeys = array_keys($kategoriData);
        
        $subKategoriValues = [];
        foreach ($kategoriData as $subs) {
            $subKategoriValues = array_merge($subKategoriValues, $subs);
        }
        $subKategoriValues = array_unique($subKategoriValues);

        $rules = [
            'judul' => 'required|min_length[5]|max_length[200]',
            'kategori' => 'required|in_list[' . implode(',', $kategoriKeys) . ']',
            'sub_kategori' => 'required|in_list[' . implode(',', $subKategoriValues) . ']',
            'konten' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $konten = $this->request->getPost('konten');
        if (json_decode($konten) === null) {
            return redirect()->back()->withInput()->with('error', 'Format konten tidak valid.');
        }

        $data = [
            'judul' => $this->request->getPost('judul'),
            'kategori' => $this->request->getPost('kategori'),
            'sub_kategori' => $this->request->getPost('sub_kategori'),
            'konten' => $konten,
        ];

        if ($this->kegiatanModel->update($id, $data)) {
            return redirect()->to('/admin/kegiatan')->with('success', 'Kegiatan berhasil diperbarui.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui kegiatan.');
    }

    public function delete($id)
    {
        if ($this->kegiatanModel->delete($id)) {
            return redirect()->to('/admin/kegiatan')->with('success', 'Kegiatan berhasil dihapus.');
        } else {
            return redirect()->to('/admin/kegiatan')->with('error', 'Gagal menghapus kegiatan.');
        }
    }
    
    public function show($id)
    {
        $kegiatan = $this->kegiatanModel->find($id);
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