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

    /**
     * Data dummy kategori dan subkategori.
     * Dalam aplikasi nyata, data ini biasanya diambil dari database.
     */
    private function getKategoriData()
    {
        return [
            'Asurans' => ['Audit', 'Reviu'],
            'Konsultasi' => ['Analisis dan Evaluasi', 'Pelatihan'],
        ];
    }

    /**
     * Menampilkan daftar kegiatan dengan fitur pencarian dan filter.
     */
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

    /**
     * Menampilkan detail kegiatan berdasarkan slug.
     *
     * @param string $slug Slug dari kegiatan
     */
    public function show($slug)
    {
        $kegiatan = $this->kegiatanModel->where('slug', $slug)->first();

        if (!$kegiatan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kegiatan tidak ditemukan: ' . $slug);
        }

        $data = [
            'title' => $kegiatan['judul'],
            'kegiatan' => $kegiatan,
        ];

        return view('publics/kegiatan/show', $data);
    }
}
