<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php
use nadar\quill\Lexer;

function render_quill_to_html($json)
{
    if (is_null($json) || trim($json) === '') {
        return '';
    }
    $decoded = json_decode($json, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        return $json;
    }
    try {
        $lexer = new Lexer($json);
        return $lexer->render();
    } catch (\Throwable $e) {
        return 'Konten tidak dapat ditampilkan.';
    }
}

function get_all_images_from_quill($json)
{
    $html = render_quill_to_html($json);
    $doc = new DOMDocument();
    @$doc->loadHTML($html);
    $tags = $doc->getElementsByTagName('img');
    $images = [];
    foreach ($tags as $tag) {
        $images[] = $tag->getAttribute('src');
    }
    return $images;
}

function get_first_paragraph_from_quill($json)
{
    $html = render_quill_to_html($json);
    $doc = new DOMDocument();
    @$doc->loadHTML($html);
    $paragraphs = $doc->getElementsByTagName('p');
    if ($paragraphs->length > 0) {
        $text = strip_tags($paragraphs->item(0)->nodeValue);
        return substr($text, 0, 150) . (strlen($text) > 150 ? '...' : '');
    }
    return 'Klik untuk melihat detail kegiatan ini...';
}
?>

<!-- Header Section -->
<div class="relative bg-gradient-to-br from-blue-300 via-blue-500 to-cyan-500 overflow-hidden pt-5 mb-12">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2 blur-2xl"></div>
    <div class="relative container mx-auto px-6 py-16 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600/80 rounded-full mb-6 shadow-lg">
            <i class="fas fa-calendar-alt text-white text-4xl"></i>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">KEGIATAN</h1>
        <div class="w-24 h-1 bg-white mx-auto rounded-full"></div>
    </div>
</div>

<!-- Grid Section -->
<div class="container mx-auto px-6 mb-12">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if (!empty($kegiatan)) : ?>
            <?php foreach ($kegiatan as $item) : ?>
                <?php
                $imageUrls = get_all_images_from_quill($item['konten']);
                if (empty($imageUrls)) {
                    $imageUrls[] = 'https://placehold.co/400x250/E3F2FD/1976D2?text=FOTO+KEGIATAN';
                }
                $firstParagraph = get_first_paragraph_from_quill($item['konten']);
                ?>
                <article class="kegiatan-card group bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
                    <div class="relative w-full h-56 overflow-hidden">
                        <img src="<?= esc($imageUrls[0]); ?>" alt="<?= esc($item['judul']); ?>" class="w-full h-full object-cover bg-gray-100 rounded-t-2xl">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-blue-600 transition-colors duration-300 line-clamp-2 leading-tight">
                            <?= esc($item['judul']); ?>
                        </h3>
                        <span class="inline-block bg-blue-50 text-blue-700 px-3 py-1 rounded-lg text-xs font-medium border border-blue-200 mb-4">
                            <?= esc($item['kategori']); ?>
                        </span>
                        <p class="text-gray-600 text-sm mb-6 line-clamp-3 leading-relaxed">
                            <?= esc($firstParagraph); ?>
                        </p>
                        <a href="<?= base_url('kegiatan/' . $item['slug']); ?>" class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium group/link transition-colors duration-200">
                            <span class="mr-2">Baca Selengkapnya</span>
                            <svg class="w-4 h-4 transform transition-transform duration-200 group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="col-span-full text-center py-16 bg-white rounded-2xl shadow-lg border border-gray-100">
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Tidak ada kegiatan ditemukan</h3>
                <p class="text-gray-600 mb-6">Coba ubah kriteria pencarian atau filter Anda</p>
                <a href="<?= base_url('kegiatan'); ?>" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors duration-200">
                    Lihat Semua Kegiatan
                </a>
            </div>
        <?php endif; ?>
    </div>

    <div class="flex justify-center mt-10">
        <nav class="p-1 md:p-2 border border-2 border-gray-400" aria-label="Pagination">
            <?= $pager->links('default', 'tailwind_full') ?>
        </nav>
    </div>
</div>

<?= $this->endSection() ?>
