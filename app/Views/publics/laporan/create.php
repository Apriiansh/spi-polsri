<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php
$klasifikasi_list = [
    'Pengaduan',
    'Aspirasi'
];

$kategori_list = [
    'Akuntansi / Keuangan',
    'Hukum',
    'Manajemen SDM',
    'Manajemen Aset',
    'Ketatalaksanaan'
];

$unit_non_akademik_list = [
    'Senat',
    'Pusat Penjamin Mutu',
    'Perencanaan Program dan Penganggaran',
    'Unit Pelaksana Teknis - Perpustakaan',
    'Unit Pelaksana Teknis - Teknologi Informasi dan Komunikasi',
    'Bagian Akademik dan Kemahasiswaan',
    'Unit Pelaksana Teknis - Teknologi Permesinan dan Peralatan Penunjang Akademik',
    'Pusat Penelitian dan Pengabdian Masyarakat',
    'Pusat Pengembangan Pembelajaran',
    'Unit Pelaksana Teknis - Bahasa',
    'Bagian Administrasi Umum dan Keuangan',
    'Unit Pelaksana Teknis - Layanan Uji Kompetensi',
    'Unit Pelaksana Teknis - Pengembangan Karir dan Kewirausahaan',
];

$unit_akademik_list = [
    'Jurusan Teknik Sipil',
    'Jurusan Teknik Mesin',
    'Jurusan Teknik Elektro',
    'Jurusan Teknik Kimia',
    'Jurusan Teknik Komputer',
    'Jurusan Akuntansi',
    'Jurusan Administrasi Bisnis',
    'Jurusan Bahasa Inggris',
    'Jurusan Manajemen Informatika',
];
?>

