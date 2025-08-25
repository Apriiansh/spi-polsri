<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php
// Ambil gambar pertama dari HTML konten
function get_all_images($html)
{
    $doc = new DOMDocument();
    @$doc->loadHTML($html); // parsing isi konten HTML
    $tags = $doc->getElementsByTagName('img');
    $images = [];

    foreach ($tags as $tag) {
        $images[] = $tag->getAttribute('src'); // ambil semua src gambar
    }

    return $images;
}
?>

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
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">KEGIATAN</h1>
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-slate-800">Filter & Pencarian</h2>
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
                <form action="<?= base_url('kegiatan'); ?>" method="get" class="space-y-4">
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
                                <input type="text" name="search" placeholder="Cari berdasarkan judul kegiatan..."
                                    value="<?= esc($search ?? ''); ?>"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 focus:bg-white">
                            </div>
                        </div>

                        <!-- Category Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <select name="kategori" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 focus:bg-white">
                                <option value="">Semua Kategori</option>
                                <?php foreach (array_keys($kategoriData) as $kategori_nama) : ?>
                                    <option value="<?= esc($kategori_nama); ?>" <?= ($kategori_filter == $kategori_nama) ? 'selected' : ''; ?>>
                                        <?= esc($kategori_nama); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Sub Category Filter -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sub Kategori</label>
                            <select id="sub_kategori_filter" name="subkategori" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 bg-gray-50 focus:bg-white">
                                <option value="">Semua Sub Kategori</option>
                                <?php
                                if (!empty($kategori_filter) && isset($kategoriData[$kategori_filter])) {
                                    foreach ($kategoriData[$kategori_filter] as $sub_nama) {
                                        echo '<option value="' . esc($sub_nama) . '" ' . (($subkategori_filter == $sub_nama) ? 'selected' : '') . '>' . esc($sub_nama) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap gap-3 pt-4 border-t border-gray-100">
                        <button type="submit" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-xl hover:from-blue-700 hover:to-blue-800 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.707A1 1 0 013 7V4z"></path>
                            </svg>
                            Terapkan Filter
                        </button>
                        <a href="<?= base_url('kegiatan'); ?>" class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Reset Filter
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Kegiatan Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        <?php if (!empty($kegiatan)) : ?>
            <?php foreach ($kegiatan as $item) : ?>
                <?php
                $imageUrls = [];
                $firstParagraph = 'Klik untuk melihat detail kegiatan ini...';

                $imageUrls = get_all_images($item['konten']);
                if (empty($imageUrls)) {
                    $imageUrls[] = 'https://placehold.co/400x250/E3F2FD/1976D2?text=SPI+POLSRI';
                }

                // Cari paragraf pertama (opsional, kalau mau)
                $doc = new DOMDocument();
                @$doc->loadHTML($item['konten']);
                $paragraphs = $doc->getElementsByTagName('p');
                if ($paragraphs->length > 0) {
                    $firstParagraph = strip_tags($paragraphs->item(0)->nodeValue);
                }
                ?>

                <article class="kegiatan-card group bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
                    <!-- Image Slider Container -->
                    <div class="relative w-full h-56 overflow-hidden">
                        <div class="slider-container relative w-full h-full">
                            <?php foreach ($imageUrls as $index => $url) : ?>
                                <div class="slider-item absolute inset-0 transition-opacity duration-1000 ease-in-out opacity-0 <?= ($index === 0) ? 'opacity-100' : '' ?>">
                                    <img src="<?= esc($url); ?>" alt="<?= esc($item['judul']); ?>"
                                        class="w-full h-full object-fit bg-gray-100 rounded-t-2xl">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        <!-- Slider Navigation Buttons -->
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

                        <!-- Overlay Badge -->
                        <!-- <div class="absolute top-4 left-4">
                            <span class="inline-block bg-white/90 backdrop-blur-sm text-blue-600 px-3 py-1 rounded-full text-xs font-semibold shadow-md">
                                <?= esc($item['kategori']); ?>
                            </span>
                        </div> -->
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <div class="mb-4">
                            <h3 class="text-xl font-bold text-slate-800 mb-3 group-hover:text-blue-600 transition-colors duration-300 line-clamp-2 leading-tight">
                                <?= esc($item['judul']); ?>
                            </h3>

                            <!-- Category Tags -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="inline-block bg-blue-50 text-blue-700 px-3 py-1 rounded-lg text-xs font-medium border border-blue-200">
                                    <?= esc($item['kategori']); ?>
                                </span>
                                <?php if (!empty($item['sub_kategori'])) : ?>
                                    <span class="inline-block bg-green-50 text-green-700 px-3 py-1 rounded-lg text-xs font-medium border border-green-200">
                                        <?= esc($item['sub_kategori']); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-6 line-clamp-3 leading-relaxed">
                            <?= esc($firstParagraph); ?>
                        </p>

                        <!-- Read More Button -->
                        <a href="<?= base_url('kegiatan/' . $item['slug']); ?>"
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.29-1.009-5.824-2.563M15 6.486a8.967 8.967 0 00-6 0m6 0V3a1 1 0 00-1-1H10a1 1 0 00-1 1v3.486"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Tidak ada kegiatan ditemukan</h3>
                    <p class="text-gray-600 mb-6">Coba ubah kriteria pencarian atau filter Anda</p>
                    <a href="<?= base_url('kegiatan'); ?>" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Lihat Semua Kegiatan
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

    .kegiatan-card {
        position: relative;
        overflow: hidden;
    }

    .kegiatan-card::before {
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

    .kegiatan-card:hover::before {
        left: 100%;
    }

    /* Updated Custom pagination styles */
    .pagination {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 0.5rem;
        align-items: center;
    }

    .pagination a,
    .pagination span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        font-weight: 500;
        transition: all 0.2s ease-in-out;
        border: 1px solid transparent;
    }

    .pagination a {
        color: #4B5563;
        /* Gray-600 */
        background-color: #F9FAFB;
        /* Gray-50 */
        border-color: #E5E7EB;
        /* Gray-200 */
        text-decoration: none;
    }

    .pagination a:hover {
        background-color: #DBEAFE;
        /* Blue-100 */
        border-color: #93C5FD;
        /* Blue-300 */
        color: #1E40AF;
        /* Blue-800 */
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .pagination a:focus {
        outline: 2px solid #3B82F6;
        /* Blue-500 */
        outline-offset: 2px;
    }

    .pagination .active {
        background-color: #2563EB;
        /* Blue-600 */
        color: white;
        border-color: #2563EB;
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        transform: translateY(-2px);
    }

    .pagination .active:hover {
        background-color: #1E40AF;
        /* Blue-800 */
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.4);
    }
</style>

<!-- Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kategoriData = <?= json_encode($kategoriData); ?>;
        const kategoriSelect = document.querySelector('select[name="kategori"]');
        const subKategoriSelect = document.getElementById('sub_kategori_filter');
        const currentKategori = kategoriSelect.value;
        const currentSubKategori = "<?= esc($subkategori_filter ?? ''); ?>";
        const filterToggleBtn = document.getElementById('filter-toggle');
        const filterContent = document.getElementById('filter-content');
        const chevronDown = document.getElementById('chevron-down');
        const chevronUp = document.getElementById('chevron-up');

        function populateSubKategori(selectedKategori, selectedSub) {
            subKategoriSelect.innerHTML = '<option value="">Semua Sub Kategori</option>';
            if (selectedKategori && kategoriData[selectedKategori]) {
                kategoriData[selectedKategori].forEach(sub => {
                    const option = document.createElement('option');
                    option.value = sub;
                    option.textContent = sub;
                    if (sub === selectedSub) {
                        option.selected = true;
                    }
                    subKategoriSelect.appendChild(option);
                });
            }
        }

        kategoriSelect.addEventListener('change', function() {
            populateSubKategori(this.value, null);
        });

        // Initial population on page load
        if (currentKategori) {
            populateSubKategori(currentKategori, currentSubKategori);
        }

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
                        Memproses...
                    `;
                }
            });
        }
    });

    // ===============================================
    // JAVASCRIPT FOR AUTOMATIC IMAGE SLIDER
    // ===============================================

    document.addEventListener('DOMContentLoaded', () => {
        // Find all the image slider containers on the page
        const sliders = document.querySelectorAll('.kegiatan-card');

        sliders.forEach(slider => {
            const sliderItems = slider.querySelectorAll('.slider-item');
            const prevBtn = slider.querySelector('.slider-prev-btn');
            const nextBtn = slider.querySelector('.slider-next-btn');
            const dotsContainer = slider.querySelector('.slider-dots');
            const dotBtns = slider.querySelectorAll('.dot-btn');
            let currentSlide = 0;
            let slideInterval;

            // Function to show a specific slide
            const showSlide = (index) => {
                // Hide all slides
                sliderItems.forEach(item => item.classList.remove('opacity-100', 'z-10'));
                sliderItems.forEach(item => item.classList.add('opacity-0', 'z-0'));

                // Show the selected slide
                sliderItems[index].classList.remove('opacity-0', 'z-0');
                sliderItems[index].classList.add('opacity-100', 'z-10');

                // Update the active dot
                dotBtns.forEach(dot => dot.classList.remove('!bg-white'));
                dotBtns[index].classList.add('!bg-white');
            };

            // Function to move to the next slide
            const nextSlide = () => {
                currentSlide = (currentSlide + 1) % sliderItems.length;
                showSlide(currentSlide);
            };

            // Function to move to the previous slide
            const prevSlide = () => {
                currentSlide = (currentSlide - 1 + sliderItems.length) % sliderItems.length;
                showSlide(currentSlide);
            };

            // Start the automatic slide show
            const startSlider = () => {
                // Clear any existing interval to prevent multiple timers
                clearInterval(slideInterval);
                slideInterval = setInterval(nextSlide, 5000); // Change image every 5 seconds
            };

            // Add event listeners for navigation buttons
            if (prevBtn) {
                prevBtn.addEventListener('click', () => {
                    prevSlide();
                    startSlider(); // Restart timer after manual navigation
                });
            }

            if (nextBtn) {
                nextBtn.addEventListener('click', () => {
                    nextSlide();
                    startSlider(); // Restart timer after manual navigation
                });
            }

            // Add event listeners for dots navigation
            if (dotsContainer) {
                dotsContainer.addEventListener('click', (e) => {
                    if (e.target.classList.contains('dot-btn')) {
                        const index = parseInt(e.target.dataset.index);
                        showSlide(index);
                        currentSlide = index;
                        startSlider(); // Restart timer after manual navigation
                    }
                });
            }

            // Hide navigation buttons and dots if there is only one image
            if (sliderItems.length <= 1) {
                if (prevBtn) prevBtn.style.display = 'none';
                if (nextBtn) nextBtn.style.display = 'none';
                if (dotsContainer) dotsContainer.style.display = 'none';
            } else {
                // Initialize the slider and start the timer
                showSlide(currentSlide);
                startSlider();
            }

        });
    });
</script>

<?= $this->endSection() ?>