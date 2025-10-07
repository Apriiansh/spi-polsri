<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ArticleModel;
use App\Models\KegiatanModel;

class SearchController extends BaseController
{
    public function index()
    {
        $keyword = $this->request->getGet('q');
        $results = [];

        if ($keyword) {
            $articleModel = new ArticleModel();
            $kegiatanModel = new KegiatanModel();

            $articles = $articleModel->search($keyword);
            $kegiatans = $kegiatanModel->search($keyword);

            foreach ($articles as $article) {
                $results[] = [
                    'title' => $article['title'],
                    'url'   => base_url('artikel/' . $article['slug']),
                    'type'  => 'Artikel'
                ];
            }

            foreach ($kegiatans as $kegiatan) {
                $results[] = [
                    'title' => $kegiatan['judul'],
                    'url'   => base_url('kegiatan/' . $kegiatan['slug']),
                    'type'  => 'Kegiatan'
                ];
            }
        }

        return $this->response->setJSON($results);
    }
}
