<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php
// Daftar kategori, bisa disesuaikan sesuai kebutuhan
$kategori_list = [
    'Penyalahgunaan Wewenang',
    'Korupsi',
    'Gratifikasi',
    'Pungli',
    'Pelanggaran Etika',
    'Lainnya'
];
?>

<div class="container mx-auto max-w-xl p-6">
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden px-8 py-10">
        <h1 class="text-3xl font-semibold text-gray-800 mb-8 text-center">Buat Laporan Baru</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="mb-4 px-4 py-3 rounded bg-green-100 border border-green-300 text-green-800 text-center">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session('errors')): ?>
            <div class="mb-4 px-4 py-3 rounded bg-red-100 border border-red-300 text-red-800">
                <ul class="list-disc pl-5">
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="<?= site_url('/laporan/store') ?>" method="post" enctype="multipart/form-data" class="space-y-5">
            <?= csrf_field() ?>
            <div>
                <label for="kategori_laporan" class="block mb-2 text-sm font-medium text-gray-700">Kategori Laporan</label>
                <select class="form-control block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" id="kategori_laporan" name="kategori_laporan" required>
                    <option value="" disabled <?= old('kategori_laporan') ? '' : 'selected' ?>>Pilih kategori laporan</option>
                    <?php foreach ($kategori_list as $kategori): ?>
                        <option value="<?= esc($kategori) ?>" <?= old('kategori_laporan') == $kategori ? 'selected' : '' ?>>
                            <?= esc($kategori) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label for="judul" class="block mb-2 text-sm font-medium text-gray-700">Judul</label>
                <input type="text" class="form-control block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" id="judul" name="judul" value="<?= old('judul') ?>" required autocomplete="off">
            </div>
            <div>
                <label for="isi" class="block mb-2 text-sm font-medium text-gray-700">Isi Laporan</label>
                <textarea class="form-control block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" id="isi" name="isi" rows="4" required><?= old('isi') ?></textarea>
            </div>
            <div>
                <label for="tgl_kejadian" class="block mb-2 text-sm font-medium text-gray-700">Tanggal Kejadian</label>
                <input type="date" class="form-control block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" id="tgl_kejadian" name="tgl_kejadian" value="<?= old('tgl_kejadian') ?>" required>
            </div>
            <div>
                <label for="lok_kejadian" class="block mb-2 text-sm font-medium text-gray-700">Lokasi Kejadian</label>
                <input type="text" class="form-control block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" id="lok_kejadian" name="lok_kejadian" value="<?= old('lok_kejadian') ?>" required autocomplete="off">
            </div>
            <div>
                <label for="gambar_bukti" class="block mb-2 text-sm font-medium text-gray-700">Gambar Bukti</label>
                <input type="file" class="form-control block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500" id="gambar_bukti" name="gambar_bukti" accept="image/*" required>
                <span id="preview-gambar-bukti" class="text-xs text-gray-500 mt-1"></span>
            </div>
            <div class="text-center pt-3">
                <button type="submit" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-2 rounded-lg shadow transition">Kirim Laporan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Preview file name when selected
    document.getElementById('gambar_bukti').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name;
        document.getElementById('preview-gambar-bukti').textContent = fileName ? 'File: ' + fileName : '';
    });

    // Set max date to today
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('tgl_kejadian');
        const today = new Date().toISOString().split('T')[0];
        dateInput.max = today;
    });
</script>

<?= $this->endSection() ?>