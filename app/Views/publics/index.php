<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<!-- Full width container tanpa padding -->
<div class="w-full">
    <!-- ========= HERO SECTION ========= -->
    <section id="hero-slider" class="relative w-full overflow-hidden">
        <div class="relative h-[65vh] min-h-[500px] max-h-[700px]">
            <!-- Clean overlay -->
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900/70 via-slate-800/50 to-slate-700/30 z-10"></div>

            <!-- Slider container -->
            <div class="flex transition-all duration-1000 ease-in-out h-full" id="slider-container">
                <!-- Slide 1 -->
                <div class="min-w-full h-540 bg-cover bg-center relative" style="background-image: url('<?= base_url('images/image1.jpg') ?>');">
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/40 to-transparent"></div>
                </div>
                <!-- Slide 2 -->
                <div class="min-w-full h-540 bg-cover bg-center relative" style="background-image: url('<?= base_url('images/image2.jpg') ?>');">
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/40 to-transparent"></div>
                </div>
                <!-- Slide 3 -->
                <div class="min-w-full h-540 bg-cover bg-center relative" style="background-image: url('<?= base_url('images/image3.jpg') ?>');">
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/40 to-transparent"></div>
                </div>
            </div>

            <!-- Hero content overlay -->
            <div class="absolute inset-0 flex items-center justify-center z-20">
                <div class="text-center text-white px-6 max-w-4xl">
                    <div class="inline-block p-4 bg-white/15 backdrop-blur-md rounded-xl mb-8 hero-icon">
                        <i class="fas fa-shield-alt text-4xl text-white"></i>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-bold mb-6 hero-title">
                        Satuan Pengawas Internal
                    </h1>
                    <p class="text-xl md:text-2xl text-blue-100 mb-8 font-light leading-relaxed hero-subtitle">
                        Politeknik Negeri Sriwijaya
                    </p>
                    <div class="w-20 h-1 bg-white/50 mx-auto rounded-full hero-line"></div>
                </div>
            </div>

            <!-- Minimalist dots -->
            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex items-center gap-2 z-30" id="hero-dots">
                <button class="w-2 h-2 rounded-full bg-white/50 hover:bg-white transition-all duration-300" data-slide="0"></button>
                <button class="w-2 h-2 rounded-full bg-white/50 hover:bg-white transition-all duration-300" data-slide="1"></button>
                <button class="w-2 h-2 rounded-full bg-white/50 hover:bg-white transition-all duration-300" data-slide="2"></button>
            </div>
        </div>
    </section>

    <!-- ========= LOGO PARTNERSHIP ========= -->
    <section class="bg-gradient-to-br from-blue-50 via-sky-100 to-cyan-50 py-16">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap justify-center items-center gap-12 opacity-80">
                <img src="<?= base_url('images/icons/kemenristek.png') ?>" alt="Kemenristek" class="h-24 w-auto object-contain transition-transform duration-500 hover:opacity-100 hover:scale-110">
                <img src="<?= base_url('images/icons/polsri.png') ?>" alt="POLSRI" class="h-24 w-auto object-contain transition-transform duration-500 hover:opacity-100 hover:scale-110">
                <img src="<?= base_url('images/icons/blu.png') ?>" alt="BLU" class="h-24 w-auto object-contain transition-transform duration-500 hover:opacity-100 hover:scale-110">
                <img src="<?= base_url('images/icons/diktisaintek.png') ?>" alt="Ristek" class="h-24 w-auto object-contain transition-transform duration-500 hover:opacity-100 hover:scale-110">
            </div>
        </div>
    </section>

    <!-- QUOTE -->
    <!-- ========= QUOTE ========= -->
    <section class="bg-gradient-to-tr from-blue-200 via-sky-300 to-cyan-150 py-24 lg:py-32 relative overflow-hidden">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-4/5 h-4/5 border-2 bg-gradient-to-br from-blue-60 via-sky-100 to-cyan-50 rounded-3xl z-0 pointer-events-none"></div>

        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute top-0 right-0 w-72 h-72 bg-blue-300/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-indigo-300/10 rounded-full blur-3xl"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col lg:flex-row items-center lg:items-start justify-center gap-12 lg:gap-20">

                <div class="text-center lg:text-left max-w-2xl">
                    <div class="inline-block p-3 bg-blue-100 backdrop-blur-sm rounded-xl mb-8">
                        <i class="fas fa-quote-left text-2xl text-blue-500"></i>
                    </div>

                    <blockquote class="text-2xl lg:text-3xl text-slate-800 font-light leading-relaxed mb-8">
                        Pengawasan Internal adalah kunci untuk memastikan transparansi dan akuntabilitas dalam setiap aspek organisasi.
                    </blockquote>

                    <div class="flex items-center justify-center lg:justify-start">
                        <div class="w-8 h-0.5 bg-blue-300 mr-4"></div>
                        <cite class="text-slate-600 font-medium">Kepala SPI POLSRI</cite>
                        <div class="w-8 h-0.5 bg-blue-300 ml-4"></div>
                    </div>
                </div>

                <div class="w-52 h-72 sm:w-64 sm:h-80 border-2 border-blue-300 rounded-2xl overflow-hidden shadow-2xl transition-all duration-300 transform hover:scale-105">
                    <img src="<?= base_url('images/kepala-spi.jpg') ?>" alt="Foto Kepala SPI" class="w-full h-full object-cover">
                </div>

            </div>
        </div>
    </section>

    <!-- ========= KEGIATAN SECTION ========= -->
    <section class="bg-gradient-to-br from-indigo-900 via-blue-800 to-slate-800 py-28">
        <div class="container mx-auto px-6">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <div class="inline-block p-3 bg-white/10 rounded-xl mb-6">
                    <i class="fas fa-calendar-alt text-2xl text-blue-300"></i>
                </div>
                <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">Kegiatan</h2>
                <div class="w-12 h-1 bg-blue-300 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Featured Gallery -->
                <div class="space-y-8">
                    <div class="relative overflow-hidden rounded-xl shadow-lg group">
                        <div class="flex transition-transform duration-700 ease-out" id="kegiatan-container">
                            <?php if (!empty($kegiatan_terbaru)) : ?>
                                <?php foreach ($kegiatan_terbaru as $kegiatan) : ?>
                                    <?php
                                    $doc = new DOMDocument();
                                    @$doc->loadHTML($kegiatan['konten']);
                                    $tags = $doc->getElementsByTagName('img');
                                    $imageUrl = '';

                                    if ($tags->length > 0) {
                                        $imageUrl = $tags->item(0)->getAttribute('src');
                                    } else {
                                        $imageUrl = 'https://placehold.co/800x500/E3F2FD/1976D2?text=Kegiatan+SPI+POLSRI';
                                    }
                                    ?>
                                    <div class="min-w-full relative">
                                        <img src="<?= esc($imageUrl); ?>" alt="<?= esc($kegiatan['judul']); ?>" class="w-full h-80 lg:h-96 object-cover">
                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/30 to-transparent"></div>
                                        <div class="absolute bottom-6 left-6 right-6 text-white">
                                            <a href="<?= base_url('kegiatan/' . $kegiatan['slug']); ?>" class="block">
                                                <h4 class="text-xl lg:text-2xl font-semibold leading-tight mb-2 line-clamp-2">
                                                    <?= esc($kegiatan['judul']); ?>
                                                </h4>
                                                <p class="text-slate-300 text-sm">
                                                    <?= esc(date('d F Y', strtotime($kegiatan['created_at']))); ?>
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class="min-w-full relative">
                                    <img src="https://placehold.co/800x500/E3F2FD/1976D2?text=No+Activities+Yet" alt="No Activities" class="w-full h-80 lg:h-96 object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/30 to-transparent"></div>
                                    <div class="absolute bottom-6 left-6 right-6 text-white">
                                        <h4 class="text-xl lg:text-2xl font-semibold leading-tight mb-2">Belum Ada Kegiatan</h4>
                                        <p class="text-slate-300 text-sm">Kembali lagi nanti untuk melihat pembaruan.</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Navigation buttons -->
                        <button id="prevKegiatan" class="absolute top-1/2 left-4 -translate-y-1/2 bg-white/90 hover:bg-white rounded-full p-2.5 shadow-md transition-all duration-300">
                            <i class="fas fa-chevron-left text-slate-600"></i>
                        </button>
                        <button id="nextKegiatan" class="absolute top-1/2 right-4 -translate-y-1/2 bg-white/90 hover:bg-white rounded-full p-2.5 shadow-md transition-all duration-300">
                            <i class="fas fa-chevron-right text-slate-600"></i>
                        </button>
                    </div>
                </div>

                <!-- Activity List -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold text-white">Kegiatan Terbaru</h3>
                    <div class="space-y-3">
                        <?php if (!empty($kegiatan_terbaru)) : ?>
                            <?php foreach (array_slice($kegiatan_terbaru, 0, 5) as $kegiatan) : ?>
                                <a href="<?= base_url('kegiatan/' . $kegiatan['id']); ?>" class="group flex bg-white/5 rounded-xl p-4 shadow-sm border border-white/5 hover:shadow-md hover:border-blue-500 transition-all duration-300">
                                    <div class="flex-1 min-w-0">
                                        <h5 class="font-semibold text-white group-hover:text-blue-300 transition-colors duration-300 line-clamp-2">
                                            <?= esc($kegiatan['judul']); ?>
                                        </h5>
                                        <p class="text-sm text-slate-300 mt-1">
                                            <?= esc(date('d F Y', strtotime($kegiatan['created_at']))); ?>
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0 ml-4">
                                        <i class="fas fa-arrow-right text-slate-400 group-hover:text-blue-300 transition-colors duration-300"></i>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="bg-white/5 rounded-xl p-8 text-center border border-white/5">
                                <i class="fas fa-calendar-times text-3xl text-slate-300 mb-4"></i>
                                <p class="text-slate-300">Belum ada kegiatan tersedia</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="pt-4">
                        <a href="/kegiatan" class="inline-flex items-center justify-center w-full px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl transition-all duration-300 shadow-sm hover:shadow-md">
                            <span class="mr-2">Lihat Semua Kegiatan</span>
                            <i class="fas fa-arrow-right text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ========= DOKUMEN SECTION ========= -->
    <section class="bg-gradient-to-br from-blue-50 via-cyan-50 to-sky-50 py-28">
        <div class="container mx-auto px-6">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <div class="inline-block p-3 bg-blue-600/10 rounded-xl mb-6">
                    <i class="fas fa-file-alt text-2xl text-blue-600"></i>
                </div>
                <h2 class="text-3xl lg:text-4xl font-bold text-slate-800 mb-4">Dokumen & Publikasi</h2>
                <p class="text-slate-600 max-w-2xl mx-auto">Akses dokumen resmi dan publikasi SPI POLSRI</p>
                <div class="w-12 h-1 bg-blue-600 mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Public Document -->
                <div class="group bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300 border border-slate-100">
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-blue-100/80 rounded-xl">
                            <i class="fas fa-check-circle text-xl text-blue-600"></i>
                        </div>
                        <span class="px-3 py-1 bg-blue-100/80 text-blue-700 rounded-lg text-xs font-medium">Publik</span>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-800 mb-3 group-hover:text-blue-600 transition-colors">
                        Laporan Tahunan 2024
                    </h3>
                    <p class="text-slate-600 mb-6 text-sm leading-relaxed">
                        Ringkasan komprehensif laporan tahunan SPI untuk tahun 2024 dengan analisis mendalam.
                    </p>
                    <a href="#" class="inline-flex items-center text-blue-600 font-medium hover:text-blue-700 transition-colors">
                        <i class="fas fa-download text-sm mr-2"></i>
                        <span>Unduh Dokumen</span>
                    </a>
                </div>

                <!-- Restricted Document -->
                <div class="group bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300 border border-slate-100">
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-red-100/80 rounded-xl">
                            <i class="fas fa-lock text-xl text-red-600"></i>
                        </div>
                        <span class="px-3 py-1 bg-red-100/80 text-red-700 rounded-lg text-xs font-medium">Terbatas</span>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-800 mb-3 group-hover:text-red-600 transition-colors">
                        Hasil Audit Internal
                    </h3>
                    <p class="text-slate-600 mb-6 text-sm leading-relaxed">
                        Dokumen khusus yang hanya dapat diakses oleh pengguna dengan otorisasi.
                    </p>
                    <button class="inline-flex items-center text-red-600 font-medium cursor-not-allowed opacity-75">
                        <i class="fas fa-lock text-sm mr-2"></i>
                        <span>Akses Terbatas</span>
                    </button>
                </div>

                <!-- SOP Document -->
                <div class="group bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-all duration-300 border border-slate-100">
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-cyan-100/80 rounded-xl">
                            <i class="fas fa-clipboard-list text-xl text-cyan-600"></i>
                        </div>
                        <span class="px-3 py-1 bg-cyan-100/80 text-cyan-700 rounded-lg text-xs font-medium">Publik</span>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-800 mb-3 group-hover:text-cyan-600 transition-colors">
                        Panduan SOP Audit
                    </h3>
                    <p class="text-slate-600 mb-6 text-sm leading-relaxed">
                        Standard Operating Procedure untuk proses audit internal dan panduan pelaksanaan.
                    </p>
                    <a href="#" class="inline-flex items-center text-cyan-600 font-medium hover:text-cyan-700 transition-colors">
                        <i class="fas fa-download text-sm mr-2"></i>
                        <span>Unduh Panduan</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ========= UPG SECTION ========= -->
    <section class="bg-gradient-to-br from-indigo-900 via-blue-800 to-slate-800 py-28 relative overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute top-0 right-0 w-96 h-96 bg-blue-500/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-72 h-72 bg-indigo-500/20 rounded-full blur-3xl"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-12">
                <!-- Content -->
                <div class="flex-1 text-center lg:text-left">
                    <div class="inline-flex items-center mb-8">
                        <div class="p-4 bg-white/10 backdrop-blur-sm rounded-xl mr-4">
                            <i class="fas fa-exclamation-triangle text-2xl text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-2">Unit Pengawasan Gratifikasi</h2>
                            <div class="w-16 h-1 bg-blue-300 rounded-full"></div>
                        </div>
                    </div>

                    <p class="text-lg text-blue-100 mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Laporkan setiap pelanggaran atau gratifikasi yang Anda ketahui. Mari bersama-sama menjaga integritas dan menciptakan lingkungan kerja yang bersih.
                    </p>

                    <div class="flex flex-wrap justify-center lg:justify-start gap-6 text-blue-100 text-sm mb-8">
                        <div class="flex items-center">
                            <i class="fas fa-user-secret text-green-300 mr-2"></i>
                            Laporan Anonim
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-shield-alt text-yellow-300 mr-2"></i>
                            Terjamin Kerahasiaan
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-bolt text-blue-300 mr-2"></i>
                            Proses Cepat
                        </div>
                    </div>
                </div>

                <!-- Action Card -->
                <div class="flex-shrink-0">
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl p-8 border border-white/20 text-center min-w-[300px]">
                        <div class="inline-block p-4 bg-white/10 rounded-full mb-6">
                            <i class="fas fa-edit text-3xl text-blue-200"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-3">Buat Laporan Sekarang</h3>
                        <p class="text-blue-100 mb-8 text-sm">Sistem pelaporan yang aman dan terpercaya tersedia 24/7</p>

                        <a href="/laporan" class="inline-flex items-center justify-center w-full bg-white text-blue-600 px-8 py-4 rounded-xl font-semibold hover:bg-blue-50 transition-all duration-300 shadow-lg hover:shadow-xl group">
                            <i class="fas fa-plus mr-3 group-hover:scale-110 transition-transform"></i>
                            <span>Buat Laporan</span>
                        </a>

                        <div class="mt-6 flex justify-center space-x-6 text-xs text-blue-200">
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                                24/7 Available
                            </div>
                            <div class="flex items-center">
                                <div class="w-2 h-2 bg-yellow-400 rounded-full mr-2 animate-pulse"></div>
                                Fast Response
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- ========= MINIMALIST STYLES ========= -->
<style>
    /* Smooth animations */
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

    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-8px);
        }
    }

    /* Hero animations */
    .hero-icon {
        animation: float 3s ease-in-out infinite;
    }

    .hero-title {
        animation: fadeInUp 0.8s ease-out 0.2s both;
    }

    .hero-subtitle {
        animation: fadeInUp 0.8s ease-out 0.4s both;
    }

    .hero-line {
        animation: fadeInUp 0.8s ease-out 0.6s both;
    }

    /* Line clamp */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Smooth transitions */
    * {
        transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 300ms;
    }

    /* Custom scrollbar */
    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f5f9;
    }

    ::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 3px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    /* Reduced motion */
    @media (prefers-reduced-motion: reduce) {

        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>

<!-- ========= ENHANCED SCRIPTS ========= -->
<script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Hero Slider
        class HeroSlider {
            constructor() {
                this.slider = document.getElementById('slider-container');
                this.slides = this.slider?.children.length || 0;
                this.dots = document.querySelectorAll('#hero-dots button');
                this.currentSlide = 0;

                if (this.slides > 0) {
                    this.init();
                }
            }

            init() {
                this.updateDots();
                this.startAutoSlide();
                this.addEventListeners();
            }

            updateDots() {
                this.dots.forEach((dot, index) => {
                    const isActive = index === this.currentSlide;
                    dot.classList.toggle('bg-white', isActive);
                    dot.classList.toggle('bg-white/50', !isActive);
                    dot.classList.toggle('w-6', isActive);
                    dot.classList.toggle('w-2', !isActive);
                });
            }

            slideToIndex(targetSlide) {
                this.currentSlide = (targetSlide + this.slides) % this.slides;
                this.slider.style.transform = `translateX(-${this.currentSlide * 100}%)`;
                this.updateDots();
            }

            addEventListeners() {
                this.dots.forEach((dot, index) => {
                    dot.addEventListener('click', () => {
                        this.slideToIndex(index);
                    });
                });
            }

            startAutoSlide() {
                if (this.slides <= 1) return;
                setInterval(() => {
                    this.slideToIndex(this.currentSlide + 1);
                }, 5000);
            }
        }

        // Activity Slider
        class ActivitySlider {
            constructor() {
                this.slider = document.getElementById('kegiatan-container');
                this.slides = this.slider?.children.length || 0;
                this.currentSlide = 0;
                this.prevBtn = document.getElementById('prevKegiatan');
                this.nextBtn = document.getElementById('nextKegiatan');

                if (this.slides > 1) {
                    this.init();
                }
            }

            init() {
                this.addEventListeners();
                this.startAutoSlide();
            }

            slideToIndex(targetSlide) {
                this.currentSlide = (targetSlide + this.slides) % this.slides;
                this.slider.style.transform = `translateX(-${this.currentSlide * 100}%)`;
            }

            addEventListeners() {
                this.prevBtn?.addEventListener('click', () => {
                    this.slideToIndex(this.currentSlide - 1);
                });

                this.nextBtn?.addEventListener('click', () => {
                    this.slideToIndex(this.currentSlide + 1);
                });
            }

            startAutoSlide() {
                setInterval(() => {
                    this.slideToIndex(this.currentSlide + 1);
                }, 7000);
            }
        }

        // Smooth scroll enhancements
        document.addEventListener('click', (e) => {
            if (e.target.matches('a[href^="#"]')) {
                e.preventDefault();
                const target = document.querySelector(e.target.getAttribute('href'));
                if (target) {
                    const headerOffset = 80;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            }
        });

        // Initialize components
        new HeroSlider();
        new ActivitySlider();

        // Intersection Observer for animations
        const observerOptions = {
            rootMargin: '50px 0px',
            threshold: 0.1
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe sections for scroll animations
        document.querySelectorAll('section').forEach(section => {
            observer.observe(section);
        });

        // Add loading states for buttons
        const buttons = document.querySelectorAll('button, a[href^="/"]');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                if (!this.disabled && !e.defaultPrevented) {
                    this.style.opacity = '0.7';
                    setTimeout(() => {
                        this.style.opacity = '';
                    }, 1500);
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>