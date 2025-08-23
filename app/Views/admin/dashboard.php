<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content') ?>
<div class="space-y-10">
    <!-- Header Selamat Datang -->
    <div class="text-center space-y-4">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-slate-800 via-slate-700 to-slate-600 bg-clip-text text-transparent">
            Selamat Datang, Admin!
        </h1>
        <p class="text-slate-600 text-lg max-w-2xl mx-auto">
            Kelola sistem dengan mudah melalui dashboard yang telah disediakan
        </p>
    </div>

    <!-- Kartu Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Kartu Total Pengguna -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200/50">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-600 text-sm font-medium uppercase tracking-wider">Total Users</p>
                    <p class="text-3xl font-bold text-blue-900">1,234</p>
                </div>
                <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Kartu Laporan -->
        <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-2xl p-6 border border-emerald-200/50">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-600 text-sm font-medium uppercase tracking-wider">Laporan</p>
                    <p class="text-3xl font-bold text-emerald-900">56</p>
                </div>
                <div class="w-12 h-12 bg-emerald-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Kartu Artikel -->
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 border border-purple-200/50">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-600 text-sm font-medium uppercase tracking-wider">Artikel</p>
                    <p class="text-3xl font-bold text-purple-900">89</p>
                </div>
                <div class="w-12 h-12 bg-purple-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Kartu Kegiatan -->
        <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-2xl p-6 border border-orange-200/50">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-600 text-sm font-medium uppercase tracking-wider">Kegiatan</p>
                    <p class="text-3xl font-bold text-orange-900">23</p>
                </div>
                <div class="w-12 h-12 bg-orange-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Kartu Aksi Utama -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <!-- Manajemen Pengguna -->
        <div class="card-hover bg-white rounded-2xl shadow-lg border border-slate-200/50 p-8 group">
            <div class="flex items-start space-x-4">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center group-hover:scale-110 smooth-transition">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-blue-600 smooth-transition">
                        Manajemen Pengguna
                    </h3>
                    <p class="text-slate-600 mb-6 leading-relaxed">
                        Kelola semua akun pengguna terdaftar, verifikasi akun, dan atur hak akses dengan mudah.
                    </p>
                    <a href="<?= site_url('admin/users') ?>"
                        class="inline-flex items-center space-x-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-xl font-medium hover:from-blue-700 hover:to-blue-800 smooth-transition shadow-lg hover:shadow-xl">
                        <span>Lihat Pengguna</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Kelola Laporan -->
        <div class="card-hover bg-white rounded-2xl shadow-lg border border-slate-200/50 p-8 group">
            <div class="flex items-start space-x-4">
                <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center group-hover:scale-110 smooth-transition">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-emerald-600 smooth-transition">
                        Kelola Laporan
                    </h3>
                    <p class="text-slate-600 mb-6 leading-relaxed">
                        Verifikasi dan tangani laporan dari pengguna dengan sistem tracking yang terintegrasi.
                    </p>
                    <a href="<?= site_url('admin/laporan') ?>"
                        class="inline-flex items-center space-x-2 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white px-6 py-3 rounded-xl font-medium hover:from-emerald-700 hover:to-emerald-800 smooth-transition shadow-lg hover:shadow-xl">
                        <span>Lihat Laporan</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <!-- Kelola Konten -->
        <div class="card-hover bg-white rounded-2xl shadow-lg border border-slate-200/50 p-8 group">
            <div class="flex items-start space-x-4">
                <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center group-hover:scale-110 smooth-transition">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-slate-800 mb-2 group-hover:text-purple-600 smooth-transition">
                        Kelola Konten
                    </h3>
                    <p class="text-slate-600 mb-6 leading-relaxed">
                        Tambahkan, edit, atau hapus artikel dan berita dengan editor yang mudah digunakan.
                    </p>
                    <a href="<?= site_url('admin/articles') ?>"
                        class="inline-flex items-center space-x-2 bg-gradient-to-r from-purple-600 to-purple-700 text-white px-6 py-3 rounded-xl font-medium hover:from-purple-700 hover:to-purple-800 smooth-transition shadow-lg hover:shadow-xl">
                        <span>Kelola Artikel</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>