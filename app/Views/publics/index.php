<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<!-- Full width container tanpa padding -->
<div class="w-full">
    <!-- ========= HERO SECTION ========= -->
    <section id="hero-slider" class="relative w-full overflow-hidden">
        <div class="relative h-[65vh] min-h-[500px] max-h-[700px]">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-900/70 via-slate-800/50 to-slate-700/30 z-10"></div>

            <div class="absolute inset-0 z-15 pointer-events-none">
                <div class="particle particle-1"></div>
                <div class="particle particle-2"></div>
                <div class="particle particle-3"></div>
                <div class="particle particle-4"></div>
                <div class="particle particle-5"></div>
                <div class="particle particle-6"></div>
            </div>

            <!-- Slider container -->
            <div class="flex transition-all duration-1000 ease-in-out h-full" id="slider-container">
                <!-- Slide 1 -->
                <div class="min-w-full h-540 bg-cover bg-center relative hero-slide" style="background-image: url('<?= base_url('images/image1.jpg') ?>');">
                    <div class="absolute inset-0 bg-gradient-to-t from-indigo-900/50 to-transparent"></div>
                </div>
                <!-- Slide 2 -->
                <div class="min-w-full h-540 bg-cover bg-center relative hero-slide" style="background-image: url('<?= base_url('images/image2.jpg') ?>');">
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-900/50 to-transparent"></div>
                </div>
                <!-- Slide 3 -->
                <div class="min-w-full h-540 bg-cover bg-center relative hero-slide" style="background-image: url('<?= base_url('images/image3.jpg') ?>');">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/50 to-transparent"></div>
                </div>
            </div>

            <!-- Hero content overlay -->
            <div class="absolute inset-0 flex items-center justify-center z-20">
                <div class="text-center text-white px-6 max-w-4xl">
                    <div class="inline-block p-4 bg-white/15 backdrop-blur-md rounded-xl mb-8">
                        <i class="fas fa-bullseye text-4xl text-white"></i>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-bold p-2 mb-6 hero-title bg-gradient-to-r from-white via-blue-100 to-indigo-200 bg-clip-text text-transparent">
                        Satuan Pengawas Internal
                    </h1>
                    <p class="text-xl md:text-2xl text-blue-100 mb-8 font-light leading-relaxed hero-subtitle">
                        Politeknik Negeri Sriwijaya
                    </p>
                    <div class="w-20 h-1 bg-gradient-to-r from-blue-400 to-indigo-400 mx-auto rounded-full hero-line"></div>
                </div>
            </div>

            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex items-center gap-3 z-30" id="hero-dots">
                <button class="w-2 h-2 rounded-full bg-white/50 hover:bg-white transition-all duration-300 dot-glow" data-slide="0"></button>
                <button class="w-2 h-2 rounded-full bg-white/50 hover:bg-white transition-all duration-300 dot-glow" data-slide="1"></button>
                <button class="w-2 h-2 rounded-full bg-white/50 hover:bg-white transition-all duration-300 dot-glow" data-slide="2"></button>
            </div>
        </div>
    </section>

    <!-- ========= LOGO PARTNERSHIP ========= -->
    <section class="py-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-12 left-20 w-32 h-32 bg-gradient-to-br from-black-200 to-indigo-200 rounded-full blur-2xl floating-slow"></div>
            <div class="absolute bottom-12 right-20 w-24 h-24 bg-gradient-to-br from-indigo-200 to-slate-200 rounded-full blur-xl floating-reverse"></div>
        </div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-wrap justify-center items-center gap-12">
                <div class="logo-hover">
                    <a href="https://kemdiktisaintek.go.id/" target="_blank" rel="noopener noreferrer">
                        <img src="<?= base_url('images/icons/kemenristek.png') ?>" alt="Kemenristek" class="h-24 w-auto object-contain">
                    </a>
                </div>
                <div class="logo-hover">
                    <a href="https://polsri.ac.id/" target="_blank" rel="noopener noreferrer">
                        <img src="<?= base_url('images/icons/polsri.png') ?>" alt="POLSRI" class="h-24 w-auto object-contain">
                    </a>
                </div>
                <div class="logo-hover">
                    <img src="<?= base_url('images/icons/blu.png') ?>" alt="BLU" class="h-24 w-auto object-contain">
                </div>
                <div class="logo-hover">
                    <img src="<?= base_url('images/icons/diktisaintek.png') ?>" alt="Ristek" class="h-24 w-auto object-contain">
                </div>
            </div>
        </div>
    </section>

    <!-- ========= QUOTE SECTION ========= -->
    <section class="py-18 mb-14 lg:py-26 relative overflow-hidden">
        <!-- Dynamic background elements -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-1/4 right-10 w-80 h-80 bg-gradient-to-br from-indigo-300/20 to-blue-300/10 rounded-full blur-3xl pulse-animation"></div>
            <div class="absolute bottom-1/4 left-10 w-96 h-96 bg-gradient-to-br from-blue-300/15 to-slate-300/10 rounded-full blur-3xl pulse-animation-delayed"></div>
        </div>

        <!-- Bordered Container -->
        <div class="container mx-auto px-4 sm:px-6 relative z-10">
            <div class="border border-gray-700/50 rounded-3xl backdrop-blur-sm px-6 sm:px-10 py-10 sm:py-14 flex flex-col lg:flex-row items-center lg:items-start justify-center gap-8 sm:gap-12 lg:gap-20">
                <!-- Quote Content -->
                <div class="text-center lg:text-left max-w-xl sm:max-w-2xl">
                    <div class="inline-block p-3 bg-gradient-to-br from-indigo-100 to-blue-100 backdrop-blur-sm rounded-xl mb-6 sm:mb-8">
                        <i class="fas fa-quote-left text-xl sm:text-2xl text-indigo-600"></i>
                    </div>

                    <blockquote class="text-lg sm:text-xl lg:text-3xl text-gray-800 font-light leading-relaxed mb-6 sm:mb-8 quote-text break-words">
                        Pengawasan Internal adalah kunci untuk memastikan transparansi dan akuntabilitas dalam setiap aspek organisasi.
                    </blockquote>

                    <div class="flex flex-wrap items-center justify-center lg:justify-start quote-author gap-2 sm:gap-4">
                        <div class="w-6 sm:w-8 h-0.5 bg-gradient-to-r from-indigo-300 to-blue-300"></div>
                        <cite class="text-gray-800 font-medium text-sm sm:text-base">Kepala SPI POLSRI</cite>
                        <div class="w-6 sm:w-8 h-0.5 bg-gradient-to-r from-blue-300 to-indigo-300"></div>
                    </div>
                </div>

                <!-- Photo Frame -->
                <div class="photo-frame">
                    <div class="w-40 h-56 sm:w-52 sm:h-72 md:w-64 md:h-80 border-2 border-gradient-to-br from-indigo-300 to-blue-300 rounded-2xl overflow-hidden shadow-2xl transition-all duration-500 hover:shadow-indigo-200/50 hover:scale-105 relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-indigo-600/10 to-blue-600/10 z-10"></div>
                        <img src="<?= base_url('images/profil.png') ?>" alt="Foto Kepala SPI" class="w-full h-full object-fit relative z-0">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ========= KEGIATAN SECTION ========= -->
    <section class="pt-23 relative overflow-hidden">

        <div class="container mx-auto px-6 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <div class="inline-block p-3 bg-gradient-to-br from-gray-100/60 to-blue-200/40 rounded-xl mb-6">
                    <i class="fas fa-calendar-alt text-2xl text-gray-800"></i>
                </div>
                <h2 class="text-3xl lg:text-4xl font-bold text-transparent bg-gradient-to-r from-gray-700 via-gray-900 to-blue-900 bg-clip-text pb-2 mb-2">Kegiatan</h2>
                <div class="w-12 h-1 bg-gradient-to-r from-blue-400 to-gray-500 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Gallery -->
                <div class="space-y-8">
                    <div class="relative overflow-hidden rounded-xl shadow-2xl group gallery-container">
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
                                        $imageUrl = 'https://placehold.co/800x500/1E40AF/FFFFFF?text=Kegiatan+SPI+POLSRI';
                                    }
                                    ?>
                                    <div class="min-w-full relative">
                                        <img src="<?= esc($imageUrl); ?>" alt="<?= esc($kegiatan['judul']); ?>" class="w-full h-80 lg:h-96 object-cover">
                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-gray-800/40 to-transparent"></div>
                                        <div class="absolute bottom-6 left-6 right-6 text-white">
                                            <a href="<?= base_url('kegiatan/' . $kegiatan['slug']); ?>" class="block group-hover:scale-105 transition-transform duration-300">
                                                <h4 class="text-xl lg:text-2xl font-semibold leading-tight mb-2 line-clamp-2">
                                                    <?= esc($kegiatan['judul']); ?>
                                                </h4>
                                                <p class="text-blue-200 text-sm">
                                                    <?= esc(date('d F Y', strtotime($kegiatan['created_at']))); ?>
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class="min-w-full relative">
                                    <img src="https://placehold.co/800x500/1E40AF/FFFFFF?text=No+Activities+Yet" alt="No Activities" class="w-full h-80 lg:h-96 object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-gray-800/40 to-transparent"></div>
                                    <div class="absolute bottom-6 left-6 right-6 text-white">
                                        <h4 class="text-xl lg:text-2xl font-semibold leading-tight mb-2">Belum Ada Kegiatan</h4>
                                        <p class="text-blue-200 text-sm">Kembali lagi nanti untuk melihat pembaruan.</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Enhanced Navigation buttons -->
                        <button id="prevKegiatan" class="nav-btn nav-btn-left absolute top-1/2 left-4 -translate-y-1/2 bg-white/90 hover:bg-white rounded-full p-3 shadow-lg transition-all duration-300 hover:scale-110">
                            <i class="fas fa-chevron-left text-blue-600"></i>
                        </button>
                        <button id="nextKegiatan" class="nav-btn nav-btn-right absolute top-1/2 right-4 -translate-y-1/2 bg-white/90 hover:bg-white rounded-full p-3 shadow-lg transition-all duration-300 hover:scale-110">
                            <i class="fas fa-chevron-right text-blue-600"></i>
                        </button>
                    </div>
                </div>

                <!-- Activity List -->
                <div class="space-y-6">
                    <h3 class="text-xl font-semibold text-gray-900">Kegiatan Terbaru</h3>
                    <div class="space-y-3">
                        <?php if (!empty($kegiatan_terbaru)) : ?>
                            <?php foreach (array_slice($kegiatan_terbaru, 0, 5) as $kegiatan) : ?>
                                <a href="<?= base_url('kegiatan/' . $kegiatan['id']); ?>" class="activity-item group flex bg-gradient-to-r from-gray-50/70 to-blue-50/70 rounded-xl p-4 shadow-sm border border-gray-100 hover:shadow-lg hover:border-blue-300 transition-all duration-300 backdrop-blur-sm">
                                    <div class="flex-1 min-w-0">
                                        <h5 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-300 line-clamp-2">
                                            <?= esc($kegiatan['judul']); ?>
                                        </h5>
                                        <p class="text-sm text-gray-600 mt-1">
                                            <?= esc(date('d F Y', strtotime($kegiatan['created_at']))); ?>
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0 ml-4 flex items-center">
                                        <i class="fas fa-arrow-right text-gray-500 group-hover:text-blue-600 transition-all duration-300 group-hover:translate-x-1"></i>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl p-8 text-center border border-gray-100 backdrop-blur-sm">
                                <i class="fas fa-calendar-times text-3xl text-gray-400 mb-4"></i>
                                <p class="text-gray-600">Belum ada kegiatan tersedia</p>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="pt-4">
                        <a href="/kegiatan" class="cta-button inline-flex items-center justify-center w-full px-6 py-4 bg-gradient-to-r from-blue-600 to-gray-700 hover:from-blue-500 hover:to-gray-600 text-white font-medium rounded-xl transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105">
                            <span class="mr-2">Lihat Semua Kegiatan</span>
                            <i class="fas fa-arrow-right text-sm transition-transform group-hover:translate-x-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ========= DOKUMEN SECTION ========= -->
    <section class="py-28 relative overflow-hidden">
        <!-- Animated background -->
        <div class="absolute inset-0 opacity-30">
            <div class="absolute top-20 left-1/4 w-40 h-40 bg-gradient-to-br from-indigo-200 to-blue-200 rounded-full blur-2xl document-float"></div>
            <div class="absolute bottom-20 right-1/4 w-32 h-32 bg-gradient-to-br from-blue-200 to-slate-200 rounded-full blur-xl document-float-reverse"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <div class="inline-block p-3 bg-gradient-to-br from-slate-100 to-blue-100 rounded-xl mb-6">
                    <i class="fas fa-file-alt text-2xl text-blue-600"></i>
                </div>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 mb-4">Dokumen & Publikasi</h2>
                <p class="text-slate-600 max-w-2xl mx-auto">Akses dokumen resmi dan publikasi SPI POLSRI</p>
                <div class="w-12 h-1 bg-gradient-to-r from-indigo-500 to-blue-500 mx-auto mt-6 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Public Document -->
                <div class="document-card group bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-slate-200 hover:border-blue-300">
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl">
                            <i class="fas fa-check-circle text-xl text-blue-600"></i>
                        </div>
                        <span class="px-3 py-1 bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-700 rounded-lg text-xs font-medium">Publik</span>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-800 mb-3 group-hover:text-blue-600 transition-colors">
                        Laporan Tahunan 2024
                    </h3>
                    <p class="text-slate-600 mb-6 text-sm leading-relaxed">
                        Ringkasan komprehensif laporan tahunan SPI untuk tahun 2024 dengan analisis mendalam.
                    </p>
                    <a href="#" class="inline-flex items-center text-blue-600 font-medium hover:text-blue-700 transition-colors group">
                        <i class="fas fa-download text-sm mr-2 transition-transform group-hover:scale-110"></i>
                        <span>Unduh Dokumen</span>
                    </a>
                </div>


                <!-- Restricted Document -->
                <div class="document-card group bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-slate-200 hover:border-indigo-300">
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-gradient-to-br from-slate-100 to-blue-100 rounded-xl">
                            <i class="fas fa-lock text-xl text-slate-600"></i>
                        </div>
                        <span class="px-3 py-1 bg-gradient-to-r from-slate-100 to-blue-100 text-slate-700 rounded-lg text-xs font-medium">Terbatas</span>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-800 mb-3 group-hover:text-slate-600 transition-colors">
                        Hasil Audit Internal
                    </h3>
                    <p class="text-slate-600 mb-6 text-sm leading-relaxed">
                        Dokumen khusus yang hanya dapat diakses oleh pengguna dengan otorisasi.
                    </p>
                    <button class="inline-flex items-center text-slate-600 font-medium cursor-not-allowed opacity-75 group">
                        <i class="fas fa-lock text-sm mr-2"></i>
                        <span>Akses Terbatas</span>
                    </button>
                </div>

                <!-- SOP Document -->
                <div class="document-card group bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-slate-200 hover:border-indigo-300">
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl">
                            <i class="fas fa-clipboard-list text-xl text-indigo-600"></i>
                        </div>
                        <span class="px-3 py-1 bg-gradient-to-r from-blue-100 to-indigo-100 text-indigo-700 rounded-lg text-xs font-medium">Publik</span>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-800 mb-3 group-hover:text-indigo-600 transition-colors">
                        Panduan SOP Audit
                    </h3>
                    <p class="text-slate-600 mb-6 text-sm leading-relaxed">
                        Standard Operating Procedure untuk proses audit internal dan panduan pelaksanaan.
                    </p>
                    <a href="#" class="inline-flex items-center text-indigo-600 font-medium hover:text-indigo-700 transition-colors group">
                        <i class="fas fa-download text-sm mr-2 transition-transform group-hover:scale-110"></i>
                        <span>Unduh Panduan</span>
                    </a>
                </div>

                <div class="document-card group bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-slate-200 hover:border-blue-300">
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl">
                            <i class="fas fa-check-circle text-xl text-blue-600"></i>
                        </div>
                        <span class="px-3 py-1 bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-700 rounded-lg text-xs font-medium">Publik</span>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-800 mb-3 group-hover:text-blue-600 transition-colors">
                        Laporan Tahunan 2024
                    </h3>
                    <p class="text-slate-600 mb-6 text-sm leading-relaxed">
                        Ringkasan komprehensif laporan tahunan SPI untuk tahun 2024 dengan analisis mendalam.
                    </p>
                    <a href="#" class="inline-flex items-center text-blue-600 font-medium hover:text-blue-700 transition-colors group">
                        <i class="fas fa-download text-sm mr-2 transition-transform group-hover:scale-110"></i>
                        <span>Unduh Dokumen</span>
                    </a>
                </div>

                <div class="document-card group bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-slate-200 hover:border-blue-300">
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl">
                            <i class="fas fa-check-circle text-xl text-blue-600"></i>
                        </div>
                        <span class="px-3 py-1 bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-700 rounded-lg text-xs font-medium">Publik</span>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-800 mb-3 group-hover:text-blue-600 transition-colors">
                        Laporan Tahunan 2024
                    </h3>
                    <p class="text-slate-600 mb-6 text-sm leading-relaxed">
                        Ringkasan komprehensif laporan tahunan SPI untuk tahun 2024 dengan analisis mendalam.
                    </p>
                    <a href="#" class="inline-flex items-center text-blue-600 font-medium hover:text-blue-700 transition-colors group">
                        <i class="fas fa-download text-sm mr-2 transition-transform group-hover:scale-110"></i>
                        <span>Unduh Dokumen</span>
                    </a>
                </div>

                <div class="document-card group bg-white/80 backdrop-blur-sm rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-slate-200 hover:border-blue-300">
                    <div class="flex justify-between items-start mb-6">
                        <div class="p-3 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-xl">
                            <i class="fas fa-check-circle text-xl text-blue-600"></i>
                        </div>
                        <span class="px-3 py-1 bg-gradient-to-r from-blue-100 to-indigo-100 text-blue-700 rounded-lg text-xs font-medium">Publik</span>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-800 mb-3 group-hover:text-blue-600 transition-colors">
                        Laporan Tahunan 2024
                    </h3>
                    <p class="text-slate-600 mb-6 text-sm leading-relaxed">
                        Ringkasan komprehensif laporan tahunan SPI untuk tahun 2024 dengan analisis mendalam.
                    </p>
                    <a href="#" class="inline-flex items-center text-blue-600 font-medium hover:text-blue-700 transition-colors group">
                        <i class="fas fa-download text-sm mr-2 transition-transform group-hover:scale-110"></i>
                        <span>Unduh Dokumen</span>
                    </a>
                </div>
            </div>
        </div>
    </section>


    <!-- LAPOR -->
    <section class="py-24 relative overflow-hidden">
        <div class="container mx-auto px-6 relative z-10">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8 lg:gap-12">
                <!-- Content -->
                <div class="flex-1 text-center lg:text-left">
                    <div class="inline-flex items-center mb-8">
                        <div class="p-4 bg-gradient-to-br from-slate-800/70 to-slate-700/40 backdrop-blur-sm rounded-xl mr-4">
                            <i class="fas fa-exclamation-triangle text-2xl text-yellow-400"></i>
                        </div>
                        <div>
                            <h2 class="text-3xl lg:text-4xl font-bold text-gray-800">Unit Pengawasan Gratifikasi</h2>
                            <div class="w-16 h-1 bg-gradient-to-r from-indigo-500 to-blue-500 rounded-full"></div>
                        </div>
                    </div>

                    <p class="text-lg text-slate-700 mb-8 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                        Laporkan setiap pelanggaran atau gratifikasi yang Anda ketahui. Mari bersama-sama menjaga integritas dan menciptakan lingkungan kerja yang bersih.
                    </p>

                    <div class="flex flex-wrap justify-center lg:justify-start gap-6 text-slate-800 text-sm mb-8">
                        <div class="flex items-center feature-badge">
                            <i class="fas fa-user-secret text-blue-800 mr-2"></i>
                            Laporan Anonim
                        </div>
                        <div class="flex items-center feature-badge">
                            <i class="fas fa-shield-alt text-blue-800 mr-2"></i>
                            Terjamin Kerahasiaan
                        </div>
                        <div class="flex items-center feature-badge">
                            <i class="fas fa-bolt text-blue-800 mr-2"></i>
                            Proses Cepat
                        </div>
                    </div>
                </div>

                <!-- Action Card -->
                <div class="flex-1 max-w-lg w-full">
                    <div class="upg-card bg-gradient-to-br from-slate-800/70 to-slate-700/50 backdrop-blur-sm rounded-2xl p-8 border border-slate-600 text-center shadow-2xl">
                        <div class="inline-block p-4 bg-gradient-to-br from-slate-700/50 to-slate-600/30 rounded-full mb-6">
                            <i class="fas fa-edit text-3xl text-slate-300"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-white mb-3">Buat Laporan Sekarang</h3>
                        <p class="text-slate-100 mb-8 text-sm">Sistem pelaporan yang aman dan terpercaya tersedia 24/7</p>

                        <a href="/laporan/create" class="cta-button inline-flex items-center justify-center w-full bg-gradient-to-r from-indigo-600 to-blue-600 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-105 group hover:from-indigo-100 hover:to-blue-100 hover:text-slate-800">
                            <i class="fas fa-plus mr-3 group-hover:scale-110 transition-transform"></i>
                            <span>Buat Laporan</span>
                        </a>

                        <div class="mt-6 flex justify-center space-x-6 text-xs text-gray-100">
                            <div class="flex items-center status-indicator">
                                <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                                24/7 Available
                            </div>
                            <div class="flex items-center status-indicator">
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

