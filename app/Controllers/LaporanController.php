<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LaporanModel;

class LaporanController extends BaseController
{
    public function create()
    {
        return view('publics/laporan/create');
    }

    public function store()
    {
        $laporanModel = new LaporanModel();

        // Validasi input
        $validationRules = [
            'kategori_laporan' => 'required',
            'judul'            => 'required',
            'isi'              => 'required',
            'tgl_kejadian'     => 'required|valid_date',
            'lok_kejadian'     => 'required',
            'gambar_bukti'     => 'uploaded[gambar_bukti]|max_size[gambar_bukti,2048]|is_image[gambar_bukti]',
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle upload file
        $gambar = $this->request->getFile('gambar_bukti');
        $namaGambar = '';
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            $namaGambar = $gambar->getRandomName();
            $gambar->move('uploads/bukti', $namaGambar);
        }

        // Simpan ke database
        $data = [
            'kategori_laporan' => $this->request->getVar('kategori_laporan'),
            'judul'            => $this->request->getVar('judul'),
            'isi'              => $this->request->getVar('isi'),
            'tgl_kejadian'     => $this->request->getVar('tgl_kejadian'),
            'lok_kejadian'     => $this->request->getVar('lok_kejadian'),
            'gambar_bukti'     => $namaGambar,
            'status_laporan'   => 'pending'
        ];

        $laporanModel->insert($data);

        return redirect()->to('/laporan/create')->with('success', 'Laporan berhasil dikirim.');
    }
}
