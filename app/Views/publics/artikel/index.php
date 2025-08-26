<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php
function parse_quill_delta($json, $limit = 150)
{
    $delta = json_decode($json, true);
    $text = '';
    $images = [];

    if (isset($delta['ops'])) {
        foreach ($delta['ops'] as $op) {
            if (isset($op['insert'])) {
                if (is_string($op['insert'])) {
                    $text .= $op['insert'];
                } elseif (is_array($op['insert']) && isset($op['insert']['image'])) {
                    $images[] = $op['insert']['image'];
                }
            }
        }
    }

    return [
        'text' => mb_substr(trim($text), 0, $limit),
        'images' => $images
    ];
}

?>

<!-- Hero Section -->
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
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">ARTIKEL</h1>
        <div class="w-24 h-1 bg-white mx-auto rounded-full"></div>
    </div>
</div>

<div class="container mx-auto px-6 -mt-6 relative z-10">
    <!-- Search Section -->
    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden mb-12 border border-gray-100">
        <div class="bg-gradient-to-r from-slate-50 to-indigo-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <div class="flex items-center">
                <div class="p-2 bg-indigo-100 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-slate-800">Pencarian Artikel</h2>
            </div>
        </div>

        <div class="p-6">
            <form action="<?= base_url('artikel'); ?>" method="get" class="space-y-4">
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari Artikel</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" name="search" placeholder="Cari berdasarkan judul atau isi artikel..."
                                value="<?= esc($search ?? ''); ?>"
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 bg-gray-50 focus:bg-white">
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-wrap gap-3 pt-4 border-t border-gray-100">
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-medium rounded-xl hover:from-indigo-700 hover:to-indigo-800 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6M9 11a4 4 0 100-8 4 4 0 000 8z"></path>
                        </svg>
                        Cari
                    </button>
                    <a href="<?= base_url('artikel'); ?>" class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Artikel Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        <?php if (!empty($artikel)) : ?>
            <?php foreach ($artikel as $item) : ?>
                <?php
                $parsed = parse_quill_delta($item['content']);
                $imageUrls = !empty($parsed['images']) ? $parsed['images'] : ['https://placehold.co/400x250/F3E8FF/6D28D9?text=Artikel'];
                $firstParagraph = !empty($parsed['text']) ? $parsed['text'] : 'Klik untuk membaca selengkapnya...';

            ?>
                <article class="kegiatan-card group bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
                    <!-- Image -->
                    <div class="relative w-full h-56 overflow-hidden">
                        <img src="<?= esc($imageUrls[0]); ?>" alt="<?= esc($item['title']); ?>"
                            class="w-full h-full object-cover bg-gray-100 rounded-t-2xl">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-indigo-600 transition-colors duration-300 line-clamp-2 leading-tight">
                            <?= esc($item['title']); ?>
                        </h3>

                        <p class="text-gray-600 text-sm mb-6 line-clamp-3 leading-relaxed">
                            <?= esc($firstParagraph); ?>
                        </p>

                        <a href="<?= base_url('artikel/' . $item['slug']); ?>"
                            class="inline-flex items-center text-indigo-600 hover:text-indigo-700 font-medium group/link transition-colors duration-200">
                            <span class="mr-2">Baca Selengkapnya</span>
                            <svg class="w-4 h-4 transform transition-transform duration-200 group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>

                    <div class="h-1 bg-gradient-to-r from-indigo-500 to-indigo-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                </article>
            <?php endforeach; ?>
        <?php else : ?>
            <!-- Empty State -->
            <div class="col-span-full">
                <div class="text-center py-16 bg-white rounded-2xl shadow-lg border border-gray-100">
                    <div class="inline-block p-4 bg-gray-100 rounded-full mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 16h10M5 12h14"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Tidak ada artikel ditemukan</h3>
                    <p class="text-gray-600 mb-6">Coba ubah kata kunci pencarian Anda</p>
                    <a href="<?= base_url('artikel'); ?>" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Lihat Semua Artikel
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center mb-2">
        <div class="p-2">
            <?= $pager->links('default', 'default_full') ?>
        </div>
    </div>
</div>

<?= $this->endSection() ?>