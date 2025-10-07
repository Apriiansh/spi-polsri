<?php

namespace App\Controllers;

use App\Models\KegiatanModel;
use CodeIgniter\Controller;
use nadar\quill\Lexer;

class PublicKegiatanController extends BaseController
{
    protected $kegiatanModel;

    public function __construct()
    {
        $this->kegiatanModel = new KegiatanModel();
    }

    /**
     * Data kategori kegiatan.
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
     * Menampilkan daftar kegiatan dengan fitur pencarian dan filter.
     * Hanya menampilkan kegiatan dengan status 'verified'.
     */
    public function index()
    {
        $search = $this->request->getVar('search');
        $kategori_filter = $this->request->getVar('kategori');

        $kegiatan = $this->kegiatanModel->where('status', 'verified');

        if ($search) {
            $kegiatan = $kegiatan->like('judul', $search);
        }

        if ($kategori_filter) {
            $kegiatan = $kegiatan->where('kategori', $kategori_filter);
        }

        $data = [
            'title' => 'Daftar Kegiatan',
            'kegiatan' => $kegiatan->orderBy('created_at', 'DESC')->paginate(6),
            'pager' => $this->kegiatanModel->pager,
            'search' => $search,
            'kategori_filter' => $kategori_filter,
            'kategoriData' => $this->getKategoriData(),
        ];

        return view('publics/kegiatan/index', $data);
    }

    /**
     * Menampilkan detail kegiatan berdasarkan slug.
     * Hanya menampilkan kegiatan dengan status 'verified'.
     * Mendukung parsing konten Quill JSON menjadi HTML.
     *
     * @param string $slug Slug dari kegiatan
     */
    public function show($slug)
    {
        $kegiatan = $this->kegiatanModel
            ->select("kegiatan.*, COALESCE(users.username, 'Admin') as username")
            ->join('users', 'users.id = kegiatan.user_id', 'left')
            ->where('kegiatan.slug', $slug)
            ->where('kegiatan.status', 'verified')
            ->first();

        if (!$kegiatan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kegiatan tidak ditemukan: ' . $slug);
        }

        // Render konten Quill JSON ke HTML jika formatnya JSON
        $renderedContent = $kegiatan['konten'];
        if ($this->isJson($kegiatan['konten'])) {
            try {
                $lexer = new Lexer($kegiatan['konten']);
                $renderedContent = $lexer->render();
            } catch (\Exception $e) {
                $renderedContent = '<p>Gagal merender konten kegiatan.</p>';
            }
        }

        $data = [
            'title' => $kegiatan['judul'],
            'kegiatan' => $kegiatan,
            'renderedContent' => $renderedContent,
        ];

        return view('publics/kegiatan/show', $data);
    }

    /**
     * Mengecek apakah string adalah JSON valid.
     */
    private function isJson($string)
    {
        json_decode($string);
        return (json_last_error() === JSON_ERROR_NONE);
    }
}
