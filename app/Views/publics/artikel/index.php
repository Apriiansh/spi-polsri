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
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">ARTIKEL</h1>
        <div class="w-24 h-1 bg-white mx-auto rounded-full"></div>
    </div>
</div>

<div class="container mx-auto px-6 -mt-6 relative z-10">
    <!-- Filter Section -->
    <div class="bg-white shadow-2xl rounded-2xl overflow-hidden mb-12 border border-gray-100">
        <div class="bg-gradient-to-r from-slate-50 to-blue-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg mr-3">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-slate-800">Pencarian Artikel</h2>
            </div>
            <!-- Toggle Button for Mobile -->
            <button id="filter-toggle" class="md:hidden p-2 text-gray-600 hover:text-gray-900 transition-colors duration-200 focus:outline-none" aria-expanded="false" aria-controls="filter-content">
                <svg class="w-6 h-6 transform transition-transform duration-300" id="chevron-down" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
                <svg class="w-6 h-6 hidden transform transition-transform duration-300" id="chevron-up" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                </svg>
            </button>
        </div>

        <div id="filter-content" class="hidden md:block transition-all duration-300 ease-out">
            <div class="p-6">
                <form action="<?= base_url('artikel'); ?>" method="get" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Search Input -->
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Pencarian</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="search" placeholder="Cari berdasarkan judul atau isi artikel..."
                                    value="<?= esc($search ?? ''); ?>"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 focus:bg-white">
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-3 pt-4 border-t border-gray-100">
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-xl hover:from-blue-700 hover:to-blue-800 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari Artikel
                        </button>
                        <a href="<?= base_url('artikel'); ?>" class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset Pencarian
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Artikel Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        <?php if (!empty($artikel)) : ?>
            <?php foreach ($artikel as $item) : ?>
                <?php
                $parsed = parse_quill_delta($item['content']);
                $imageUrls = !empty($parsed['images']) ? $parsed['images'] : ['https://placehold.co/400x250/E3F2FD/1976D2?text=SPI+POLSRI'];
                $firstParagraph = !empty($parsed['text']) ? $parsed['text'] : 'Klik untuk membaca selengkapnya...';
                ?>

                <article class="artikel-card group bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
                    <!-- Image Slider Container -->
                    <div class="relative w-full h-56 overflow-hidden">
                        <div class="slider-container relative w-full h-full">
                            <?php foreach ($imageUrls as $index => $url) : ?>
                                <div class="slider-item absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 <?= ($index === 0) ? 'opacity-100' : '' ?>">
                                    <img src="<?= esc($url); ?>" alt="<?= esc($item['title']); ?>"
                                        class="w-full h-full object-cover bg-gray-100 rounded-t-2xl">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        <!-- Slider Navigation Buttons (only show if multiple images) -->
                        <?php if (count($imageUrls) > 1) : ?>
                            <button class="slider-prev-btn absolute top-1/2 -translate-y-1/2 left-4 text-white p-2 rounded-full bg-black/30 hover:bg-black/50 transition-colors z-20">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                            </button>
                            <button class="slider-next-btn absolute top-1/2 -translate-y-1/2 right-4 text-white p-2 rounded-full bg-black/30 hover:bg-black/50 transition-colors z-20">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>

                            <!-- Slider Dots -->
                            <div class="slider-dots absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2 z-20">
                                <?php foreach ($imageUrls as $index => $url) : ?>
                                    <button class="dot-btn w-2 h-2 rounded-full bg-white/50 hover:bg-white transition-colors duration-300 <?= ($index === 0) ? '!bg-white' : '' ?>" data-index="<?= $index; ?>"></button>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Article Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="inline-block bg-white/90 backdrop-blur-sm text-blue-600 px-3 py-1 rounded-full text-xs font-semibold shadow-md">
                                <?= esc(date('d F Y', strtotime($item['updated_at']))); ?>
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <div class="mb-4">
                            <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-blue-600 transition-colors duration-300 line-clamp-2 leading-tight">
                                <?= esc($item['title']); ?>
                            </h3>
                        </div>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-6 line-clamp-3 leading-relaxed">
                            <?= esc($firstParagraph); ?>
                        </p>

                        <!-- Read More Button -->
                        <a href="<?= base_url('artikel/' . $item['slug']); ?>"
                            class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium group/link transition-colors duration-200">
                            <span class="mr-2">Baca Selengkapnya</span>
                            <svg class="w-4 h-4 transform transition-transform duration-200 group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>

                    <div class="h-1 bg-gradient-to-r from-blue-500 to-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></div>
                </article>
            <?php endforeach; ?>
        <?php else : ?>
            <!-- Empty State -->
            <div class="col-span-full">
                <div class="text-center py-16 bg-white rounded-2xl shadow-lg border border-gray-100">
                    <div class="inline-block p-4 bg-gray-100 rounded-full mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Tidak ada artikel ditemukan</h3>
                    <p class="text-gray-600 mb-6">Coba ubah kata kunci pencarian Anda</p>
                    <a href="<?= base_url('artikel'); ?>" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors duration-200">
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
    <div class="flex justify-center mb-8">
        <nav class="p-1 md:p-2 border border-2 border-gray-400" aria-label="Pagination">
            <?= $pager->links('default', 'tailwind_full') ?>
        </nav>
    </div>
