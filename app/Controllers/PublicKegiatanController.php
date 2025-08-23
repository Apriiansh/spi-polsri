<?php

namespace App\Controllers;

use App\Models\KegiatanModel;
use CodeIgniter\Controller;

class PublicKegiatanController extends BaseController
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
        $kategori_filter = $this->request->getVar('kategori');
        $subkategori_filter = $this->request->getVar('subkategori');

        $kegiatan = $this->kegiatanModel;

        if ($search) {
            $kegiatan = $kegiatan->like('judul', $search);
        }

        if ($kategori_filter) {
            $kegiatan = $kegiatan->where('kategori', $kategori_filter);
        }

        if ($subkategori_filter) {
            $kegiatan = $kegiatan->where('sub_kategori', $subkategori_filter);
        }

        $data = [
            'title' => 'Daftar Kegiatan',
            'kegiatan' => $kegiatan->orderBy('created_at', 'DESC')->paginate(10),
            'pager' => $this->kegiatanModel->pager,
            'search' => $search,
            'kategori_filter' => $kategori_filter,
            'subkategori_filter' => $subkategori_filter,
            'kategoriData' => $this->getKategoriData(),
        ];

        return view('publics/kegiatan/index', $data);
    }

    public function show($id)
    {
        $kegiatan = $this->kegiatanModel->find($id);

        if (!$kegiatan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kegiatan tidak ditemukan: ' . $id);
        }

        $data = [
            'title' => $kegiatan['judul'],
            'kegiatan' => $kegiatan,
        ];

        return view('publics/kegiatan/show', $data);
    }
}
