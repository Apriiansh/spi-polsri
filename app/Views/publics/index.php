<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<!-- ====== PAGE WRAPPER ====== -->
<div class="min-h-screen">
    <!-- ========= HERO / CAROUSEL ========= -->
    <section id="hero-slider" class="relative w-full overflow-hidden mb-12 rounded-md">
        <div class="relative h-[560px]">
            <!-- overlay gradasi modern -->
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900/40 via-slate-900/20 to-transparent z-10"></div>
            <div class="flex transition-all duration-600 ease-in-out" id="slider-container">
                <!-- slide 1 -->
                <div class="min-w-full h-[560px] bg-cover bg-center" style="background-image: url('<?= base_url('images/image1.jpg') ?>');">
                    <div class="flex items-center justify-center h-full text-white relative z-20">
                        
                    </div>
                </div>
                <!-- slide 2 -->
                <div class="min-w-full h-[560px] bg-cover bg-center" style="background-image: url('<?= base_url('images/image2.jpg') ?>');">
                    <div class="flex items-center justify-center h-full text-white relative z-20">
                        
                    </div>
                </div>
                <!-- slide 3 -->
                <div class="min-w-full h-[560px] bg-cover bg-center" style="background-image: url('<?= base_url('images/image3.jpg') ?>');">
                    <div class="flex items-center justify-center h-full text-white relative z-20">
                       
                    </div>
                </div>
            </div>
            <!-- dots -->
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex items-center gap-2 z-30" id="hero-dots">
                <button class="w-2.5 h-2.5 rounded-sm bg-white/50 hover:bg-white transition" data-slide="0"></button>
                <button class="w-2.5 h-2.5 rounded-sm bg-white/50 hover:bg-white transition" data-slide="1"></button>
                <button class="w-2.5 h-2.5 rounded-sm bg-white/50 hover:bg-white transition" data-slide="2"></button>
            </div>
        </div>
    </section>

    <!-- ========= LOGO STRIP ========= -->
    <section class="mb-12">
        <div class="bg-white rounded-md p-8">
            <div class="flex flex-wrap justify-center items-center gap-10">
                <img src="<?= base_url('images/kemenristek.png') ?>" alt="Kemenristek" class="h-16 w-auto object-contain opacity-70 hover:opacity-100 transition" loading="lazy">
                <img src="<?= base_url('images/polsri.png') ?>" alt="POLSRI" class="h-16 w-auto object-contain opacity-70 hover:opacity-100 transition" loading="lazy">
                <img src="<?= base_url('images/blu.png') ?>" alt="BLU" class="h-16 w-auto object-contain opacity-70 hover:opacity-100 transition" loading="lazy">
                <img src="<?= base_url('images/diktiristek.png') ?>" alt="Ristek" class="h-16 w-auto object-contain opacity-70 hover:opacity-100 transition" loading="lazy">
            </div>
        </div>
    </section>

    <!-- ========= QUOTE ========= -->
    <section class="mb-12">
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-md p-10">
            <div class="text-center">
                <div class="text-6xl text-blue-200 mb-6">"</div>
                <blockquote class="text-xl md:text-2xl text-white font-medium leading-relaxed mb-4">
                    Pengawasan Internal adalah kunci untuk memastikan transparansi dan akuntabilitas dalam setiap aspek organisasi.
                </blockquote>
                <cite class="block text-blue-100 text-lg font-semibold">— Kepala SPI POLSRI</cite>
            </div>
        </div>
    </section>

    <!-- ========= KEGIATAN ========= -->
    <section id="kegiatan-section" class="mb-12">
        <div class="bg-white rounded-md overflow-hidden">
            <div class="p-8 border-b border-gray-100">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 tracking-tight mb-2">Kegiatan</h2>
                <p class="text-slate-500">Sorotan galeri dan daftar kegiatan terbaru</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
                <!-- ========== Kolom Kiri: Galeri Slider ========== -->
                <div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-4">Galeri Kegiatan</h3>
                    <div class="relative overflow-hidden rounded-xl group shadow-sm">
                        <div class="flex transition-transform duration-500 ease-out" id="kegiatan-container">
                            <?php if (!empty($kegiatan_terbaru)) : ?>
                                <?php foreach ($kegiatan_terbaru as $kegiatan) : ?>
                                    <?php
                                    $konten = json_decode($kegiatan['konten'], true);
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
                                        $imageUrl = 'https://placehold.co/1200x700/E3F2FD/1976D2?text=No+Image';
                                    }
                                    ?>
                                    <div class="min-w-full relative">
                                        <img src="<?= esc($imageUrl); ?>" alt="<?= esc($kegiatan['judul']); ?>" class="w-full h-80 md:h-[420px] object-cover">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                                        <div class="absolute bottom-5 left-5 right-5 text-white">
                                            <a href="<?= base_url('kegiatan/' . $kegiatan['id']); ?>" class="text-xl md:text-2xl font-bold leading-snug hover:text-blue-200 transition line-clamp-2"><?= esc($kegiatan['judul']); ?></a>
                                            <p class="text-sm mt-1 text-blue-100"><?= esc(date('d F Y', strtotime($kegiatan['created_at']))); ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <img src="https://placehold.co/1200x700/E3F2FD/1976D2?text=No+Kegiatan+Found" alt="No Kegiatan Found" class="w-full h-80 md:h-[420px] object-cover">
                            <?php endif; ?>
                        </div>
                        <!-- tombol navigasi -->
                        <button id="prevKegiatan" aria-label="Sebelumnya" class="absolute top-1/2 left-4 -translate-y-1/2 bg-white/90 hover:bg-white rounded-sm p-2 shadow-sm">
                            <i class="fas fa-chevron-left text-slate-800"></i>
                        </button>
                        <button id="nextKegiatan" aria-label="Berikutnya" class="absolute top-1/2 right-4 -translate-y-1/2 bg-white/90 hover:bg-white rounded-sm p-2 shadow-sm">
                            <i class="fas fa-chevron-right text-slate-800"></i>
                        </button>
                    </div>
                </div>

                <!-- ========== Kolom Kanan: Daftar Kegiatan ========== -->
                <div>
                    <h3 class="text-xl font-semibold text-slate-800 mb-4">Kegiatan Terbaru</h3>
                    <div class="space-y-4">
                        <?php if (!empty($kegiatan_terbaru)) : ?>
                            <?php foreach ($kegiatan_terbaru as $index => $kegiatan) : ?>
                                <?php
                                // ambil thumbnail pertama
                                $konten = json_decode($kegiatan['konten'], true);
                                $thumb = '';
                                if (json_last_error() === JSON_ERROR_NONE && is_array($konten)) {
                                    foreach ($konten as $block) {
                                        if (($block['type'] ?? '') === 'image' && !empty($block['content'])) {
                                            $thumb = $block['content'];
                                            break;
                                        }
                                    }
                                }
                                if (empty($thumb)) {
                                    $thumb = 'https://placehold.co/400x240/E3F2FD/1976D2?text=No+Image';
                                }
                                ?>
                                <a href="<?= base_url('kegiatan/' . $kegiatan['id']); ?>" class="kegiatan-item group flex bg-slate-50 hover:bg-slate-100 rounded-xl overflow-hidden transition-all duration-300 shadow-sm hover:shadow-md">
                                    <img src="<?= esc($thumb) ?>" alt="<?= esc($kegiatan['judul']) ?>" class="w-32 h-24 object-cover">
                                    <div class="p-4 flex-1">
                                        <h4 class="text-base md:text-lg font-semibold text-slate-800 group-hover:text-blue-600 transition line-clamp-2">
                                            <?= esc($kegiatan['judul']); ?>
                                        </h4>
                                        <div class="flex items-center text-xs md:text-sm text-slate-500 mt-1">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            <?= esc(date('d F Y', strtotime($kegiatan['created_at']))); ?>
                                        </div>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="p-6 bg-slate-50 rounded-xl text-center shadow-sm">
                                <p class="text-slate-600">Belum ada kegiatan terbaru.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mt-6">
                        <a href="/kegiatan" class="inline-flex items-center px-5 py-3 rounded-sm bg-blue-600 text-white font-medium hover:bg-blue-700 transition shadow-md hover:shadow-lg">
                            <span class="mr-2">Lihat Semua Kegiatan</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========= DOKUMEN ========= -->
    <section id="dokumen-section" class="mb-12">
        <div class="bg-white rounded-md verflow-hidden">
            <div class="p-8 border-b border-gray-100">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-2">Dokumen & Publikasi</h2>
                <p class="text-slate-500">Akses dokumen resmi dan publikasi SPI POLSRI</p>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Publik -->
                    <div class="dokumen-card group bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div class="p-3 rounded-xl bg-green-100">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-sm text-xs font-semibold">Publik</span>
                            </div>
                            <h4 class="text-lg font-bold text-slate-800 mb-2 group-hover:text-green-600 transition">Laporan Tahunan 2024</h4>
                            <p class="text-slate-600 mb-5 leading-relaxed">Ringkasan komprehensif laporan tahunan SPI untuk tahun 2024 dengan analisis mendalam.</p>
                            <a href="#" class="inline-flex items-center text-green-600 font-medium hover:underline">
                                <span class="mr-2">Unduh Dokumen</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Terkunci -->
                    <div class="dokumen-card group bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div class="p-3 rounded-xl bg-amber-100">
                                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-sm text-xs font-semibold">Terkunci</span>
                            </div>
                            <h4 class="text-lg font-bold text-slate-800 mb-2">Hasil Audit Keuangan Internal</h4>
                            <p class="text-slate-600 mb-5 leading-relaxed">Hanya dapat diakses oleh pengguna dengan izin khusus.</p>
                            <button class="inline-flex items-center text-amber-700 font-medium cursor-not-allowed opacity-70">
                                <span class="mr-2">Akses Terbatas</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- SOP -->
                    <div class="dokumen-card group bg-white rounded-xl overflow-hidden transition-all duration-300 border border-gray-100">
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div class="p-3 rounded-xl bg-blue-100">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-sm text-xs font-semibold">Publik</span>
                            </div>
                            <h4 class="text-lg font-bold text-slate-800 mb-2 group-hover:text-blue-600 transition">Panduan SOP Audit</h4>
                            <p class="text-slate-600 mb-5 leading-relaxed">Standard Operating Procedure untuk proses audit internal dan panduan pelaksanaan.</p>
                            <a href="#" class="inline-flex items-center text-blue-600 font-medium hover:underline">
                                <span class="mr-2">Unduh Panduan</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========= UPG ========= -->
    <section id="upg-section" class="mb-12">
        <div class="bg-gradient-to-r from-red-600 to-red-700 rounded-md overflow-hidden">
            <div class="p-10 text-center">
                <div class="p-4 bg-white/10 rounded-sm w-20 h-20 mx-auto mb-6 flex items-center justify-center">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.732-.833-2.464 0L4.35 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-3">Unit Pengawasan Gratifikasi</h2>
                <p class="text-lg md:text-xl text-red-100 mb-8 leading-relaxed max-w-3xl mx-auto">Laporkan setiap pelanggaran atau gratifikasi yang Anda ketahui. Mari bersama-sama menjaga integritas dan menciptakan lingkungan kerja yang bersih.</p>
                <a href="/laporan" class="inline-flex items-center bg-white text-red-600 px-7 py-3 rounded-sm text-base md:text-lg font-bold hover:bg-red-50 transition shadow-lg hover:shadow-xl">
                    <span class="mr-3">Buat Laporan</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>