<!-- ========= ENHANCED DYNAMIC STYLES ========= -->
<style>
    /* Enhanced smooth animations */
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

    @keyframes floatingParticle {
        0% {
            transform: translate(0, 0) rotate(0deg);
            opacity: 0.3;
        }

        33% {
            transform: translate(30px, -30px) rotate(120deg);
            opacity: 0.8;
        }

        66% {
            transform: translate(-20px, 20px) rotate(240deg);
            opacity: 0.5;
        }

        100% {
            transform: translate(0, 0) rotate(360deg);
            opacity: 0.3;
        }
    }

    @keyframes floatingSlow {

        0%,
        100% {
            transform: translateY(0px) translateX(0px) rotate(0deg);
        }

        50% {
            transform: translateY(-20px) translateX(10px) rotate(180deg);
        }
    }

    @keyframes floatingReverse {

        0%,
        100% {
            transform: translateY(0px) translateX(0px) rotate(0deg);
        }

        50% {
            transform: translateY(15px) translateX(-15px) rotate(-180deg);
        }
    }

    @keyframes pulseAnimation {

        0%,
        100% {
            transform: scale(1);
            opacity: 0.7;
        }

        50% {
            transform: scale(1.1);
            opacity: 0.9;
        }
    }

    @keyframes movingBg {
        0% {
            transform: translate(0, 0) rotate(0deg);
        }

        33% {
            transform: translate(50px, -30px) rotate(120deg);
        }

        66% {
            transform: translate(-30px, 40px) rotate(240deg);
        }

        100% {
            transform: translate(0, 0) rotate(360deg);
        }
    }

    @keyframes floatingDot {

        0%,
        100% {
            transform: translateY(0px) scale(1);
            opacity: 0.6;
        }

        50% {
            transform: translateY(-15px) scale(1.3);
            opacity: 1;
        }
    }

    @keyframes shimmerEffect {
        0% {
            background-position: -200px 0;
        }

        100% {
            background-position: calc(200px + 100%) 0;
        }
    }

    @keyframes gradientShift {

        0%,
        100% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }
    }

    /* Hero section enhancements */
    .hero-overlay {
        background: linear-gradient(135deg,
                rgba(15, 23, 42, 0.85) 0%,
                rgba(30, 41, 59, 0.75) 25%,
                rgba(67, 56, 202, 0.65) 50%,
                rgba(59, 130, 246, 0.55) 75%,
                rgba(37, 99, 235, 0.75) 100%);
        animation: gradientShift 8s ease infinite;
        background-size: 200% 200%;
    }

    .hero-slide {
        transition: all 1.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Floating particles */
    .particle {
        position: absolute;
        width: 4px;
        height: 4px;
        background: rgba(255, 255, 255, 0.6);
        border-radius: 50%;
        animation: floatingParticle 15s infinite linear;
    }

    .particle-1 {
        top: 20%;
        left: 10%;
        animation-delay: 0s;
        animation-duration: 12s;
    }

    .particle-2 {
        top: 60%;
        left: 20%;
        animation-delay: -2s;
        animation-duration: 14s;
    }

    .particle-3 {
        top: 30%;
        right: 15%;
        animation-delay: -4s;
        animation-duration: 16s;
    }

    .particle-4 {
        bottom: 40%;
        left: 70%;
        animation-delay: -6s;
        animation-duration: 13s;
    }

    .particle-5 {
        top: 80%;
        right: 30%;
        animation-delay: -8s;
        animation-duration: 15s;
    }

    .particle-6 {
        bottom: 20%;
        right: 60%;
        animation-delay: -10s;
        animation-duration: 11s;
    }

    /* Enhanced dot indicators */
    .dot-glow {
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .dot-glow:hover {
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
        transform: scale(1.2);
    }

    /* Logo hover effects */
    .logo-hover {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        opacity: 0.7;
    }

    .logo-hover:hover {
        opacity: 1;
        transform: scale(1.1) translateY(-5px);
        filter: drop-shadow(0 10px 20px rgba(67, 56, 202, 0.2));
    }

    /* Enhanced floating backgrounds */
    .floating-slow {
        animation: floatingSlow 8s ease-in-out infinite;
    }

    .floating-reverse {
        animation: floatingReverse 10s ease-in-out infinite;
    }

    .pulse-animation {
        animation: pulseAnimation 6s ease-in-out infinite;
    }

    .pulse-animation-delayed {
        animation: pulseAnimation 6s ease-in-out infinite;
        animation-delay: -3s;
    }

    .quote-text {
        animation: fadeInUp 0.8s ease-out 0.3s both;
    }

    .quote-author {
        animation: fadeInUp 0.8s ease-out 0.5s both;
    }

    .photo-frame {
        animation: fadeInUp 0.8s ease-out 0.7s both;
    }

    /* Activity section enhancements */
    .moving-bg {
        animation: movingBg 20s linear infinite;
    }

    .moving-bg-reverse {
        animation: movingBg 25s linear infinite reverse;
    }

    .floating-dot {
        animation: floatingDot 4s ease-in-out infinite;
    }

    .floating-dot-delayed {
        animation: floatingDot 4s ease-in-out infinite;
        animation-delay: -2s;
    }

    .floating-dot-slow {
        animation: floatingDot 6s ease-in-out infinite;
        animation-delay: -1s;
    }

    .gallery-container {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(67, 56, 202, 0.05));
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .nav-btn {
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .nav-btn:hover {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(67, 56, 202, 0.1));
        transform: scale(1.1);
        box-shadow: 0 8px 25px rgba(67, 56, 202, 0.3);
    }

    .activity-item {
        backdrop-filter: blur(10px);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .activity-item:hover {
        transform: translateY(-2px);
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.15), rgba(67, 56, 202, 0.15));
    }

    /* Document section */
    .document-float {
        animation: floatingSlow 12s ease-in-out infinite;
    }

    .document-float-reverse {
        animation: floatingReverse 15s ease-in-out infinite;
    }

    .document-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .document-card:hover {
        transform: translateY(-8px) scale(1.02);
        background: rgba(255, 255, 255, 0.95);
    }

    /* UPG section */
    .upg-float {
        animation: movingBg 30s linear infinite;
    }

    .upg-float-reverse {
        animation: movingBg 35s linear infinite reverse;
    }

    .upg-pulse {
        animation: pulseAnimation 8s ease-in-out infinite;
    }

    .upg-card {
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .upg-card:hover {
        transform: scale(1.05);
        box-shadow: 0 20px 40px rgba(67, 56, 202, 0.3);
    }

    .feature-badge {
        transition: all 0.3s ease;
        padding: 8px 18px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }

    .feature-badge:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    .status-indicator {
        transition: all 0.3s ease;
    }

    .status-indicator:hover {
        transform: scale(1.1);
    }

    /* CTA Button enhancements */
    .cta-button {
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .cta-button:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .cta-button:hover:before {
        left: 100%;
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

    /* Line clamp utility */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Smooth transitions for all elements */
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
        background: linear-gradient(180deg, #f1f5f9, #e2e8f0);
    }

    ::-webkit-scrollbar-thumb {
        background: linear-gradient(180deg, #6366f1, #3b82f6);
        border-radius: 3px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(180deg, #4f46e5, #2563eb);
    }

    /* Reduced motion support */
    @media (prefers-reduced-motion: reduce) {

        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }

    /* Dark mode enhancements */
    @media (prefers-color-scheme: dark) {
        .hero-overlay {
            background: linear-gradient(135deg,
                    rgba(15, 23, 42, 0.9) 0%,
                    rgba(30, 41, 59, 0.85) 25%,
                    rgba(67, 56, 202, 0.75) 50%,
                    rgba(59, 130, 246, 0.65) 75%,
                    rgba(37, 99, 235, 0.8) 100%);
        }
    }

    /* Mobile optimizations */
    @media (max-width: 768px) {
        .particle {
            display: none;
        }

        .floating-slow,
        .floating-reverse,
        .moving-bg,
        .moving-bg-reverse {
            animation-duration: 20s;
        }
    }
</style>

<!-- ========= ENHANCED SCRIPTS ========= -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Enhanced Hero Slider with smooth transitions
        class HeroSlider {
            constructor() {
                this.slider = document.getElementById('slider-container');
                this.slides = this.slider?.children.length || 0;
                this.dots = document.querySelectorAll('#hero-dots button');
                this.currentSlide = 0;
                this.isTransitioning = false;

                if (this.slides > 0) {
                    this.init();
                }
            }

            init() {
                this.updateDots();
                this.startAutoSlide();
                this.addEventListeners();
                this.preloadImages();
            }

            preloadImages() {
                // Preload next slide image for smooth transition
                const slides = this.slider.children;
                for (let i = 0; i < slides.length; i++) {
                    const img = new Image();
                    const bgImage = getComputedStyle(slides[i]).backgroundImage;
                    const url = bgImage.slice(4, -1).replace(/"/g, "");
                    if (url !== 'none') img.src = url;
                }
            }

            updateDots() {
                this.dots.forEach((dot, index) => {
                    const isActive = index === this.currentSlide;
                    dot.classList.toggle('bg-white', isActive);
                    dot.classList.toggle('bg-white/50', !isActive);
                    dot.classList.toggle('w-8', isActive);
                    dot.classList.toggle('w-2', !isActive);
                    dot.style.transform = isActive ? 'scale(1.2)' : 'scale(1)';
                });
            }

            slideToIndex(targetSlide) {
                if (this.isTransitioning) return;

                this.isTransitioning = true;
                this.currentSlide = (targetSlide + this.slides) % this.slides;

                // Enhanced transition with easing
                this.slider.style.transition = 'transform 1.2s cubic-bezier(0.4, 0, 0.2, 1)';
                this.slider.style.transform = `translateX(-${this.currentSlide * 100}%)`;

                this.updateDots();

                setTimeout(() => {
                    this.isTransitioning = false;
                }, 1200);
            }

            addEventListeners() {
                this.dots.forEach((dot, index) => {
                    dot.addEventListener('click', (e) => {
                        e.preventDefault();
                        this.slideToIndex(index);
                    });
                });

                // Touch support for mobile
                let startX = 0;
                let endX = 0;

                this.slider.addEventListener('touchstart', (e) => {
                    startX = e.touches[0].clientX;
                });

                this.slider.addEventListener('touchend', (e) => {
                    endX = e.changedTouches[0].clientX;
                    const difference = startX - endX;

                    if (Math.abs(difference) > 50) {
                        if (difference > 0) {
                            this.slideToIndex(this.currentSlide + 1);
                        } else {
                            this.slideToIndex(this.currentSlide - 1);
                        }
                    }
                });
            }

            startAutoSlide() {
                if (this.slides <= 1) return;
                setInterval(() => {
                    if (!this.isTransitioning) {
                        this.slideToIndex(this.currentSlide + 1);
                    }
                }, 6000);
            }
        }

        // Enhanced Activity Slider
        class ActivitySlider {
            constructor() {
                this.slider = document.getElementById('kegiatan-container');
                this.slides = this.slider?.children.length || 0;
                this.currentSlide = 0;
                this.prevBtn = document.getElementById('prevKegiatan');
                this.nextBtn = document.getElementById('nextKegiatan');
                this.isTransitioning = false;

                if (this.slides > 1) {
                    this.init();
                }
            }

            init() {
                this.addEventListeners();
                this.startAutoSlide();
            }

            slideToIndex(targetSlide) {
                if (this.isTransitioning) return;

                this.isTransitioning = true;
                this.currentSlide = (targetSlide + this.slides) % this.slides;

                this.slider.style.transition = 'transform 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
                this.slider.style.transform = `translateX(-${this.currentSlide * 100}%)`;

                setTimeout(() => {
                    this.isTransitioning = false;
                }, 800);
            }

            addEventListeners() {
                this.prevBtn?.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.slideToIndex(this.currentSlide - 1);
                });

                this.nextBtn?.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.slideToIndex(this.currentSlide + 1);
                });
            }

            startAutoSlide() {
                setInterval(() => {
                    if (!this.isTransitioning) {
                        this.slideToIndex(this.currentSlide + 1);
                    }
                }, 8000);
            }
        }

        // Enhanced smooth scrolling
        document.addEventListener('click', (e) => {
            if (e.target.matches('a[href^="#"]')) {
                e.preventDefault();
                const target = document.querySelector(e.target.getAttribute('href'));
                if (target) {
                    const headerOffset = 100;
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

        // Enhanced Intersection Observer for scroll animations
        const observerOptions = {
            rootMargin: '50px 0px',
            threshold: 0.15
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe sections for scroll animations
        document.querySelectorAll('section').forEach(section => {
            section.style.opacity = '0.3';
            section.style.transform = 'translateY(30px)';
            section.style.transition = 'opacity 0.8s ease-out, transform 0.8s ease-out';
            observer.observe(section);
        });

        // Enhanced loading states for interactive elements
        const interactiveElements = document.querySelectorAll('button, a[href^="/"], .cta-button');
        interactiveElements.forEach(element => {
            element.addEventListener('click', function(e) {
                if (!this.disabled && !e.defaultPrevented) {
                    // Add loading effect
                    this.style.transform = 'scale(0.95)';
                    this.style.opacity = '0.8';

                    setTimeout(() => {
                        this.style.transform = '';
                        this.style.opacity = '';
                    }, 200);
                }
            });
        });

        // Parallax effect for hero section
        let ticking = false;

        function updateParallax() {
            const scrolled = window.pageYOffset;
            const heroSection = document.getElementById('hero-slider');

            if (heroSection) {
                const rate = scrolled * -0.5;
                heroSection.style.transform = `translateY(${rate}px)`;
            }

            ticking = false;
        }

        function requestTick() {
            if (!ticking) {
                requestAnimationFrame(updateParallax);
                ticking = true;
            }
        }

        window.addEventListener('scroll', requestTick);

        // Performance optimization: Reduce animations on mobile
        if (window.innerWidth <= 768) {
            document.documentElement.style.setProperty('--animation-duration', '0.3s');
        }
    });
</script>

<?= $this->endSection() ?>