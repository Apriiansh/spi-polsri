<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use CodeIgniter\Controller;

class PublicArtikelController extends BaseController
{
    protected $artikelModel;

    public function __construct()
    {
        $this->artikelModel = new ArticleModel();
    }

    /**
     * Menampilkan daftar artikel dengan filter pencarian.
     */
    public function index()
    {
        $search = $this->request->getVar('search');

        $artikel = $this->artikelModel->where('status', 'verified');

        if ($search) {
            $artikel = $artikel->groupStart()
                ->like('title', $search)
                ->orLike('isi', $search)
                ->groupEnd();
        }

        $data = [
            'title'   => 'Daftar Artikel',
            'artikel' => $artikel->orderBy('created_at', 'DESC')->paginate(6),
            'pager'   => $this->artikelModel->pager,
            'search'  => $search,
        ];

        return view('publics/artikel/index', $data);
    }

    /**
     * Menampilkan detail artikel berdasarkan slug.
     *
     * @param string $slug Slug dari artikel
     */
    public function show($slug)
    {
        $artikel = $this->artikelModel
            ->where('status', 'verified')
            ->getArticleBySlugWithUser($slug);


        if (!$artikel) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Artikel tidak ditemukan: ' . $slug);
        }

        $data = [
            'title'   => $artikel['title'],
            'artikel' => $artikel,
        ];

        return view('publics/artikel/show', $data);
    }
}
