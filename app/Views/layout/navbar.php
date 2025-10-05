<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu SPI POLSRI</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Font Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #F8FAFC;
        }

        .shadow-soft {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .shadow-soft-xl {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Animasi abstrak untuk navbar */
        @keyframes float-nav {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-10px) rotate(90deg);
            }
        }

        @keyframes drift-nav {
            0% {
                transform: translateX(-50px) translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateX(30px) translateY(-15px) rotate(45deg);
            }

            100% {
                transform: translateX(-50px) translateY(0px) rotate(90deg);
            }
        }

        @keyframes pulse-nav {

            0%,
            100% {
                opacity: 0.4;
                transform: scale(1);
            }

            50% {
                opacity: 0.8;
                transform: scale(1.1);
            }
        }

        @keyframes slide-nav {
            0% {
                transform: translateX(-30px) scaleX(0.5);
            }

            50% {
                transform: translateX(30px) scaleX(1.2);
            }

            100% {
                transform: translateX(-30px) scaleX(0.5);
            }
        }

        .float-nav {
            animation: float-nav 6s ease-in-out infinite;
        }

        .drift-nav {
            animation: drift-nav 10s linear infinite;
        }

        .pulse-nav {
            animation: pulse-nav 4s ease-in-out infinite;
        }

        .slide-nav {
            animation: slide-nav 8s ease-in-out infinite;
        }

        /* Hover underline effect */
        .nav-link:hover .underline-effect {
            width: 100%;
        }

        /* Active link */
        .active {
            color: rgb(22, 22, 22) !important;
            font-weight: 600;
        }

        /* Mobile menu animation */
        #mobile-menu {
            transition: max-height 0.3s ease-in-out, opacity 0.3s ease-in-out;
            overflow: hidden;
            max-height: 0;
            opacity: 0;
        }

        #mobile-menu.is-open {
            max-height: 600px;
            opacity: 1;
        }

        /* Dropdown mobile */
        #mobile-profil-menu,
        #mobile-peraturan-menu {
            transition: max-height 0.3s ease-in-out;
            overflow: hidden;
            max-height: 0;
        }

        #mobile-profil-menu.is-open,
        #mobile-peraturan-menu.is-open {
            max-height: 400px;
        }

        /* Search input animation */
        #search-input-desktop {
            width: 0;
            transition: width 0.3s ease-in-out, opacity 0.3s ease-in-out;
            opacity: 0;
        }

        #search-input-desktop.is-expanded {
            width: 250px;
            opacity: 1;
        }

        @media (min-width: 1024px) {
            #search-input-desktop.is-expanded {
                width: 300px;
            }
        }

        /* Link shimmer effect */
        .nav-link {
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(254, 243, 199, 0.2), transparent);
            transition: left 0.5s;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        /* Custom gradients */
        .bg-navbar-gradient {
            background: linear-gradient(135deg, #60A5FA 0%, #3B82F6 50%, #2563EB 100%);
        }

        .bg-navbar-bottom-gradient {
            background: linear-gradient(135deg, #60A5FA 0%, #3B82F6 50%, #2563EB 100%);
        }

        .bg-mobile-gradient {
            background: linear-gradient(135deg, #3B82F6 0%, #2563EB 50%, #1D4ED8 100%);
        }
    </style>
</head>

<body>
    <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
        <!-- Bagian Atas dengan Animasi -->
        <div class="relative bg-navbar-gradient py-3 lg:py-4">
            <!-- Background animasi abstrak -->
            <div class="absolute inset-0 opacity-15">
                <!-- Floating shapes -->
                <div class="absolute top-2 left-10 w-2 h-2 bg-yellow-200 rotate-45 float-nav"></div>
                <div class="absolute top-4 right-20 w-1.5 h-8 bg-blue-200 slide-nav"></div>
                <div class="absolute bottom-2 left-1/4 w-2.5 h-2.5 bg-amber-300 rounded-full pulse-nav"></div>

                <!-- Drifting lines -->
                <div class="absolute top-1/2 right-16 w-12 h-0.5 bg-gradient-to-r from-transparent via-yellow-200 to-transparent drift-nav"></div>
                <div class="absolute bottom-3 left-1/3 w-10 h-0.5 bg-gradient-to-r from-blue-200 to-transparent float-nav"></div>

                <!-- Small geometric elements -->
                <div class="absolute top-3 right-1/3 w-1.5 h-1.5 bg-amber-200 drift-nav"></div>
                <div class="absolute bottom-4 right-10 w-1 h-1 bg-yellow-200 rotate-45 float-nav"></div>

                <!-- Pulsing dots -->
                <div class="absolute top-6 left-2/3 w-1 h-1 bg-amber-300 rounded-full pulse-nav" style="animation-delay: -1s;"></div>
                <div class="absolute bottom-1 left-12 w-0.5 h-0.5 bg-yellow-200 rounded-full pulse-nav" style="animation-delay: -3s;"></div>

                <!-- Moving triangles -->
                <div class="absolute top-1 right-12 w-0 h-0 border-l-1 border-r-1 border-b-2 border-transparent border-b-amber-200 drift-nav" style="animation-delay: -2s;"></div>

                <!-- Vertical sliding elements -->
                <div class="absolute top-0 left-2/3 w-0.5 h-4 bg-gradient-to-b from-transparent via-yellow-200 to-transparent slide-nav" style="animation-delay: -1.5s;"></div>
            </div>

            <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-10">
                    <a href="/" class="flex items-center space-x-3 group p-1 border border-white/20 rounded-lg shadow-sm">
                        <img src="<?= base_url('images/polsri.png') ?>" alt="Logo POLSRI"
                            class="h-10 sm:h-12 transition-all duration-300 drop-shadow-sm">
                        <div class="text-white font-bold text-left -space-y-1">
                            <div class="text-xs sm:text-xs tracking-wide">SATUAN</div>
                            <div class="text-xs sm:text-xs tracking-wide">PENGAWASAN</div>
                            <div class="text-xs sm:text-xs tracking-wide">INTERNAL</div>
                        </div>
                        <img src="<?= base_url('images/blu.png') ?>" alt="Logo BLU"
                            class="h-10 sm:h-12 transition-all duration-300 drop-shadow-sm">
                    </a>

                    <div class="hidden lg:flex items-center relative">
                        <input type="text" id="search-input-desktop" placeholder="Cari..."
                            class="pl-4 pr-10 py-2 rounded-full border border-white/30 bg-white/10 backdrop-blur-sm text-white placeholder-blue-100 text-sm focus:outline-none focus:ring-2 focus:ring-amber-200/50 focus:bg-white/20">
                        <button id="search-button-desktop" aria-label="Cari di website"
                            class="absolute right-0 p-2.5 rounded-full text-white hover:text-amber-200 hover:bg-white/10 transition-colors focus:outline-none focus:ring-2 focus:ring-amber-200/30">
                            <i class="fas fa-search"></i>
                        </button>
                        <div id="search-results-desktop"
                            class="absolute top-full right-0 mt-2 w-full lg:w-96 bg-white/95 backdrop-blur-sm rounded-xl shadow-lg border border-white/30 hidden z-50">
                            <div class="p-4 space-y-2"></div>
                        </div>
                    </div>

                    <!-- Mobile button -->
                    <button id="mobile-menu-button" aria-label="Buka menu"
                        class="lg:hidden relative inline-flex items-center justify-center p-2 rounded-lg text-white hover:bg-white/10 hover:text-amber-200 focus:outline-none focus:ring-2 focus:ring-amber-200/30 transition-colors">
                        <i id="mobile-menu-icon" class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="hidden lg:block relative bg-navbar-bottom-gradient backdrop-blur-md shadow-soft">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-2 left-20 w-1 h-1 bg-amber-200 rounded-full pulse-nav"></div>
                <div class="absolute top-1 right-1/4 w-8 h-0.5 bg-gradient-to-r from-transparent via-yellow-200 to-transparent drift-nav" style="animation-delay: -4s;"></div>
                <div class="absolute bottom-1 left-1/2 w-1.5 h-1.5 bg-amber-300 rotate-45 float-nav" style="animation-delay: -2s;"></div>
                <div class="absolute top-3 right-16 w-0.5 h-3 bg-gradient-to-b from-yellow-200 to-transparent slide-nav" style="animation-delay: -3s;"></div>
            </div>

            <div class="relative z-10 container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-14">
                    <div class="flex items-center space-x-6">
                        <a href="/" class="nav-link relative px-4 py-2 rounded-xl text-sm font-medium text-blue-50 hover:text-slate-800 transition-colors">Beranda
                            <div class="underline-effect absolute bottom-0 left-0 w-0 h-0.5 bg-amber-200 rounded-full transition-all duration-300"></div>
                        </a>
                        <div class="relative group">
                            <button
                                class="nav-link relative flex items-center px-4 py-2 rounded-xl text-sm font-medium text-blue-50 hover:text-slate-800 transition-colors">
                                Profil
                                <i class="fas fa-chevron-down ml-1 text-xs transition-transform group-hover:rotate-180"></i>
                                <div class="underline-effect absolute bottom-0 left-0 w-0 h-0.5 bg-amber-200 transition-all duration-300"></div>
                            </button>
                            <div
                                class="dropdown-menu absolute left-0 mt-2 w-56 rounded-2xl shadow-soft-xl bg-white/95 backdrop-blur-sm border border-white/30 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-2 z-50">
                                <div class="p-2">
                                    <a href="/profil/sejarah"
                                        class="dropdown-item flex items-center px-4 py-3 text-sm text-gray-700 hover:text-blue-700 hover:bg-amber-50 rounded-xl transition-colors">
                                        <i class="fas fa-scroll w-5 h-5 mr-3 text-amber-600"></i> Sejarah
                                    </a>
                                    <a href="/profil/visimisi"
                                        class="dropdown-item flex items-center px-4 py-3 text-sm text-gray-700 hover:text-blue-700 hover:bg-amber-50 rounded-xl transition-colors">
                                        <i class="fas fa-lightbulb w-5 h-5 mr-3 text-amber-600"></i> Visi & Misi
                                    </a>
                                    <a href="/profil/struktur"
                                        class="dropdown-item flex items-center px-4 py-3 text-sm text-gray-700 hover:text-blue-700 hover:bg-amber-50 rounded-xl transition-colors">
                                        <i class="fas fa-sitemap w-5 h-5 mr-3 text-amber-600"></i> Struktur Organisasi
                                    </a>
                                    <a href="/profil/piagam"
                                        class="dropdown-item flex items-center px-4 py-3 text-sm text-gray-700 hover:text-blue-700 hover:bg-amber-50 rounded-xl transition-colors">
                                        <i class="fas fa-certificate w-5 h-5 mr-3 text-amber-600"></i> Piagam Pengawasan Intern
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="relative group">
                            <button
                                class="nav-link relative flex items-center px-4 py-2 rounded-xl text-sm font-medium text-blue-50 hover:text-slate-800 transition-colors">
                                Peraturan
                                <i class="fas fa-chevron-down ml-1 text-xs transition-transform group-hover:rotate-180"></i>
                                <div class="underline-effect absolute bottom-0 left-0 w-0 h-0.5 bg-amber-200 transition-all duration-300"></div>
                            </button>
                            <div
                                class="dropdown-menu absolute left-0 mt-2 w-64 rounded-2xl shadow-soft-xl bg-white/95 backdrop-blur-sm border border-white/30 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-2 z-50">
                                <div class="p-2">
                                    <a href="/peraturan/akuntansi-keuangan"
                                        class="dropdown-item flex items-center px-4 py-3 text-sm text-gray-700 hover:text-blue-700 hover:bg-amber-50 rounded-xl transition-colors">
                                        <i class="fas fa-landmark w-5 h-5 mr-3 text-amber-600"></i> Akuntansi/Keuangan
                                    </a>
                                    <a href="/peraturan/hukum"
                                        class="dropdown-item flex items-center px-4 py-3 text-sm text-gray-700 hover:text-blue-700 hover:bg-amber-50 rounded-xl transition-colors">
                                        <i class="fas fa-gavel w-5 h-5 mr-3 text-amber-600"></i> Hukum
                                    </a>
                                    <a href="/peraturan/manajemen-sdm"
                                        class="dropdown-item flex items-center px-4 py-3 text-sm text-gray-700 hover:text-blue-700 hover:bg-amber-50 rounded-xl transition-colors">
                                        <i class="fas fa-users-cog w-5 h-5 mr-3 text-amber-600"></i> Manajemen SDM
                                    </a>
                                    <a href="/peraturan/manajemen-aset"
                                        class="dropdown-item flex items-center px-4 py-3 text-sm text-gray-700 hover:text-blue-700 hover:bg-amber-50 rounded-xl transition-colors">
                                        <i class="fas fa-building w-5 h-5 mr-3 text-amber-600"></i> Manajemen Aset
                                    </a>
                                    <a href="/peraturan/ketatalaksanaan"
                                        class="dropdown-item flex items-center px-4 py-3 text-sm text-gray-700 hover:text-blue-700 hover:bg-amber-50 rounded-xl transition-colors">
                                        <i class="fas fa-file-alt w-5 h-5 mr-3 text-amber-600"></i> Ketatalaksanaan
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a href="/kegiatan" class="nav-link relative px-4 py-2 rounded-xl text-sm font-medium text-blue-50 hover:text-slate-800 transition-colors">Kegiatan
                            <div class="underline-effect absolute bottom-0 left-0 w-0 h-0.5 bg-amber-200 rounded-full transition-all duration-300"></div>
                        </a>
                        <a href="/artikel" class="nav-link relative px-4 py-2 rounded-xl text-sm font-medium text-blue-50 hover:text-slate-800 transition-colors">Artikel
                            <div class="underline-effect absolute bottom-0 left-0 w-0 h-0.5 bg-amber-200 rounded-full transition-all duration-300"></div>
                        </a>
                        <a href="/laporan/create" class="nav-link relative px-4 py-2 rounded-xl text-sm font-medium text-blue-50 hover:text-slate-800 transition-colors">Lapor SPI
                            <div class="underline-effect absolute bottom-0 left-0 w-0 h-0.5 bg-amber-200 rounded-full transition-all duration-300"></div>
                        </a>
                    </div>
                    <a href="/login"
                        class="bg-gradient-to-r from-amber-400 to-orange-400 hover:from-amber-500 hover:to-orange-500 text-white border-0 px-6 py-2 rounded-full text-sm font-semibold shadow-lg flex items-center transition-all transform hover:scale-105">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </a>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu"
            class="lg:hidden absolute top-full left-0 w-full bg-mobile-gradient backdrop-blur-md shadow-lg border-t border-white/20 max-h-0 overflow-hidden transition-all duration-300">
            <div class="p-4 space-y-3">
                <div class="relative w-full">
                    <input type="text" id="search-input-mobile" placeholder="Cari..."
                        class="w-full pl-4 pr-10 py-2 rounded-full border border-white/30 bg-white/10 backdrop-blur-sm text-white placeholder-blue-100 text-sm focus:outline-none focus:ring-2 focus:ring-amber-200/30 focus:bg-white/20">
                    <button id="search-button-mobile" aria-label="Cari"
                        class="absolute right-0 p-2.5 rounded-full text-white hover:text-amber-200">
                        <i class="fas fa-search"></i>
                    </button>
                    <div id="search-results-mobile"
                        class="absolute top-full right-0 mt-2 w-full bg-white/95 backdrop-blur-sm rounded-xl shadow-lg border border-gray-200 hidden z-50">
                        <div class="p-4 space-y-2"></div>
                    </div>
                </div>

                <a href="/"
                    class="block px-3 py-2 rounded-md text-base text-white hover:text-amber-200 hover:bg-white/10 transition-colors">Beranda</a>
                <button id="mobile-profil-button"
                    class="w-full flex justify-between items-center px-3 py-2 text-base text-white hover:text-amber-200 hover:bg-white/10 rounded-md transition-colors">
                    Profil <i id="mobile-profil-icon" class="fas fa-chevron-down text-sm transition-transform"></i>
                </button>
                <div id="mobile-profil-menu" class="pl-4 py-2 space-y-1 border-l-2 border-amber-400 overflow-hidden transition-all">
                    <a href="/profil/sejarah"
                        class="block px-3 py-2 text-sm text-blue-100 hover:text-slate-800 hover:bg-white/10 rounded transition-colors">Sejarah</a>
                    <a href="/profil/visimisi"
                        class="block px-3 py-2 text-sm text-blue-100 hover:text-slate-800 hover:bg-white/10 rounded transition-colors">Visi & Misi</a>
                    <a href="/profil/struktur"
                        class="block px-3 py-2 text-sm text-blue-100 hover:text-slate-800 hover:bg-white/10 rounded transition-colors">Struktur Organisasi</a>
                    <a href="/profil/piagam"
                        class="block px-3 py-2 text-sm text-blue-100 hover:text-slate-800 hover:bg-white/10 rounded transition-colors">Piagam Pengawasan Intern</a>
                </div>

                <button id="mobile-peraturan-button"
                    class="w-full flex justify-between items-center px-3 py-2 text-base text-white hover:text-amber-200 hover:bg-white/10 rounded-md transition-colors">
                    Peraturan <i id="mobile-peraturan-icon" class="fas fa-chevron-down text-sm transition-transform"></i>
                </button>
                <div id="mobile-peraturan-menu" class="pl-4 py-2 space-y-1 border-l-2 border-amber-400 overflow-hidden transition-all">
                    <a href="/peraturan/akuntansi-keuangan"
                        class="block px-3 py-2 text-sm text-blue-100 hover:text-slate-800 hover:bg-white/10 rounded transition-colors">Akuntansi/Keuangan</a>
                    <a href="/peraturan/hukum"
                        class="block px-3 py-2 text-sm text-blue-100 hover:text-slate-800 hover:bg-white/10 rounded transition-colors">Hukum</a>
                    <a href="/peraturan/manajemen-sdm"
                        class="block px-3 py-2 text-sm text-blue-100 hover:text-slate-800 hover:bg-white/10 rounded transition-colors">Manajemen SDM</a>
                    <a href="/peraturan/manajemen-aset"
                        class="block px-3 py-2 text-sm text-blue-100 hover:text-slate-800 hover:bg-white/10 rounded transition-colors">Manajemen Aset</a>
                    <a href="/peraturan/ketatalaksanaan"
                        class="block px-3 py-2 text-sm text-blue-100 hover:text-slate-800 hover:bg-white/10 rounded transition-colors">Ketatalaksanaan</a>
                </div>

                <a href="/kegiatan"
                    class="block px-3 py-2 rounded-md text-base text-white hover:text-amber-200 hover:bg-white/10 transition-colors">Kegiatan</a>
                <a href="/artikel"
                    class="block px-3 py-2 rounded-md text-base text-white hover:text-amber-200 hover:bg-white/10 transition-colors">Artikel</a>
                <a href="/laporan/create"
                    class="block px-3 py-2 rounded-md text-base text-white hover:text-amber-200 hover:bg-white/10 transition-colors">Lapor SPI</a>

                <a href="/login"
                    class="mt-4 flex items-center justify-center bg-gradient-to-r from-amber-400 to-orange-400 hover:from-amber-500 hover:to-orange-500 text-white border-0 px-4 py-2.5 rounded-full text-base font-semibold shadow-lg transition-colors">
                    <i class="fas fa-sign-in-alt mr-2"></i> Login
                </a>
            </div>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenuIcon = document.getElementById('mobile-menu-icon');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileProfilButton = document.getElementById('mobile-profil-button');
            const mobileProfilMenu = document.getElementById('mobile-profil-menu');
            const mobileProfilIcon = document.getElementById('mobile-profil-icon');
            const mobilePeraturanButton = document.getElementById('mobile-peraturan-button');
            const mobilePeraturanMenu = document.getElementById('mobile-peraturan-menu');
            const mobilePeraturanIcon = document.getElementById('mobile-peraturan-icon');

            const staticSearchData = [{
                    title: 'Beranda',
                    url: '/'
                },
                {
                    title: 'Sejarah',
                    url: '/profil/sejarah'
                },
                {
                    title: 'Visi & Misi',
                    url: '/profil/visimisi'
                },
                {
                    title: 'Struktur Organisasi',
                    url: '/profil/struktur'
                },
                {
                    title: 'Kegiatan',
                    url: '/kegiatan'
                },
                {
                    title: 'Artikel',
                    url: '/artikel'
                },
                {
                    title: 'Lapor SPI',
                    url: '/laporan/create'
                },
                {
                    title: 'Peraturan Akuntansi/Keuangan',
                    url: '/peraturan/akuntansi-keuangan'
                },
                {
                    title: 'Peraturan Hukum',
                    url: '/peraturan/hukum'
                },
                {
                    title: 'Peraturan Manajemen SDM',
                    url: '/peraturan/manajemen-sdm'
                },
                {
                    title: 'Peraturan Manajemen Aset',
                    url: '/peraturan/manajemen-aset'
                },
                {
                    title: 'Peraturan Ketatalaksanaan',
                    url: '/peraturan/ketatalaksanaan'
                }
            ];

            function debounce(func, wait) {
                let timeout;
                return function(...args) {
                    const context = this;
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(context, args), wait);
                };
            }

            async function fetchDynamicSearch(query) {
                if (query.length < 3) {
                    return [];
                }
                try {
                    const response = await fetch(`/search?q=${encodeURIComponent(query)}`);
                    if (!response.ok) {
                        console.error('Search request failed');
                        return [];
                    }
                    return await response.json();
                } catch (error) {
                    console.error('Error fetching search results:', error);
                    return [];
                }
            }

            function setupSearch(input, resultsContainer) {
                const handleSearch = debounce(async (e) => {
                    const query = e.target.value.toLowerCase();
                    const box = resultsContainer.querySelector('div');

                    if (query.length === 0) {
                        resultsContainer.classList.add('hidden');
                        box.innerHTML = '';
                        return;
                    }

                    // Filter static data first
                    const staticResults = staticSearchData.filter(item => item.title.toLowerCase().includes(query));

                    // Fetch dynamic data
                    const dynamicResults = await fetchDynamicSearch(query);

                    let resultsHtml = '';

                    if (staticResults.length > 0) {
                        resultsHtml += '<h3 class="px-3 pt-2 text-xs font-semibold text-gray-500">Halaman</h3>';
                        resultsHtml += staticResults.map(r => `<a href="${r.url}" class="block p-3 rounded-lg text-sm text-gray-700 hover:bg-amber-50 hover:text-blue-700 transition-colors">${r.title}</a>`).join('');
                    }

                    if (dynamicResults.length > 0) {
                        resultsHtml += '<h3 class="px-3 pt-2 text-xs font-semibold text-gray-500">Artikel & Kegiatan</h3>';
                        resultsHtml += dynamicResults.map(r => `<a href="${r.url}" class="block p-3 rounded-lg text-sm text-gray-700 hover:bg-amber-50 hover:text-blue-700 transition-colors"><div class="font-semibold">${r.title}</div><div class="text-xs text-gray-500">${r.type}</div></a>`).join('');
                    }

                    if (resultsHtml) {
                        box.innerHTML = resultsHtml;
                        resultsContainer.classList.remove('hidden');
                    } else {
                        box.innerHTML = `<p class="p-3 text-sm text-gray-500">Tidak ada hasil ditemukan.</p>`;
                        resultsContainer.classList.remove('hidden');
                    }

                }, 300);

                input.addEventListener('input', handleSearch);
            }

            // Desktop search
            const searchBtnDesktop = document.getElementById('search-button-desktop');
            const searchInputDesktop = document.getElementById('search-input-desktop');
            const searchResultsDesktop = document.getElementById('search-results-desktop');
            if (searchBtnDesktop) {
                searchBtnDesktop.addEventListener('click', () => {
                    searchInputDesktop.classList.toggle('is-expanded');
                    if (searchInputDesktop.classList.contains('is-expanded')) {
                        searchInputDesktop.focus();
                    }
                });
                setupSearch(searchInputDesktop, searchResultsDesktop);
            }

            // Mobile search
            const searchInputMobile = document.getElementById('search-input-mobile');
            const searchResultsMobile = document.getElementById('search-results-mobile');
            setupSearch(searchInputMobile, searchResultsMobile);

            // Mobile menu toggle
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('is-open');

                // Toggle ikon FA
                if (mobileMenu.classList.contains('is-open')) {
                    mobileMenuIcon.classList.remove('fa-bars');
                    mobileMenuIcon.classList.add('fa-times');
                } else {
                    mobileMenuIcon.classList.remove('fa-times');
                    mobileMenuIcon.classList.add('fa-bars');
                }
            });

            // Mobile profile toggle
            mobileProfilButton.addEventListener('click', e => {
                e.preventDefault();
                mobileProfilMenu.classList.toggle('is-open');
                mobileProfilIcon.style.transform = mobileProfilMenu.classList.contains('is-open') ?
                    'rotate(180deg)' : 'rotate(0)';
            });

            // Mobile peraturan toggle
            mobilePeraturanButton.addEventListener('click', e => {
                e.preventDefault();
                mobilePeraturanMenu.classList.toggle('is-open');
                mobilePeraturanIcon.style.transform = mobilePeraturanMenu.classList.contains('is-open') ?
                    'rotate(180deg)' : 'rotate(0)';
            });

            // Active link
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-link, .dropdown-item, #mobile-menu a').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', (e) => {
                // Close mobile menu
                if (!mobileMenuButton.contains(e.target) && !mobileMenu.contains(e.target)) {
                    mobileMenu.classList.remove('is-open');
                    mobileMenuIcon.classList.remove('fa-times');
                    mobileMenuIcon.classList.add('fa-bars');
                }

                // Close search results
                const searchDesktopContainer = document.querySelector('.hidden.lg\\:flex.items-center.relative');
                if (searchDesktopContainer && !searchDesktopContainer.contains(e.target)) {
                    searchResultsDesktop.classList.add('hidden');
                }
                const searchMobileContainer = document.querySelector('.relative.w-full');
                if (searchMobileContainer && !searchMobileContainer.contains(e.target)) {
                    searchResultsMobile.classList.add('hidden');
                }
            });
        });
    </script>
</body>

</html>