<div class="min-h-screen bg-gradient-to-br from-sky-200 via-blue-500 to-sky-400 flex items-center justify-center sm:mt-14 lg:mt-4  px-4 py-10">
    <div class="w-full max-w-4xl bg-white/90 backdrop-blur-md rounded-sm shadow-2xl p-6 sm:p-10 lg:p-16">

        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-3">Buat Laporan</h1>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">Laporkan pelanggaran dengan mudah dan cepat. Setiap laporan Anda sangat berarti.</p>
        </div>

        <!-- Notifikasi -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="mb-6 px-5 py-4 rounded-sm bg-green-100 border border-green-300 text-green-800 text-center font-medium animate-fadeIn">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session('errors')): ?>
            <div class="mb-6 px-5 py-4 rounded-sm bg-red-100 border border-red-300 text-red-800 animate-fadeIn">
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

            <!-- Klasifikasi Laporan -->
            <div>
                <label class="block mb-3 text-sm font-semibold text-gray-800">Klasifikasi Laporan</label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php foreach ($klasifikasi_list as $klasifikasi): ?>
                        <label class="flex items-center gap-2 px-4 py-2 rounded-sm border border-gray-300 cursor-pointer hover:bg-blue-50 transition">
                            <input type="radio" name="klasifikasi_laporan" value="<?= esc($klasifikasi) ?>" required
                                class="text-blue-600 focus:ring-blue-500"
                                <?= old('klasifikasi_laporan') == $klasifikasi ? 'checked' : '' ?>>
                            <span class="text-gray-800"><?= esc($klasifikasi) ?></span>
                        </label>
                    <?php endforeach; ?>
                </div>
            </div>

            <div>
                <label for="email_pelapor" class="block mb-2 text-sm font-semibold text-gray-800">Email</label>
                <input type="email" id="email_pelapor" name="email_pelapor"
                    class="w-full rounded-sm border-gray-400 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition p-3"
                    value="<?= old('email_pelapor') ?>" required autocomplete="off">
            </div>

            <!-- Judul -->
            <div>
                <label for="judul" class="block mb-2 text-sm font-semibold text-gray-800">Judul</label>
                <input type="text" id="judul" name="judul"
                    class="w-full rounded-sm border-gray-400 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition p-3"
                    value="<?= old('judul') ?>" required autocomplete="off" placeholder="Tulis judul laporan Anda di sini...">
            </div>

            <!-- Isi Laporan -->
            <div>
                <label for="isi" class="block mb-2 text-sm font-semibold text-gray-800">Isi Laporan</label>
                <textarea id="isi" name="isi" rows="6" required
                    class="w-full rounded-sm border-gray-400 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition p-3"
                    placeholder="Jelaskan detail kejadian secara rinci..."><?= old('isi') ?></textarea>
            </div>

            <!-- Tanggal Kejadian -->
            <div>
                <label for="tgl_kejadian" class="block mb-2 text-sm font-semibold text-gray-800">Tanggal Kejadian</label>
                <input type="date" id="tgl_kejadian" name="tgl_kejadian"
                    class="w-full rounded-sm border-gray-400 text-gray-900 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition p-3"
                    value="<?= old('tgl_kejadian') ?>" required>
            </div>

            <!-- Lokasi Kejadian -->
            <div>
                <label for="lok_kejadian" class="block mb-2 text-sm font-semibold text-gray-800">Lokasi Kejadian</label>
                <input type="text" id="lok_kejadian" name="lok_kejadian"
                    class="w-full rounded-sm border-gray-400 text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition p-3"
                    value="<?= old('lok_kejadian') ?>" required autocomplete="off" placeholder="Contoh: Gedung A, Lantai 2">
            </div>

            <!-- Tipe Unit Kerja -->
            <div>
                <label class="block mb-3 text-sm font-semibold text-gray-800">Tipe Unit Kerja</label>
                <div class="flex flex-wrap gap-4">
                    <label class="flex items-center gap-2 px-4 py-2 rounded-sm border border-gray-300 cursor-pointer hover:bg-blue-50 transition">
                        <input type="radio" name="tipe_unit" value="akademik" class="tipe-unit-radio text-blue-600 focus:ring-blue-500">
                        <span class="text-gray-800">Akademik</span>
                    </label>
                    <label class="flex items-center gap-2 px-4 py-2 rounded-sm border border-gray-300 cursor-pointer hover:bg-blue-50 transition">
                        <input type="radio" name="tipe_unit" value="non-akademik" class="tipe-unit-radio text-blue-600 focus:ring-blue-500">
                        <span class="text-gray-800">Non-Akademik</span>
                    </label>
                </div>
            </div>

            <!-- Unit Kerja Detail (Dropdown) -->
            <div id="unit_kerja_container" class="hidden">
                <label for="unit_kerja" class="block mb-2 text-sm font-semibold text-gray-800">Pilih Unit Kerja/Jurusan Terkait</label>
                <select id="unit_kerja" name="unit_kerja"
                    class="w-full text-sm text-gray-900 rounded-sm border-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition p-3">
                </select>
            </div>

            <!-- Kategori Laporan -->
            <div>
                <label for="kategori_laporan" class="block mb-2 text-sm font-semibold text-gray-800">Kategori Laporan</label>
                <select id="kategori_laporan" name="kategori_laporan" required
                    class="w-full text-sm text-gray-900 rounded-sm border-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition p-3">
                    <option value="" disabled selected>Pilih kategori laporan</option>
                    <?php foreach ($kategori_list as $kategori): ?>
                        <option value="<?= esc($kategori) ?>" <?= old('kategori_laporan') == $kategori ? 'selected' : '' ?>><?= esc($kategori) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Gambar Bukti -->
            <div>
                <label for="gambar_bukti" class="block mb-2 text-sm font-semibold text-gray-800">Gambar Bukti</label>
                <input type="file" id="gambar_bukti" name="gambar_bukti" accept="image/*"
                    class="block w-full text-sm text-gray-700
                        file:mr-4 file:py-2 file:px-4
                        file:rounded-sm file:border-0
                        file:text-sm file:font-semibold
                        file:bg-blue-100 file:text-blue-700
                        hover:file:bg-blue-200 cursor-pointer">
                <p id="file-name" class="mt-2 text-sm text-gray-600"></p>
            </div>

            <!-- Submit -->
            <div class="text-center pt-4">
                <button type="submit" class="w-full sm:w-auto px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-sm shadow-lg transition transform hover:scale-105">
                    Kirim Laporan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Alur Proses Section -->
