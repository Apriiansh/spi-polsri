<?php

namespace App\Controllers;

use App\Models\PeraturanModel;
use CodeIgniter\Controller;

class PublicPeraturanController extends BaseController
{
    protected $peraturanModel;

    public function __construct()
    {
        $this->peraturanModel = new PeraturanModel();
    }

    /**
     * Data kategori peraturan.
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

    /**
     * Menampilkan daftar peraturan dengan fitur pencarian dan filter.
     * Hanya menampilkan peraturan dengan status 'published'.
     */
    public function index()
    {
        $search = $this->request->getVar('search');
        $kategori_filter = $this->request->getVar('kategori');

        $peraturan = $this->peraturanModel->where('status', 'published');

        if ($search) {
            $peraturan = $peraturan->groupStart()
                ->like('judul', $search)
                ->orLike('peraturan', $search)
                ->groupEnd();
        }

        if ($kategori_filter) {
            $peraturan = $peraturan->where('kategori', $kategori_filter);
        }

        $data = [
            'title' => 'Daftar Peraturan',
            'peraturan' => $peraturan->orderBy('created_at', 'DESC')->paginate(10),
            'pager' => $this->peraturanModel->pager,
            'search' => $search,
            'kategori_filter' => $kategori_filter,
            'kategoriData' => $this->getKategoriData(),
        ];

        return view('publics/peraturan/index', $data);
    }

    /**
     * Menampilkan detail peraturan berdasarkan ID.
     * Hanya menampilkan peraturan dengan status 'published'.
     *
     * @param int $id ID dari peraturan
     */
    public function show($id)
    {
        $peraturan = $this->peraturanModel
            ->select("peraturan.*, COALESCE(users.username, 'Admin') as username")
            ->join('users', 'users.id = peraturan.user_id', 'left')
            ->where('peraturan.id', $id)
            ->where('peraturan.status', 'published')
            ->first();

        if (!$peraturan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Peraturan tidak ditemukan: ' . $id);
        }

        $data = [
            'title' => $peraturan['judul'],
            'peraturan' => $peraturan,
        ];

        return view('publics/peraturan/show', $data);
    }

    /**
     * Mengunduh file lampiran dari peraturan yang sudah dipublikasikan.
     */
    public function download($id)
    {
        $peraturan = $this->peraturanModel
            ->where('id', $id)
            ->where('status', 'published')
            ->first();

        if (!$peraturan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File peraturan tidak ditemukan atau belum dipublikasikan.');
        }

        $filePath = ROOTPATH . 'public/uploads/peraturan/' . $peraturan['file_lampiran'];

        if (!file_exists($filePath)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('File tidak ditemukan di server.');
        }

        return $this->response->download($filePath, null);
    }

    /**
     * Menampilkan daftar peraturan berdasarkan kategori.
     *
     * @param string $categorySlug Slug dari kategori
     */
    public function byCategory($categorySlug)
    {
        $kategoriMapping = [
            'akuntansi-keuangan' => 'Akuntansi/Keuangan',
            'hukum' => 'Hukum',
            'manajemen-sdm' => 'Manajemen SDM',
            'manajemen-aset' => 'Manajemen Aset',
            'ketatalaksanaan' => 'Ketatalaksanaan',
        ];

        if (!array_key_exists($categorySlug, $kategoriMapping)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kategori peraturan tidak ditemukan.');
        }

        $kategori = $kategoriMapping[$categorySlug];

        $peraturan = $this->peraturanModel->where('status', 'published')->where('kategori', $kategori);

        $data = [
            'title' => 'Peraturan ' . $kategori,
            'kategori' => $kategori,
            'peraturan' => $peraturan->orderBy('created_at', 'DESC')->paginate(10),
            'pager' => $this->peraturanModel->pager,
        ];

        return view('publics/peraturan/by_category', $data);
    }
}