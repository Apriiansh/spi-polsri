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
            'title' => 'Visi & Misi - SPI POLSRI'
        ];
        return view('publics/visimisi', $data);
    }

    /**
     * Helper function untuk mengambil data peraturan berdasarkan kategori
     * agar tidak terjadi duplikasi kode.
     */
    private function getPeraturanData(string $kategori): array
    {
        return [
            'title'          => 'Peraturan: ' . $kategori,
            'kategori'       => $kategori,
            'items'          => $this->kegiatanModel->where('kategori', $kategori)->where('status', 'verified')->orderBy('created_at', 'DESC')->paginate(10, 'default'),
            'pager'          => $this->kegiatanModel->pager,
        ];
    }

    public function peraturan_akuntansi_keuangan()
    {
        $data = $this->getPeraturanData('Akuntansi/Keuangan');
        return view('publics/peraturan/akuntansi_keuangan', $data);
    }

    public function peraturan_hukum()
    {
        $data = $this->getPeraturanData('Hukum');
        return view('publics/peraturan/hukum', $data);
    }

    public function peraturan_manajemen_sdm()
    {
        $data = $this->getPeraturanData('Manajemen SDM');
        return view('publics/peraturan/manajemen_sdm', $data);
    }

    public function peraturan_manajemen_aset()
    {
        $data = $this->getPeraturanData('Manajemen Aset');
        return view('publics/peraturan/manajemen_aset', $data);
    }

    public function peraturan_ketatalaksanaan()
    {
        $data = $this->getPeraturanData('Ketatalaksanaan');
        return view('publics/peraturan/ketatalaksanaan', $data);
    }
}