<div class="bg-white py-16 px-4">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Alur Proses Laporan</h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">Pahami bagaimana laporan Anda akan diproses dan ditindaklanjuti</p>
        </div>

        <!-- Process Steps -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 items-center">
            <!-- Step 1 -->
            <div class="relative text-center">
                <div class="relative z-10 bg-white px-2">
                    <div class="mx-auto w-16 h-16 bg-blue-500 rounded-sm flex items-center justify-center mb-4 shadow-lg">
                        <i class="fas fa-file-alt text-white text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">1. Buat Laporan</h3>
                    <p class="text-gray-600 text-sm">Isi form laporan dengan detail yang jelas dan lengkap beserta bukti pendukung</p>
                </div>
                <!-- Panah ke kanan -->
                <div class="hidden lg:block absolute top-1/2 right-[-32px] transform -translate-y-1/2">
                    <i class="fas fa-arrow-right text-blue-400 text-3xl"></i>
                </div>
            </div>
            <!-- Step 2 -->
            <div class="relative text-center">
                <div class="relative z-10 bg-white px-2">
                    <div class="mx-auto w-16 h-16 bg-green-500 rounded-sm flex items-center justify-center mb-4 shadow-lg">
                        <i class="fas fa-user-check text-white text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">2. Verifikasi</h3>
                    <p class="text-gray-600 text-sm">Laporan akan diverifikasi dan diteruskan kepada Direktur</p>
                </div>
                <div class="hidden lg:block absolute top-1/2 right-[-32px] transform -translate-y-1/2">
                    <i class="fas fa-arrow-right text-green-400 text-3xl"></i>
                </div>
            </div>
            <!-- Step 3 -->
            <div class="relative text-center">
                <div class="relative z-10 bg-white px-2">
                    <div class="mx-auto w-16 h-16 bg-yellow-500 rounded-sm flex items-center justify-center mb-4 shadow-lg">
                        <i class="fas fa-search text-white text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">3. Investigasi</h3>
                    <p class="text-gray-600 text-sm">Unit terkait melakukan penyelidikan mendalam terhadap laporan yang diterima</p>
                </div>
                <div class="hidden lg:block absolute top-1/2 right-[-32px] transform -translate-y-1/2">
                    <i class="fas fa-arrow-right text-yellow-400 text-3xl"></i>
                </div>
            </div>
            <!-- Step 4 -->
            <div class="relative text-center">
                <div class="relative z-10 bg-white px-2">
                    <div class="mx-auto w-16 h-16 bg-purple-500 rounded-sm flex items-center justify-center mb-4 shadow-lg">
                        <i class="fas fa-check-circle text-white text-3xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">4. Tindak Lanjut</h3>
                    <p class="text-gray-600 text-sm">Pelaksanaan solusi dan tindakan korektif berdasarkan hasil investigasi</p>
                </div>
                <!-- Tidak perlu panah di step terakhir -->
            </div>
        </div>

        <!-- Timeline Information -->
        <div class="mt-12 bg-gradient-to-r from-blue-50 to-sky-50 rounded-sm p-8 border border-blue-100">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                <div>
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-blue-100 rounded-sm mb-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-1">Pasti di Respon</h4>
                    <p class="text-gray-600 text-sm">Laporan segera ditindaklanjuti</p>
                </div>
                <div>
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-green-100 rounded-sm mb-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-1">Kerahasiaan Terjamin</h4>
                    <p class="text-gray-600 text-sm">Data pelapor dilindungi</p>
                </div>
                <div>
                    <div class="inline-flex items-center justify-center w-12 h-12 bg-purple-100 rounded-sm mb-3">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5v-5zM10.07 14.93l-6.36 6.36a1.5 1.5 0 01-2.12-2.12l6.36-6.36M3 3l18 18"></path>
                        </svg>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-1">Transparansi</h4>
                    <p class="text-gray-600 text-sm">Update status secara berkala</p>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="mt-8 text-center">
            <p class="text-gray-600 mb-2">Butuh bantuan atau informasi lebih lanjut?</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="mailto:spi@polsri.ac.id" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 text-blue-700 rounded-sm hover:bg-blue-200 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    spi@polsri.ac.id
                </a>
                <a href="tel:0711-313949" class="inline-flex items-center gap-2 px-4 py-2 bg-green-100 text-green-700 rounded-sm hover:bg-green-200 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    (0711) 313-949
                </a>
            </div>
        </div>
    </div>
</div>

<?php
$laporanModel = model('LaporanModel');

// Total seluruh laporan
$totalLaporan = $laporanModel->countAll();

// Statistik per status
$statusCounts = [
    'in_progress' => $laporanModel->where('status_laporan', 'in_progress')->countAllResults(),
    'completed'   => $laporanModel->where('status_laporan', 'completed')->countAllResults(),
];

// Mapping status ke label dan ikon Font Awesome
$statusMap = [
    'total' => [
        'label' => 'Total Laporan',
        'icon'  => 'fas fa-list-alt',
        'color' => 'bg-blue-100 text-blue-700'
    ],
    'in_progress' => [
        'label' => 'Diproses',
        'icon'  => 'fas fa-spinner',
        'color' => 'bg-yellow-100 text-yellow-700'
    ],
    'completed' => [
        'label' => 'Selesai',
        'icon'  => 'fas fa-check-circle',
        'color' => 'bg-green-100 text-green-700'
    ]
    ];
