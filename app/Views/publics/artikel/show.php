<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Hero Header -->
<div class="relative bg-gradient-to-br from-indigo-300 via-indigo-500 to-purple-500 overflow-hidden mb-12">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2 blur-2xl"></div>

    <div class="relative container mx-auto px-6 py-16 text-center">
        <div class="inline-block p-4 bg-white/10 backdrop-blur-sm rounded-2xl mb-6">
            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 16h10M5 12h14"></path>
            </svg>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4"><?= esc($artikel['title']); ?></h1>

        <div class="mt-4 text-white/80 flex flex-wrap justify-center items-center gap-2">
            <span class="inline-block text-white/80 ml-2">
                Dipublikasikan pada: <?= esc(date('d F Y', strtotime($artikel['created_at']))); ?>
            </span>
            <span class="inline-block text-white/80 ml-2">
                Oleh: <?= esc($artikel['username']); ?>
            </span>
        </div>


        <div class="mt-8 w-24 h-1 bg-indigo-200 mx-auto rounded-full"></div>
    </div>
</div>

<!-- Main Content -->
<div class="container mx-auto px-6 -mt-6 relative z-10">
    <div class="overflow-hidden p-8 border border-gray-100 bg-white rounded-2xl shadow-lg">
        <div class="prose max-w-none">
            <div id="quill-render"></div>
        </div>

        <div class="mt-8 text-center">
            <a href="<?= base_url('artikel'); ?>" class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7m11 0l-7 7 7 7"></path>
                </svg>
                Kembali ke Daftar Artikel
            </a>
        </div>
    </div>
</div>


<script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var quill = new Quill('#quill-render', {
            theme: 'snow',
            readOnly: true,
            modules: {
                toolbar: false
            }
        });

        // Ambil Delta JSON dari PHP
        var content = <?= $artikel['content']; ?>;
        quill.setContents(content);
    });
</script>

<?= $this->endSection() ?>