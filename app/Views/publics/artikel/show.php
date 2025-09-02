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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4"><?= esc($artikel['title']); ?></h1>

        <div class="mt-4 text-white/80 flex flex-wrap justify-center items-center gap-2">
            <span class="inline-block bg-blue-300/30 text-white px-3 py-1 rounded-full text-xs font-semibold">
                 Dipublikasikan pada: <?= esc(date('d F Y', strtotime($artikel['updated_at']))); ?>
            </span>
            <span class="inline-block text-white/80 ml-2">
                by: <?= esc($artikel['username']); ?>
            </span>
        </div>

        <div class="mt-8 w-24 h-1 bg-blue-200 mx-auto rounded-full"></div>
    </div>
</div>

<!-- Main Content -->
<div class="container mx-auto px-6 my-6 relative z-10">
    <!-- Back Button - Top Left of Content -->
    <div class="mb-6">
        <a href="<?= base_url('artikel'); ?>" class="inline-flex items-center justify-center w-12 h-12 bg-white/90 backdrop-blur-sm text-gray-700 rounded-full hover:bg-white hover:shadow-lg focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-md">
            <i class="fas fa-arrow-left text-lg"></i>
        </a>
    </div>

    <div class="overflow-hidden p-8 bg-white rounded-xl">
        <div class="prose max-w-none">
            <style>
                /* Base prose styling */
                .prose {
                    color: #1e293b;
                    font-size: 1rem;
                    line-height: 1.7;
                }

                /* Headings */
                .prose h1,
                .prose h2,
                .prose h3,
                .prose h4,
                .prose h5,
                .prose h6 {
                    color: #1f2937;
                    font-weight: 700;
                    margin-top: 2rem;
                    margin-bottom: 1rem;
                    line-height: 1.3;
                }

                .prose h1 {
                    font-size: 2.25rem;
                    margin-top: 0;
                }

                .prose h2 {
                    font-size: 1.875rem;
                    padding-bottom: 0.5rem;
                }

                .prose h3 {
                    font-size: 1.5rem;
                }

                .prose h4 {
                    font-size: 1.25rem;
                }

                /* Paragraphs */
                .prose p {
                    margin-top: 1.25rem;
                    margin-bottom: 1.25rem;
                    text-align: justify;
                }

                .prose p:first-child {
                    margin-top: 0;
                }

                /* Lists */
                .prose ul,
                .prose ol {
                    margin-top: 1.25rem;
                    margin-bottom: 1.25rem;
                    padding-left: 1.75rem;
                }

                .prose ul {
                    list-style-type: disc;
                }

                .prose ol {
                    list-style-type: decimal;
                }

                .prose li {
                    margin-top: 0.5rem;
                    margin-bottom: 0.5rem;
                    line-height: 1.6;
                }

                .prose li>p {
                    margin-top: 0.75rem;
                    margin-bottom: 0.75rem;
                }

                .prose ul>li::marker {
                    color: #3b82f6;
                }

                .prose ol>li::marker {
                    color: #3b82f6;
                    font-weight: 600;
                }

                /* Links */
                .prose a {
                    color: #3b82f6;
                    text-decoration: underline;
                    font-weight: 500;
                    transition: color 0.2s;
                }

                .prose a:hover {
                    color: #1d4ed8;
                }

                /* Images */
                .prose img {
                    display: block;
                    max-width: 80%;
                    width: 70%;
                    height: auto;
                    max-height: 500px;
                    object-fit: fit;
                    object-position: center;
                    margin: 2rem auto;
                    border-radius: 0.75rem;
                    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
                    border: 1px solid #e5e7eb;
                }

                /* Blockquotes */
                .prose blockquote {
                    font-style: italic;
                    font-weight: 500;
                    color: #6b7280;
                    border-left: 4px solid #3b82f6;
                    padding-left: 1.5rem;
                    margin: 2rem 0;
                    background-color: #f8fafc;
                    padding: 1.5rem;
                    border-radius: 0.5rem;
                }

                .prose blockquote p {
                    margin: 0;
                }

                /* Code blocks */
                .prose pre {
                    background-color: #1f2937;
                    color: #f3f4f6;
                    border-radius: 0.5rem;
                    padding: 1.5rem;
                    margin: 1.5rem 0;
                    overflow-x: auto;
                    font-size: 0.875rem;
                    line-height: 1.7;
                }

                .prose code {
                    background-color: #f3f4f6;
                    color: #dc2626;
                    padding: 0.25rem 0.5rem;
                    border-radius: 0.25rem;
                    font-size: 0.875rem;
                    font-weight: 600;
                }

                .prose pre code {
                    background-color: transparent;
                    color: inherit;
                    padding: 0;
                    border-radius: 0;
                    font-weight: normal;
                }

                /* Tables */
                .prose table {
                    width: 100%;
                    border-collapse: collapse;
                    margin: 2rem 0;
                    border: 1px solid #e5e7eb;
                    border-radius: 0.5rem;
                    overflow: hidden;
                }

                .prose thead {
                    background-color: #f9fafb;
                }

                .prose th,
                .prose td {
                    padding: 0.75rem 1rem;
                    text-align: left;
                    border-bottom: 1px solid #e5e7eb;
                }

                .prose th {
                    font-weight: 600;
                    color: #374151;
                }

                .prose tbody tr:hover {
                    background-color: #f9fafb;
                }

                /* Horizontal rules */
                .prose hr {
                    border: none;
                    height: 2px;
                    background: linear-gradient(to right, #3b82f6, #06b6d4);
                    margin: 3rem 0;
                    border-radius: 1px;
                }

                /* Quill alignment classes */
                .prose .ql-align-center {
                    text-align: center;
                }

                .prose .ql-align-right {
                    text-align: right;
                }

                .prose .ql-align-justify {
                    text-align: justify;
                }

                /* Quill font size classes */
                .prose .ql-size-small {
                    font-size: 0.875rem;
                }

                .prose .ql-size-large {
                    font-size: 1.125rem;
                }

                .prose .ql-size-huge {
                    font-size: 1.5rem;
                }

                /* Quill formatting */
                .prose strong {
                    font-weight: 700;
                    color: #1f2937;
                }

                .prose em {
                    font-style: italic;
                }

                .prose u {
                    text-decoration: underline;
                }

                .prose s {
                    text-decoration: line-through;
                }

                /* Quill Editor Content Styling */
                #quill-render .ql-editor {
                    padding: 0;
                    border: none;
                    font-family: inherit;
                }

                #quill-render .ql-editor h1,
                #quill-render .ql-editor h2,
                #quill-render .ql-editor h3,
                #quill-render .ql-editor h4,
                #quill-render .ql-editor h5,
                #quill-render .ql-editor h6 {
                    margin-top: 2rem;
                    margin-bottom: 1rem;
                }

                #quill-render .ql-editor h1:first-child,
                #quill-render .ql-editor h2:first-child,
                #quill-render .ql-editor h3:first-child,
                #quill-render .ql-editor h4:first-child,
                #quill-render .ql-editor h5:first-child,
                #quill-render .ql-editor h6:first-child,
                #quill-render .ql-editor p:first-child {
                    margin-top: 0;
                }

                /* Override Quill CSS */
                .ql-container {
                    border: none !important;
                }

                .ql-editor {
                    border: none !important;
                    padding: 0 !important;
                }

                .ql-snow {
                    border: none !important;
                    box-shadow: none !important;
                }


                /* Responsive adjustments */
                @media (max-width: 640px) {
                    .prose {
                        font-size: 0.95rem;
                    }

                    .prose h1 {
                        font-size: 1.875rem;
                    }

                    .prose h2 {
                        font-size: 1.5rem;
                    }

                    .prose h3 {
                        font-size: 1.25rem;
                    }

                    .prose img {
                        margin: 1.5rem auto;
                        border-radius: 0.5rem;
                    }

                    .prose blockquote {
                        padding: 1rem;
                        margin: 1.5rem 0;
                    }
                }

                /* Print styles */
                @media print {
                    .prose {
                        font-size: 12pt;
                        line-height: 1.6;
                    }

                    .prose h1,
                    .prose h2,
                    .prose h3,
                    .prose h4,
                    .prose h5,
                    .prose h6 {
                        break-after: avoid;
                    }

                    .prose img {
                        max-height: 300px;
                    }
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

        // Ambil Delta JSON dari PHP
        var content = <?= $artikel['content']; ?>;
        quill.setContents(content);

        // Add loading state
        const quillContainer = document.getElementById('quill-render');
        if (quillContainer) {
            quillContainer.style.minHeight = '200px';

            // Add a subtle loading indicator
            const loadingDiv = document.createElement('div');
            loadingDiv.className = 'text-center text-gray-500 py-8';
            loadingDiv.innerHTML = '<div class="animate-pulse">Memuat konten artikel...</div>';
            quillContainer.appendChild(loadingDiv);

            // Remove loading indicator after content is loaded
            setTimeout(() => {
                const loading = quillContainer.querySelector('.animate-pulse');
                if (loading) {
                    loading.remove();
                }
            }, 1000);
        }

        // Enhance images with lightbox-like behavior
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