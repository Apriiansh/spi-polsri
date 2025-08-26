<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\LaporanModel;
use App\Models\ArticleModel;
use App\Models\KegiatanModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $laporanModel = new LaporanModel();
        $articleModel = new ArticleModel();
        $kegiatanModel = new KegiatanModel();

        // Data untuk kartu statistik
        $totalUsers = $userModel->countAll();
        $totalReports = $laporanModel->countAll();
        $totalArticles = $articleModel->countAll();
        $totalEvents = $kegiatanModel->countAll();

        // Data untuk chart - 6 bulan terakhir
        $chartData = $this->getChartData($laporanModel, $articleModel, $kegiatanModel);

        $data = [
            'totalUsers'    => $totalUsers,
            'totalReports'  => $totalReports,
            'totalArticles' => $totalArticles,
            'totalEvents'   => $totalEvents,
            'chartLabels'   => $chartData['labels'],
            'chartReports'  => $chartData['reports'],
            'chartArticles' => $chartData['articles'],
            'chartEvents'   => $chartData['events'],
        ];

        // if ($totalUsers === 0 && $totalReports === 0 && $totalArticles === 0 && $totalEvents === 0) {
        //     $data['totalUsers']    = 12;
        //     $data['totalReports']  = 7;
        //     $data['totalArticles'] = 23;
        //     $data['totalEvents']   = 5;
        //     $data['chartReports']  = [2, 1, 0, 3, 1, 0];
        //     $data['chartArticles'] = [5, 4, 2, 6, 4, 2];
        //     $data['chartEvents']   = [1, 0, 2, 1, 0, 1];
        // } 
        // elseif (array_sum($data['chartReports']) === 0 && array_sum($data['chartArticles']) === 0 && array_sum($data['chartEvents']) === 0) {
        //     // Jika tidak ada aktivitas di chart, isi dengan data dummy agar tidak kosong
        //     $data['chartReports']  = [2, 1, 0, 3, 1, 0];
        //     $data['chartArticles'] = [5, 4, 2, 6, 4, 2];
        //     $data['chartEvents']   = [1, 0, 2, 1, 0, 1];
        // }

        return view('admin/dashboard', $data);
    }

    private function getChartData($laporanModel, $articleModel, $kegiatanModel)
    {
        $labels = [];
        $reports = [];
        $articles = [];
        $events = [];

        // Generate data untuk 6 bulan terakhir
        for ($i = 5; $i >= 0; $i--) {
            $time = strtotime("-{$i} months");
            $startDate = date('Y-m-01 00:00:00', $time);
            $endDate = date('Y-m-t 23:59:59', $time);
            $monthName = date('M Y', $time);

            $labels[] = $monthName;

            // Hitung laporan per bulan
            $reports[] = $laporanModel
                ->where('created_at >=', $startDate)
                ->where('created_at <=', $endDate)
                ->countAllResults();

            // Hitung artikel per bulan
            $articles[] = $articleModel
                ->where('created_at >=', $startDate)
                ->where('created_at <=', $endDate)
                ->countAllResults();

            // Hitung kegiatan per bulan
            $events[] = $kegiatanModel
                ->where('created_at >=', $startDate)
                ->where('created_at <=', $endDate)
                ->countAllResults();
        }

        return [
            'labels'   => $labels,
            'reports'  => $reports,
            'articles' => $articles,
            'events'   => $events,
        ];
    }
}