</div>

<!-- ========= STYLES ========= -->
<style>
    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out;
    }

    .line-clamp-2 {
        display: -webkit-box;
        line-clamp: 2;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Smooth transitions untuk elemen interaktif */
    .dokumen-card,
    .kegiatan-item {
        transition: all 0.3s ease;
    }

    .dokumen-card:hover,
    .kegiatan-item:hover {
        transform: translateY(-4px);
    }
</style>

<!-- ========= SCRIPTS ========= -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        /* ==== HERO SLIDER ==== */
        const heroSlider = document.getElementById('slider-container');
        const heroSlides = heroSlider.children.length;
        const heroDots = document.querySelectorAll('#hero-dots button');
        let heroCurrentSlide = 0;
        let heroInterval;

        function updateHeroDots() {
            heroDots.forEach((dot, index) => {
                dot.classList.toggle('bg-white', index === heroCurrentSlide);
                dot.classList.toggle('bg-white/50', index !== heroCurrentSlide);
                dot.classList.toggle('w-3', index === heroCurrentSlide);
                dot.classList.toggle('w-2.5', index !== heroCurrentSlide);
            });
        }

        function slideHero(targetSlide = null) {
            heroCurrentSlide = (targetSlide !== null) ? targetSlide : (heroCurrentSlide + 1) % heroSlides;
            heroSlider.style.transform = `translateX(-${heroCurrentSlide * 100}%)`;
            updateHeroDots();
        }

        function startHeroAutoSlide() {
            heroInterval = setInterval(() => slideHero(), 6000);
        }

        heroDots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                clearInterval(heroInterval);
                slideHero(index);
                startHeroAutoSlide();
            });
        });

        updateHeroDots();
        startHeroAutoSlide();

        /* ==== KEGIATAN SLIDER (kolom kiri) ==== */
        const kegiatanSlider = document.getElementById('kegiatan-container');
        const kegiatanSlides = kegiatanSlider ? kegiatanSlider.children.length : 0;
        let kegiatanCurrentSlide = 0;

        function slideKegiatan(toIndex = null) {
            if (!kegiatanSlider || kegiatanSlides <= 1) return;
            if (toIndex !== null) {
                kegiatanCurrentSlide = (toIndex + kegiatanSlides) % kegiatanSlides;
            } else {
                kegiatanCurrentSlide = (kegiatanCurrentSlide + 1) % kegiatanSlides;
            }
            kegiatanSlider.style.transform = `translateX(-${kegiatanCurrentSlide * 100}%)`;
        }

        const prevBtn = document.getElementById('prevKegiatan');
        const nextBtn = document.getElementById('nextKegiatan');

        if (prevBtn && nextBtn) {
            prevBtn.addEventListener('click', () => slideKegiatan(kegiatanCurrentSlide - 1));
            nextBtn.addEventListener('click', () => slideKegiatan(kegiatanCurrentSlide + 1));
        }

        if (kegiatanSlides > 1) setInterval(slideKegiatan, 8000);

        /* ==== Parallax halus untuk hero ==== */
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const heroSection = document.getElementById('hero-slider');
            if (heroSection) {
                heroSection.style.transform = `translateY(${scrolled * 0.12}px)`;
            }
        }, {
            passive: true
        });
    });
</script>

<!-- ========= STRUCTURED DATA ========= -->
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "SPI POLSRI",
        "description": "Satuan Pengawas Internal Politeknik Negeri Sriwijaya",
        "url": "<?= base_url() ?>",
        "logo": "<?= base_url('images/polsri.png') ?>",
        "sameAs": ["https://www.polsri.ac.id"]
    }
</script>
<?= $this->endSection() ?>