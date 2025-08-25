<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Hero Header -->
<div class="relative bg-gradient-to-br from-blue-300 via-blue-500 to-cyan-500 overflow-hidden mb-12">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2 blur-2xl"></div>

    <div class="relative container mx-auto px-6 py-16 text-center">
        <div class="inline-block p-4 bg-white/10 backdrop-blur-sm rounded-2xl mb-6">
            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
            </svg>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4"><?= esc($kegiatan['judul']); ?></h1>

        <div class="mt-4 text-white/80 flex flex-wrap justify-center items-center gap-2">
            <span class="inline-block bg-blue-300/30 text-white px-3 py-1 rounded-full text-xs font-semibold"><?= esc($kegiatan['kategori']); ?></span>
            <span class="inline-block bg-green-300/30 text-white px-3 py-1 rounded-full text-xs font-semibold"><?= esc($kegiatan['sub_kategori']); ?></span>
            <span class="inline-block text-white/80 ml-2">Dibuat pada: <?= esc(date('d F Y', strtotime($kegiatan['created_at']))); ?></span>
        </div>

        <div class="mt-8 w-24 h-1 bg-blue-200 mx-auto rounded-full"></div>
    </div>
</div>

<!-- Main Content -->
<div class="container mx-auto px-6 -mt-6 relative z-10">
    <div class="overflow-hidden p-8 border border-gray-100">
        <div class="prose max-w-none">
            <style>
                .prose ul,
                .prose ol {
                    list-style-type: decimal;
                    margin-top: 0.6rem;
                    margin-bottom: 1rem;
                    padding-left: 1.5rem;
                }

                .prose li {
                    margin-bottom: 0.5rem;
                }

                .prose img {
                    display: block;
                    max-width: 100%;
                    width: 100%;
                    height: 400px;
                    /* bisa disesuaikan (misal 300px/500px) */
                    object-fit: contain;
                    object-position: center;
                    margin: 1rem auto;
                    border-radius: 0.75rem;
                }

                .prose .ql-align-center {
                    text-align: center;
                    margin-bottom: 1rem;
                }

                .prose .ql-align-right {
                    text-align: right;
                }

                .prose .ql-align-justify {
                    text-align: justify;
                }
            </style>
            <?= $kegiatan['konten']; ?>
        </div>

        <div class="mt-8 text-center">
            <a href="<?= base_url('kegiatan'); ?>" class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7m11 0l-7 7 7 7"></path>
                </svg>
                Kembali ke Daftar Kegiatan
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>