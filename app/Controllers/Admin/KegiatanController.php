<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\KegiatanModel;
use DOMDocument;

class KegiatanController extends BaseController
{
    protected $kegiatanModel;

    public function __construct()
    {
        $this->kegiatanModel = new KegiatanModel();
    }

    private function getKategoriData()
    {
        return [
            'Asurans' => ['Audit', 'Reviu'],
            'Konsultasi' => ['Analisis dan Evaluasi', 'Pelatihan'],
        ];
    }

    /**
     * Helper function untuk membuat slug dari string.
     * @param string $string
     * @return string
     */
    private function to_slug($string)
    {
        $string = strtolower($string); // Ubah ke huruf kecil
        $string = preg_replace('/[^a-z0-9\s\-]/', '', $string); // Hapus karakter non-alphanumeric, kecuali spasi dan strip
        $string = str_replace(' ', '-', $string); // Ganti spasi dengan strip
        $string = preg_replace('/-+/', '-', $string); // Hapus strip ganda
        $string = trim($string, '-'); // Hapus strip di awal/akhir
        return $string;
    }

    public function index()
    {
        $search = $this->request->getVar('search');
        $kategoriFilter = $this->request->getVar('kategori');
        $subkategoriFilter = $this->request->getVar('subkategori');
        $kegiatan = $this->kegiatanModel;

        if ($search) {
            $kegiatan = $kegiatan->like('judul', $search)
                ->orLike('kategori', $search)
                ->orLike('sub_kategori', $search);
        }

        if ($kategoriFilter) {
            $kegiatan = $kegiatan->where('kategori', $kategoriFilter);
        }

        if ($subkategoriFilter) {
            $kegiatan = $kegiatan->where('sub_kategori', $subkategoriFilter);
        }

        $data = [
            'title' => 'Manajemen Kegiatan',
            'kegiatan' => $kegiatan->orderBy('created_at', 'DESC')->paginate(10),
            'pager' => $this->kegiatanModel->pager,
            'search' => $search,
            'kategori_filter' => $kategoriFilter,
            'subkategori_filter' => $subkategoriFilter,
            'kategoriData' => $this->getKategoriData(),
        ];

        return view('admin/kegiatan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Kegiatan',
            'kategoriData' => $this->getKategoriData(),
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/kegiatan/create', $data);
    }

    public function store()
    {
        $kategoriData = $this->getKategoriData();
        $kategoriKeys = array_keys($kategoriData);

        $subKategoriValues = [];
        foreach ($kategoriData as $subs) {
            $subKategoriValues = array_merge($subKategoriValues, $subs);
        }
        $subKategoriValues = array_unique($subKategoriValues);

        $rules = [
            'judul' => 'required|min_length[5]|max_length[200]',
            'kategori' => 'required|in_list[' . implode(',', $kategoriKeys) . ']',
            'sub_kategori' => 'required|in_list[' . implode(',', $subKategoriValues) . ']',
            'konten' => 'required',
        ];

        $judul = $this->request->getPost('judul');
        $slug = $this->to_slug($judul);
        $konten = $this->request->getPost('konten');

        $data = [
            'judul' => $judul,
            'slug' => $slug,
            'kategori' => $this->request->getPost('kategori'),
            'sub_kategori' => $this->request->getPost('sub_kategori'),
            'konten' => $konten,
        ];

        if ($this->kegiatanModel->insert($data)) {
            return redirect()->to('/admin/kegiatan')->with('success', 'Kegiatan berhasil ditambahkan.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menambahkan kegiatan.');
    }

    public function edit($id)
    {
        $kegiatan = $this->kegiatanModel->find($id);
        if (!$kegiatan) {
            return redirect()->to('/admin/kegiatan')->with('error', 'Kegiatan tidak ditemukan.');
        }

        $data = [
            'title' => 'Edit Kegiatan',
            'kegiatan' => $kegiatan,
            'kategoriData' => $this->getKategoriData(),
            'validation' => \Config\Services::validation(),
        ];

        return view('admin/kegiatan/edit', $data);
    }

    public function update($id)
    {
        $kegiatan = $this->kegiatanModel->find($id);
        if (!$kegiatan) {
            return redirect()->to('/admin/kegiatan')->with('error', 'Kegiatan tidak ditemukan.');
        }

        $kategoriData = $this->getKategoriData();
        $kategoriKeys = array_keys($kategoriData);

        $subKategoriValues = [];
        foreach ($kategoriData as $subs) {
            $subKategoriValues = array_merge($subKategoriValues, $subs);
        }
        $subKategoriValues = array_unique($subKategoriValues);

        $rules = [
            'judul' => 'required|min_length[5]|max_length[200]',
            'kategori' => 'required|in_list[' . implode(',', $kategoriKeys) . ']',
            'sub_kategori' => 'required|in_list[' . implode(',', $subKategoriValues) . ']',
            'konten' => 'required',
        ];

        if ($this->request->getPost('judul') !== $kegiatan['judul']) {
            $rules['judul'] .= '|is_unique[kegiatan.judul]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $judul = $this->request->getPost('judul');
        $slug = $this->to_slug($judul);

        $konten = $this->request->getPost('konten');

        $data = [
            'judul' => $judul,
            'slug' => $slug,
            'kategori' => $this->request->getPost('kategori'),
            'sub_kategori' => $this->request->getPost('sub_kategori'),
            'konten' => $konten,
        ];

        if ($this->kegiatanModel->update($id, $data)) {
            return redirect()->to('/admin/kegiatan')->with('success', 'Kegiatan berhasil diperbarui.');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal memperbarui kegiatan.');
    }

    public function delete($id)
    {
        // 1. Ambil data kegiatan dari database sebelum dihapus
        $kegiatan = $this->kegiatanModel->find($id);

        if (!$kegiatan) {
            return redirect()->to('/admin/kegiatan')->with('error', 'Kegiatan tidak ditemukan.');
        }

        // 2. Gunakan DOMDocument untuk mem-parsing konten HTML
        $dom = new DOMDocument();
        // Gunakan @ untuk menekan peringatan HTML parsing yang tidak valid
        @$dom->loadHTML($kegiatan['konten'], LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        // 3. Cari semua tag <img>
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $img) {
            $src = $img->getAttribute('src');

            // 4. Periksa apakah URL gambar ada di direktori uploads/kegiatan
            if (strpos($src, base_url('uploads/kegiatan/')) !== false) {
                // Ekstrak nama file dari URL
                $filename = basename($src);
                $filePath = ROOTPATH . 'public/uploads/kegiatan/' . $filename;

                // 5. Hapus file jika ada
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        // 6. Hapus data dari database
        if ($this->kegiatanModel->delete($id)) {
            return redirect()->to('/admin/kegiatan')->with('success', 'Kegiatan berhasil dihapus.');
        } else {
            return redirect()->to('/admin/kegiatan')->with('error', 'Gagal menghapus kegiatan.');
        }
    }

    /**
     * Menampilkan detail kegiatan berdasarkan slug.
     * @param string $slug
     */
    public function show($slug)
    {
        $kegiatan = $this->kegiatanModel->where('slug', $slug)->first();
        if (!$kegiatan) {
            return redirect()->to('/admin/kegiatan')->with('error', 'Kegiatan tidak ditemukan.');
        }

        $data = [
            'title' => 'Detail Kegiatan',
            'kegiatan' => $kegiatan,
        ];

        return view('admin/kegiatan/show', $data);
    }

    public function uploadImage()
    {
        $validationRule = [
            'image' => [
                'label' => 'Gambar',
                'rules' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/gif]|max_size[image,2048]',
                'errors' => [
                    'uploaded' => 'Tidak ada gambar yang diunggah.',
                    'is_image' => 'File bukan gambar.',
                    'mime_in' => 'Format gambar tidak didukung.',
                    'max_size' => 'Ukuran gambar terlalu besar. Maksimal 2MB.'
                ]
            ]
        ];

        if (!$this->validate($validationRule)) {
            return $this->response->setJSON(['error' => $this->validator->getError('image')]);
        }

        $img = $this->request->getFile('image');

        if ($img && $img->isValid()) {
            $newName = $img->getRandomName();
            try {
                $img->move(ROOTPATH . 'public/uploads/kegiatan', $newName);
                $url = base_url('uploads/kegiatan/' . $newName);
                return $this->response->setJSON(['url' => $url]);
            } catch (\Exception $e) {
                // Memberikan pesan error yang lebih spesifik
                return $this->response->setJSON(['error' => 'Gagal memindahkan file: ' . $e->getMessage()]);
            }
        }

        // Penanganan kasus di mana $img tidak valid atau tidak diunggah dengan benar
        return $this->response->setJSON(['error' => 'Gagal mengunggah gambar. Pastikan file valid dan tidak ada masalah di sisi server.']);
    }
}
