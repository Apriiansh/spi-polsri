<?= $this->extend('layout/user_main') ?>

<?= $this->section('content') ?>
<div class="space-y-10">
    <!-- Header Selamat Datang Pengguna -->
    <div class="text-center space-y-4">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-slate-800 via-slate-700 to-slate-600 bg-clip-text text-transparent">
            Selamat Datang, <?= esc($userName ?? 'Pengguna') ?>!
        </h1>
        <p class="text-slate-600 text-lg max-w-2xl mx-auto">
            Kelola aktivitas Anda dengan mudah dan tetap terhubung dengan informasi terbaru.
        </p>
    </div>

    <!-- Kartu Statistik Pengguna -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Artikel Dibuat -->
        <div class="bg-gradient-to-br from-teal-50 to-teal-100 rounded-2xl p-6 border border-teal-200/50 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-teal-600 text-sm font-medium uppercase tracking-wider">Artikel Dibuat</p>
                    <p class="text-3xl font-bold text-teal-900"><?= $createdArticles ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-teal-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12l4-4m-4 4l4 4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Artikel Terpublikasi -->
        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-2xl p-6 border border-green-200/50 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-green-600 text-sm font-medium uppercase tracking-wider">Artikel Terpublikasi</p>
                    <p class="text-3xl font-bold text-green-900"><?= $publishedArticles ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Laporan Terkirim -->
        <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-2xl p-6 border border-indigo-200/50 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-indigo-600 text-sm font-medium uppercase tracking-wider">Dokumen Tersimpan</p>
                    <p class="text-3xl font-bold text-indigo-900"><?= $sentReports ?? 0 ?></p>
                </div>
                <div class="w-12 h-12 bg-indigo-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5h6m-3-3v6m-6 4h12M5 21h14a2 2 0 002-2V7a2 2 0 
                        00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Buat Artikel Baru -->
        <div class="bg-white rounded-2xl shadow-sm border p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-semibold text-gray-900">Buat Artikel Baru</h4>
                    <p class="text-sm text-gray-600">Tulis dan bagikan ide Anda</p>
                </div>
                <a href="<?= site_url('user/artikel/create') ?>"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-teal-700 bg-teal-100 hover:bg-teal-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Lihat Artikel Saya -->
        <div class="bg-white rounded-2xl shadow-sm border p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5h14M5 12h14M5 19h14"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-semibold text-gray-900">Artikel Saya</h4>
                    <p class="text-sm text-gray-600">Lihat artikel yang telah Anda buat</p>
                </div>
                <a href="<?= site_url('user/artikel') ?>"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>