</div>

<!-- Styles -->
<style>
    /* Reset and general styles */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .artikel-card {
        position: relative;
        overflow: hidden;
    }

    .artikel-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: left 0.5s;
        z-index: 1;
        pointer-events: none;
    }

    .artikel-card:hover::before {
        left: 100%;
    }
</style>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterToggleBtn = document.getElementById('filter-toggle');
        const filterContent = document.getElementById('filter-content');
        const chevronDown = document.getElementById('chevron-down');
        const chevronUp = document.getElementById('chevron-up');

        // Toggle filter section visibility on mobile
        if (filterToggleBtn && filterContent) {
            filterToggleBtn.addEventListener('click', () => {
                const isHidden = filterContent.classList.toggle('hidden');
                if (isHidden) {
                    chevronDown.classList.remove('hidden');
                    chevronUp.classList.add('hidden');
                    filterToggleBtn.setAttribute('aria-expanded', 'false');
                } else {
                    chevronDown.classList.add('hidden');
                    chevronUp.classList.remove('hidden');
                    filterToggleBtn.setAttribute('aria-expanded', 'true');
                }
            });
        }

        // Add smooth scroll for any anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add loading animation for form submission
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function() {
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = `
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Mencari...
                    `;
                }
            });
        }
    });

    // ===============================================
    // JAVASCRIPT FOR AUTOMATIC IMAGE SLIDER
    // ===============================================

    document.addEventListener('DOMContentLoaded', () => {
        const sliders = document.querySelectorAll('.artikel-card');

        sliders.forEach(slider => {
            const sliderItems = slider.querySelectorAll('.slider-item');
            const prevBtn = slider.querySelector('.slider-prev-btn');
            const nextBtn = slider.querySelector('.slider-next-btn');
            const dotsContainer = slider.querySelector('.slider-dots');
            const dotBtns = slider.querySelectorAll('.dot-btn');
            let currentSlide = 0;
            let slideInterval;

            const showSlide = (index) => {
                sliderItems.forEach(item => item.classList.remove('opacity-100', 'z-10'));
                sliderItems.forEach(item => item.classList.add('opacity-0', 'z-0'));

                sliderItems[index].classList.remove('opacity-0', 'z-0');
                sliderItems[index].classList.add('opacity-100', 'z-10');

                dotBtns.forEach(dot => dot.classList.remove('!bg-white'));
                if (dotBtns[index]) {
                    dotBtns[index].classList.add('!bg-white');
                }
            };

            const nextSlide = () => {
                currentSlide = (currentSlide + 1) % sliderItems.length;
                showSlide(currentSlide);
            };

            const prevSlide = () => {
                currentSlide = (currentSlide - 1 + sliderItems.length) % sliderItems.length;
                showSlide(currentSlide);
            };

            const startSlider = () => {
                clearInterval(slideInterval);
                if (sliderItems.length > 1) {
                    slideInterval = setInterval(nextSlide, 5000);
                }
            };

            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    prevSlide();
                    startSlider();
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    nextSlide();
                    startSlider();
                });
            }

            if (dotsContainer) {
                dotsContainer.addEventListener('click', (e) => {
                    if (e.target.classList.contains('dot-btn')) {
                        const index = parseInt(e.target.dataset.index);
                        showSlide(index);
                        currentSlide = index;
                        startSlider();
                    }
                });
            }

            if (sliderItems.length <= 1) {
                if (prevBtn) prevBtn.style.display = 'none';
                if (nextBtn) nextBtn.style.display = 'none';
                if (dotsContainer) dotsContainer.style.display = 'none';
            } else {
                showSlide(currentSlide);
                startSlider();
            }
        });
    });
</script>

<?= $this->endSection() ?>