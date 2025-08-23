<?= $this->extend('layout/user_main') ?>

<?= $this->section('content') ?>
<div class="space-y-10">
    <!-- Header Selamat Datang Pengguna -->
    <div class="text-center space-y-4">
        <h1 class="text-4xl font-bold bg-gradient-to-r from-slate-800 via-slate-700 to-slate-600 bg-clip-text text-transparent">
            Selamat Datang, Pengguna!
        </h1>
        <p class="text-slate-600 text-lg max-w-2xl mx-auto">
            Temukan informasi terbaru dan kelola aktivitas Anda dengan mudah.
        </p>
    </div>

    <!-- Kartu Statistik Pengguna -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Kartu Artikel Disimpan -->
        <div class="bg-gradient-to-br from-teal-50 to-teal-100 rounded-2xl p-6 border border-teal-200/50">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-teal-600 text-sm font-medium uppercase tracking-wider">Artikel Disimpan</p>
                    <p class="text-3xl font-bold text-teal-900">12</p>
                </div>
                <div class="w-12 h-12 bg-teal-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Kartu Laporan Terkirim -->
        <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 rounded-2xl p-6 border border-indigo-200/50">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-indigo-600 text-sm font-medium uppercase tracking-wider">Laporan Terkirim</p>
                    <p class="text-3xl font-bold text-indigo-900">3</p>
                </div>
                <div class="w-12 h-12 bg-indigo-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M16 16h.01"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Kartu Kegiatan Diikuti -->
        <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 rounded-2xl p-6 border border-yellow-200/50">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-yellow-600 text-sm font-medium uppercase tracking-wider">Kegiatan Diikuti</p>
                    <p class="text-3xl font-bold text-yellow-900">5</p>
                </div>
                <div class="w-12 h-12 bg-yellow-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

</div>
<?= $this->endSection() ?>