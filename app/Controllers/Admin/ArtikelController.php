<?php

namespace App\Controllers\Admin;

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
        $data = [
            'title' => 'Manajemen Artikel',
            'articles' => $this->articleModel
                ->select('articles.*, users.username') 
                ->join('users', 'users.id = articles.user_id')
                ->paginate(10, 'default'),
            'pager' => $this->articleModel->pager,
        ];
        
        return view('admin/artikel/index', $data);
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

        $this->articleModel->update($id, ['status' => $status]);

        return redirect()->back()->with('success', 'Status artikel berhasil diperbarui.');
    }

    public function show($id)
    {
        $article = $this->articleModel->find($id);

        if (!$article) {
            return redirect()->to('/admin/artikel')->with('error', 'Artikel tidak ditemukan.');
        }

        return view('admin/artikel/show', [
            'title' => 'Detail Artikel',
            'article' => $article
        ]);
    }
}
