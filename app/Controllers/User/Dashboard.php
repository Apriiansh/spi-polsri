<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\ArticleModel;
use CodeIgniter\HTTP\ResponseInterface;

class Dashboard extends BaseController
{
    public function index()
    {
        $articleModel = new ArticleModel();

        $userId = session()->get('user_id');
        $userName = session()->get('username');

        $createdArticles = $articleModel->where('user_id', $userId)->countAllResults();

        $publishedArticles = $articleModel
            ->where('user_id', $userId)
            ->where('status', 'published')
            ->countAllResults();

        $data = [
            'title' => 'Dashboard User',
            'userName' => $userName,
            'createdArticles' => $createdArticles,
            'publishedArticles' => $publishedArticles,
            'DocumentUploads' => 0,
        ];

        return view('user/dashboard', $data);

    }
}
