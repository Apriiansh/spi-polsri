<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php
$kategori_list = [
    'Pengaduan',
    'Lapor Gratifikasi'
];

$unit_kerja_list = [
    'Senat',
    'Pusat Penjamin Mutu',
    'Perencanaan Program dan Penganggaran',
    'UPT - Perpustakaan',
    'UPT - TIK',
    'Bag. Akademik dan Kemahasiswaan',
    'UPT - TP3A',
    'P3M',
    'Pusbangjar',
    'UPT - Bahasa',
    'Bag. Adm. Umum dan Keuangan',
    'UPT - LUK',
    'UPT - PK2',
];
?>

<!-- Background Gradient -->
<div class="min-h-screen bg-gradient-to-br from-sky-200 via-blue-500 to-sky-400 flex items-center justify-center px-4 py-10">
    <div class="w-full max-w-4xl bg-white/90 backdrop-blur-md rounded-3xl shadow-2xl p-6 sm:p-10 lg:p-16">

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-3">Buat Laporan</h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">Laporkan pelanggaran dengan mudah dan cepat. Setiap laporan Anda sangat berarti.</p>
        </div>

        <!-- Notifikasi -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="mb-6 px-5 py-4 rounded-xl bg-green-100 border border-green-300 text-green-800 text-center font-medium animate-fadeIn">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session('errors')): ?>
            <div class="mb-6 px-5 py-4 rounded-xl bg-red-100 border border-red-300 text-red-800 animate-fadeIn">
                <ul class="list-disc list-inside text-left">
                    <?php foreach (session('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Form -->
        <form action="<?= site_url('/laporan/store') ?>" method="post" enctype="multipart/form-data" class="space-y-6">
            <?= csrf_field() ?>

            <!-- Kategori Laporan -->
            <div>
                <label class="block mb-3 text-sm font-semibold text-gray-700">Kategori Laporan</label>
                <div class="flex flex-wrap gap-4">
                    <?php foreach ($kategori_list as $kategori): ?>
                        <label class="flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 cursor-pointer hover:bg-blue-50 transition">
                            <input type="radio" name="kategori_laporan" value="<?= esc($kategori) ?>"
                                class="text-blue-600 focus:ring-blue-500"
                                <?= old('kategori_laporan') == $kategori ? 'checked' : '' ?>>
                            <span class="text-gray-700"><?= esc($kategori) ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Judul -->
            <div>
                <label for="judul" class="block mb-2 text-sm font-semibold text-gray-700">Judul</label>
                <input type="text" id="judul" name="judul"
                    class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition p-3"
                    value="<?= old('judul') ?>" required autocomplete="off" placeholder="Contoh: Dugaan Korupsi Proyek X">
            </div>

            <!-- Isi Laporan -->
            <div>
                <label for="isi" class="block mb-2 text-sm font-semibold text-gray-700">Isi Laporan</label>
                <textarea id="isi" name="isi" rows="6" required
                    class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition p-3"
                    placeholder="Jelaskan secara rinci kejadian yang Anda laporkan..."><?= old('isi') ?></textarea>
            </div>

            <!-- Tanggal Kejadian -->
            <div>
                <label for="tgl_kejadian" class="block mb-2 text-sm font-semibold text-gray-700">Tanggal Kejadian</label>
                <input type="date" id="tgl_kejadian" name="tgl_kejadian"
                    class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition p-3"
                    value="<?= old('tgl_kejadian') ?>" required>
            </div>

            <!-- Lokasi Kejadian -->
            <div>
                <label for="lok_kejadian" class="block mb-2 text-sm font-semibold text-gray-700">Lokasi Kejadian</label>
                <input type="text" id="lok_kejadian" name="lok_kejadian"
                    class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition p-3"
                    value="<?= old('lok_kejadian') ?>" required autocomplete="off" placeholder="Contoh: Gedung A, Lantai 2">
            </div>

            <!-- Unit Kerja -->
            <div>
                <label for="unit_kerja" class="block mb-2 text-sm font-semibold text-gray-700">Unit Kerja Terkait</label>
                <select id="unit_kerja" name="unit_kerja" required
                    class="w-full rounded-xl border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition p-3">
                    <option value="" disabled <?= old('unit_kerja') ? '' : 'selected' ?>>Pilih unit kerja</option>
                    <?php foreach ($unit_kerja_list as $unit): ?>
                        <option value="<?= esc($unit) ?>" <?= old('unit_kerja') == $unit ? 'selected' : '' ?>>
                            <?= esc($unit) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Gambar Bukti -->
            <div>
                <label for="gambar_bukti" class="block mb-2 text-sm font-semibold text-gray-700">Gambar Bukti</label>
                <input type="file" id="gambar_bukti" name="gambar_bukti" accept="image/*" required
                    class="block w-full text-sm text-gray-500
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-lg file:border-0
                        file:text-sm file:font-semibold
                        file:bg-blue-100 file:text-blue-700
                        hover:file:bg-blue-200 cursor-pointer">
                <p id="file-name" class="mt-2 text-sm text-gray-500"></p>
            </div>

            <!-- Submit -->
            <div class="text-center pt-4">
                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-full shadow-lg transition transform hover:scale-105">
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('gambar_bukti').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name;
        document.getElementById('file-name').textContent = fileName ? `File dipilih: ${fileName}` : '';
    });

    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('tgl_kejadian');
        const today = new Date().toISOString().split('T')[0];
        dateInput.max = today;
    });
</script>

<?= $this->endSection() ?>