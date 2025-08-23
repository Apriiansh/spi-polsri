<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\ArticleModel;

class ArtikelController extends BaseController
{
    protected $articleModel;

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
    }

    public function index()
    {
        $userId = session()->get('user_id');
        $articles = $this->articleModel
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->findAll();

        return view('user/artikel/index', [
            'title' => 'Artikel Saya',
            'articles' => $articles
        ]);
    }

    public function create()
    {
        return view('user/artikel/create', [
            'title' => 'Tulis Artikel',
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function store()
    {
        $userId = session()->get('user_id');

        $rules = [
            'title' => 'required|min_length[5]|max_length[255]',
            'content' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $content = $this->request->getPost('content');
        if (json_decode($content) === null) {
            return redirect()->back()->withInput()->with('error', 'Format konten tidak valid.');
        }

        $data = [
            'user_id' => $userId,
            'title'   => $this->request->getPost('title'),
            'content' => $content,
            'status'  => 'pending'
        ];

        if ($this->articleModel->insert($data)) {
            return redirect()->to('/user/artikel')->with('success', 'Artikel berhasil dikirim dan menunggu penilaian admin.');
        }
        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan artikel.');
    }

    public function show($id)
    {
        $userId = session()->get('user_id');
        $article = $this->articleModel
            ->where('user_id', $userId)
            ->find($id);

        if (!$article) {
            return redirect()->to('/user/artikel')->with('error', 'Artikel tidak ditemukan.');
        }

        return view('user/artikel/show', [
            'title' => 'Detail Artikel',
            'article' => $article
        ]);
    }

    public function edit($id)
    {
        $userId = session()->get('user_id');
        $article = $this->articleModel
            ->where('user_id', $userId)
            ->where('status', 'pending') // Hanya boleh edit jika pending
            ->find($id);

        if (!$article) {
            return redirect()->to('/user/artikel')->with('error', 'Artikel tidak ditemukan atau sudah diverifikasi.');
        }

        return view('user/artikel/edit', [
            'title' => 'Edit Artikel',
            'article' => $article,
            'validation' => \Config\Services::validation(),
        ]);
    }

    public function update($id)
    {
        $userId = session()->get('user_id');
        $article = $this->articleModel
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->find($id);

        if (!$article) {
            return redirect()->to('/user/artikel')->with('error', 'Artikel tidak ditemukan atau sudah diverifikasi.');
        }

        $rules = [
            'title' => 'required|min_length[5]|max_length[255]',
            'content' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $content = $this->request->getPost('content');
        if (json_decode($content) === null) {
            return redirect()->back()->withInput()->with('error', 'Format konten tidak valid.');
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'content' => $content,
        ];

        if ($this->articleModel->update($id, $data)) {
            return redirect()->to('/user/artikel')->with('success', 'Artikel berhasil diperbarui.');
        }
        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui artikel.');
    }

    public function delete($id)
    {
        $userId = session()->get('user_id');
        $article = $this->articleModel
            ->where('user_id', $userId)
            ->find($id);

        if (!$article) {
            return redirect()->to('/user/artikel')->with('error', 'Artikel tidak ditemukan.');
        }

        if ($this->articleModel->delete($id)) {
            return redirect()->to('/user/artikel')->with('success', 'Artikel berhasil dihapus.');
        }
        return redirect()->to('/user/artikel')->with('error', 'Gagal menghapus artikel.');
    }
}
