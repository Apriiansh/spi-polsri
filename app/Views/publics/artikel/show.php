<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<!-- Hero Header -->
<div class="relative bg-gradient-to-br from-blue-300 via-blue-500 to-cyan-500 overflow-hidden pt-5 mb-12">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2 blur-2xl"></div>

    <div class="relative container mx-auto px-6 py-16 text-center">
        <div class="inline-block p-4 bg-white/10 backdrop-blur-sm rounded-2xl mb-6">
            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
            </svg>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4"><?= esc($artikel['title']); ?></h1>

        <div class="mt-4 text-white/80 flex flex-wrap justify-center items-center gap-4">
            <span class="inline-flex items-center">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                <?= esc($artikel['username'] ?? 'Admin'); ?>
            </span>
            <span class="inline-flex items-center">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                <?= esc(date('d F Y', strtotime($artikel['created_at']))); ?>
            </span>
            <span class="inline-flex items-center bg-blue-300/30 text-white px-3 py-1 rounded-full text-xs font-semibold">
                <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Artikel
            </span>
        </div>

        <div class="mt-8 w-24 h-1 bg-blue-200 mx-auto rounded-full"></div>
    </div>
</div>

<!-- Main Content -->
<div class="container mx-auto px-6 -mt-6 relative z-10">
    <div class="overflow-hidden p-8 border border-gray-100">
        <div class="prose max-w-none text-slate-800">
            <style>
                .prose p {
                    line-height: 1.5;
                    margin-bottom: 1.25rem;
                }
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

                .prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
                    margin-bottom: 1rem;
                    margin-top: 1.5rem;
                }

                .prose img {
                    display: block;
                    width: 100%;
                    max-width: 800px;
                    height: 500px;
                    object-fit: cover;
                    object-position: center;
                    margin: 2rem auto;
                    border-radius: 0.75rem;
                    box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
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

                .prose blockquote,
                .prose pre {
                    margin-bottom: 1.25rem;
                }
            </style>
            <div id="quill-render"></div>
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

        var content = <?= $artikel['content']; ?>;
        quill.setContents(content);

        document.addEventListener('click', function(e) {
            if (e.target.tagName === 'IMG' && e.target.closest('.prose')) {
                const img = e.target;
                const overlay = document.createElement('div');
                overlay.className = 'fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 cursor-pointer';
                overlay.innerHTML = `
                    <div class="max-w-full max-h-full p-4">
                        <img src="${img.src}" alt="${img.alt || ''}" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">
                        <div class="text-white text-center mt-4 text-sm opacity-75">Klik untuk menutup</div>
                    </div>
                `;

                overlay.addEventListener('click', () => {
                    document.body.removeChild(overlay);
                    document.body.style.overflow = '';
                });

                document.body.appendChild(overlay);
                document.body.style.overflow = 'hidden';
            }
        });
    });
</script>

<?= $this->endSection() ?>