?>

<!-- Statistik Laporan -->
<div class="max-w-6xl mx-auto mt-12 mb-8">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900 mb-2">Statistik Laporan</h2>
        <p class="text-gray-600">Status laporan yang masuk ke sistem</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Laporan -->
        <div class="flex flex-col items-center justify-center rounded-lg shadow bg-white p-6">
            <div class="mb-3 inline-flex items-center justify-center w-12 h-12 <?= $statusMap['total']['color'] ?> rounded-full">
                <i class="<?= $statusMap['total']['icon'] ?> text-2xl"></i>
            </div>
            <div class="font-semibold text-gray-900"><?= $statusMap['total']['label'] ?></div>
            <div class="text-3xl font-bold text-blue-700 mt-1"><?= $totalLaporan ?></div>
        </div>
        <!-- In Progress -->
        <div class="flex flex-col items-center justify-center rounded-lg shadow bg-white p-6">
            <div class="mb-3 inline-flex items-center justify-center w-12 h-12 <?= $statusMap['in_progress']['color'] ?> rounded-full">
                <i class="<?= $statusMap['in_progress']['icon'] ?> text-2xl"></i>
            </div>
            <div class="font-semibold text-gray-900"><?= $statusMap['in_progress']['label'] ?></div>
            <div class="text-3xl font-bold text-blue-700 mt-1"><?= $statusCounts['in_progress'] ?></div>
        </div>
        <!-- Completed -->
        <div class="flex flex-col items-center justify-center rounded-lg shadow bg-white p-6">
            <div class="mb-3 inline-flex items-center justify-center w-12 h-12 <?= $statusMap['completed']['color'] ?> rounded-full">
                <i class="<?= $statusMap['completed']['icon'] ?> text-2xl"></i>
            </div>
            <div class="font-semibold text-gray-900"><?= $statusMap['completed']['label'] ?></div>
            <div class="text-3xl font-bold text-blue-700 mt-1"><?= $statusCounts['completed'] ?></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // File input name display
        const fileInput = document.getElementById('gambar_bukti');
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name;
                const fileNameDisplay = document.getElementById('file-name');
                if (fileNameDisplay) {
                    fileNameDisplay.textContent = fileName ? `File dipilih: ${fileName}` : '';
                }
            });
        }

        // Date input max date
        const dateInput = document.getElementById('tgl_kejadian');
        if (dateInput) {
            const today = new Date().toISOString().split('T')[0];
            dateInput.max = today;
        }

        // Dynamic Unit Kerja Dropdown
        const unitOptions = {
            akademik: <?= json_encode($unit_akademik_list) ?>,
            'non-akademik': <?= json_encode($unit_non_akademik_list) ?>
        };

        const tipeUnitRadios = document.querySelectorAll('.tipe-unit-radio');
        const unitKerjaContainer = document.getElementById('unit_kerja_container');
        const unitKerjaSelect = document.getElementById('unit_kerja');
        const oldUnitKerja = '<?= old('unit_kerja') ?>';

        function updateUnitKerjaDropdown(tipe) {
            const options = unitOptions[tipe] || [];
            unitKerjaSelect.innerHTML = '<option value="" disabled selected>Pilih unit kerja atau jurusan</option>'; // Reset
            unitKerjaSelect.required = true;

            options.forEach(unit => {
                const option = document.createElement('option');
                option.value = unit;
                option.textContent = unit;
                if (unit === oldUnitKerja) {
                    option.selected = true;
                }
                unitKerjaSelect.appendChild(option);
            });

            unitKerjaContainer.classList.remove('hidden');
        }

        tipeUnitRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.checked) {
                    updateUnitKerjaDropdown(this.value);
                }
            });
        });

        // Handle form validation errors and repopulate
        if (oldUnitKerja) {
            let oldTipe = '';
            if (unitOptions.akademik.includes(oldUnitKerja)) {
                oldTipe = 'akademik';
            } else if (unitOptions['non-akademik'].includes(oldUnitKerja)) {
                oldTipe = 'non-akademik';
            }

            if (oldTipe) {
                const radioToCheck = document.querySelector(`.tipe-unit-radio[value="${oldTipe}"]`);
                if (radioToCheck) {
                    radioToCheck.checked = true;
                    updateUnitKerjaDropdown(oldTipe);
                }
            }
        }
    });
</script>

<?= $this->endSection() ?>