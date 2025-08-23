<?php

namespace App\Controllers;

use App\Models\KegiatanModel;

class Home extends BaseController
{
    protected $kegiatanModel;

    public function __construct()
    {
        $this->kegiatanModel = new KegiatanModel();
    }

    public function index(): string
    {
        $data = [
            'title' => 'Beranda - SPI POLSRI',
            'kegiatan_terbaru' => $this->kegiatanModel->orderBy('created_at', 'DESC')->limit(3)->findAll()
        ];
        return view('publics/index', $data);
    }

    public function sejarah(): string
    {
        $data = [
            'title' => 'Sejarah - SPI POLSRI'
        ];
        return view('publics/sejarah', $data);
    }

    public function struktur(): string
    {
        $data = [
            'title' => 'Struktur Organisasi - SPI POLSRI'
        ];
        return view('publics/strukturorganisasi', $data);
    }

    public function visimisi(): string
    {
        $data = [
            'title' => 'Visi dan Misi - SPI POLSRI'
        ];
        return view('publics/visimisi', $data);
    }
}