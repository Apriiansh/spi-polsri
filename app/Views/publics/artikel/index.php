<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Hero Header -->
<div class="relative bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 overflow-hidden mb-12">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2 blur-2xl"></div>

    <div class="relative container mx-auto px-6 py-16 text-center">
        <div class="inline-block p-4 bg-white/10 backdrop-blur-sm rounded-2xl mb-6">
            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
            </svg>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Artikel</h1>
        <div class="mt-8 w-24 h-1 bg-blue-200 mx-auto rounded-full"></div>
    </div>
</div>

<div class="container mx-auto px-6 -mt-6 relative z-10">

    <!-- Kegiatan Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        <?php if (!empty($kegiatan)) : ?>
            <?php foreach ($kegiatan as $item) : ?>
                <article class="kegiatan-card group bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 transform transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">
                    <?php
                    $konten = json_decode($item['konten'], true);
                    $imageUrl = '';
                    if (json_last_error() === JSON_ERROR_NONE && is_array($konten)) {
                        foreach ($konten as $block) {
                            if (($block['type'] ?? '') === 'image' && !empty($block['content'])) {
                                $imageUrl = $block['content'];
                                break;
                            }
                        }
                    }
                    if (empty($imageUrl)) {
                        $imageUrl = 'https://placehold.co/400x250/E3F2FD/1976D2?text=SPI+POLSRI';
                    }
                    ?>

                    <!-- Image Container -->
                    <div class="relative overflow-hidden">
                        <img src="<?= esc($imageUrl); ?>" alt="<?= esc($item['judul']); ?>"
                            class="w-full h-56 object-cover transform transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        <!-- Overlay Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="inline-block bg-white/90 backdrop-blur-sm text-blue-600 px-3 py-1 rounded-full text-xs font-semibold shadow-md">
                                <?= esc($item['kategori']); ?>
                            </span>
                        </div>
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
                            <?php
                            $firstParagraph = '';
                            if (json_last_error() === JSON_ERROR_NONE && is_array($konten)) {
                                foreach ($konten as $block) {
                                    if (($block['type'] ?? '') === 'paragraph' && !empty($block['content'])) {
                                        $firstParagraph = $block['content'];
                                        break;
                                    }
                                }
                            }
                            if (empty($firstParagraph)) {
                                $firstParagraph = 'Klik untuk melihat detail kegiatan ini...';
                            }
                            echo esc($firstParagraph);
                            ?>
                        </p>

                        <!-- Read More Button -->
                        <a href="<?= base_url('kegiatan/' . $item['id']); ?>"
                            class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium group/link transition-colors duration-200">
                            <span class="mr-2">Baca Selengkapnya</span>
                            <svg class="w-4 h-4 transform transition-transform duration-200 group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>

                    <!-- Bottom Border Animation -->
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
    <div class="flex justify-center mb-8">
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
</script>

<?= $this->endSection() ?>