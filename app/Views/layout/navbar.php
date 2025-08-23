<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar SPI POLSRI</title>
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
            background-color: #F3F4F6;
        }

        .bg-gradient-polsri {
            background: linear-gradient(50deg, rgb(96, 152, 182) 0%, rgb(46, 111, 146) 100%);
        }

        .bg-gradient-polsri-reverse {
            background: linear-gradient(320deg, rgb(96, 152, 182) 0%, rgb(46, 111, 146) 100%);
        }

        .shadow-soft {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .shadow-soft-xl {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Hover underline effect */
        .nav-link:hover .underline-effect {
            width: 100%;
        }

        /* Active link */
        .active {
            color:rgb(27, 63, 61) !important;
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
        #mobile-profil-menu {
            transition: max-height 0.3s ease-in-out;
            overflow: hidden;
            max-height: 0;
        }

        #mobile-profil-menu.is-open {
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
    </style>
</head>

<body>
    <nav class="sticky top-0 z-50 transition-all duration-300">
        <!-- Bagian Atas -->
        <div class="bg-gradient-polsri-reverse py-3 lg:py-4">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-10">
                    <!-- Logo -->
                    <a href="/" class="flex items-center space-x-3 group">
                        <img src="<?= base_url('images/spi.png') ?>" alt="Logo SPI POLSRI"
                            class="h-10 w-auto sm:h-12 transition-all duration-300 group-hover:scale-105 drop-shadow-sm">
                    </a>

                    <!-- Search desktop -->
                    <div class="hidden lg:flex items-center relative">
                        <input type="text" id="search-input-desktop" placeholder="Cari..."
                            class="pl-4 pr-10 py-2 rounded-full border border-gray-400 bg-gray-100 text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <button id="search-button-desktop" aria-label="Cari di website"
                            class="absolute right-0 p-2.5 rounded-full text-white hover:text-gray-200 transition-colors focus:outline-none focus:ring-2 focus:ring-gray-200">
                            <i class="fas fa-search"></i>
                        </button>
                        <div id="search-results-desktop"
                            class="absolute top-full right-0 mt-2 w-full lg:w-96 bg-white rounded-xl shadow-lg border border-gray-200 hidden z-50">
                            <div class="p-4 space-y-2"></div>
                        </div>
                    </div>

                    <!-- Mobile button pakai FontAwesome -->
                    <button id="mobile-menu-button" aria-label="Buka menu"
                        class="lg:hidden relative inline-flex items-center justify-center p-2 rounded-lg text-white hover:bg-gray-700/50 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <i id="mobile-menu-icon" class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Desktop Menu -->
        <div class="hidden lg:block bg-gradient-polsri backdrop-blur-md shadow-soft border-b border-gray-300">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-14">
                    <div class="flex items-center space-x-6">
                        <a href="/" class="nav-link relative px-4 py-2 rounded-xl text-sm font-medium text-white hover:text-[#e0f2f1]">Beranda
                            <div class="underline-effect absolute bottom-0 left-0 w-0 h-0.5 bg-white rounded-full transition-all"></div>
                        </a>
                        <!-- Dropdown Profil -->
                        <div class="relative group">
                            <button
                                class="nav-link relative flex items-center px-4 py-2 rounded-xl text-sm font-medium text-white hover:text-[#e0f2f1]">
                                Profil
                                <i class="fas fa-chevron-down ml-1 text-xs transition-transform group-hover:rotate-180"></i>
                                <div class="underline-effect absolute bottom-0 left-0 w-0 h-0.5 bg-white transition-all"></div>
                            </button>
                            <div
                                class="dropdown-menu absolute left-0 mt-2 w-56 rounded-2xl shadow-soft-xl bg-gray-200 border border-gray-300 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform group-hover:translate-y-0 translate-y-2 z-50">
                                <div class="p-2">
                                    <a href="/profil/sejarah"
                                        class="dropdown-item flex items-center px-4 py-3 text-sm text-gray-700 hover:text-[#537b91] hover:bg-gray-300 rounded-xl">
                                        <i class="fas fa-history w-5 h-5 mr-3"></i> Sejarah
                                    </a>
                                    <a href="/profil/struktur"
                                        class="dropdown-item flex items-center px-4 py-3 text-sm text-gray-700 hover:text-[#537b91] hover:bg-gray-300 rounded-xl">
                                        <i class="fas fa-sitemap w-5 h-5 mr-3"></i> Struktur
                                    </a>
                                    <a href="/profil/visimisi"
                                        class="dropdown-item flex items-center px-4 py-3 text-sm text-gray-700 hover:text-[#537b91] hover:bg-gray-300 rounded-xl">
                                        <i class="fas fa-eye w-5 h-5 mr-3"></i> Visi & Misi
                                    </a>
                                </div>
                            </div>
                        </div>
                        <a href="/kegiatan"
                            class="nav-link relative px-4 py-2 text-sm font-medium text-white hover:text-[#e0f2f1]">Kegiatan</a>
                        <a href="/laporan/create"
                            class="nav-link relative px-4 py-2 text-sm font-medium text-white hover:text-[#e0f2f1]">Pelaporan</a>
                    </div>
                    <a href="/login"
                        class="bg-white text-[#537b91] px-6 py-2 rounded-full text-sm font-semibold hover:bg-gray-100 shadow-lg flex items-center">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </a>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="lg:hidden bg-gray-200 border-t border-gray-300 p-4 z-40">
            <div class="relative w-full mb-4">
                <input type="text" id="search-input-mobile" placeholder="Cari..."
                    class="w-full pl-4 pr-10 py-2 rounded-full border border-gray-400 bg-gray-100 text-gray-800 text-sm">
                <button id="search-button-mobile" aria-label="Cari"
                    class="absolute right-0 p-2.5 rounded-full text-gray-500 hover:text-gray-700">
                    <i class="fas fa-search"></i>
                </button>
                <div id="search-results-mobile"
                    class="absolute top-full right-0 mt-2 w-full bg-white rounded-xl shadow-lg border border-gray-200 hidden z-50">
                    <div class="p-4 space-y-2"></div>
                </div>
            </div>

            <a href="/"
                class="block px-3 py-2 rounded-md text-base text-gray-700 hover:text-[#537b91] hover:bg-gray-300">Beranda</a>
            <button id="mobile-profil-button"
                class="w-full flex justify-between items-center px-3 py-2 text-base text-gray-700 hover:text-[#537b91] hover:bg-gray-300">
                Profil <i id="mobile-profil-icon" class="fas fa-chevron-down text-sm"></i>
            </button>
            <div id="mobile-profil-menu" class="pl-4 py-2 space-y-1 border-l-2 border-gray-300">
                <a href="/profil/sejarah"
                    class="block px-3 py-2 text-sm text-gray-600 hover:text-[#537b91] hover:bg-gray-300">Sejarah</a>
                <a href="/profil/struktur"
                    class="block px-3 py-2 text-sm text-gray-600 hover:text-[#537b91] hover:bg-gray-300">Struktur</a>
                <a href="/profil/visimisi"
                    class="block px-3 py-2 text-sm text-gray-600 hover:text-[#537b91] hover:bg-gray-300">Visi & Misi</a>
            </div>

            <a href="/kegiatan"
                class="block px-3 py-2 text-base text-gray-700 hover:text-[#537b91] hover:bg-gray-300">Kegiatan</a>
            <a href="/laporan/create"
                class="block px-3 py-2 text-base text-gray-700 hover:text-[#537b91] hover:bg-gray-300">Pelaporan</a>

            <a href="/login"
                class="mt-4 flex items-center justify-center bg-white text-[#537b91] px-4 py-2.5 rounded-full text-base font-semibold shadow-md">
                <i class="fas fa-sign-in-alt mr-2"></i> Login
            </a>
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

            const searchData = [{
                    title: 'Beranda',
                    url: '/'
                },
                {
                    title: 'Sejarah',
                    url: '/profil/sejarah'
                },
                {
                    title: 'Struktur Organisasi',
                    url: '/profil/struktur'
                },
                {
                    title: 'Visi & Misi',
                    url: '/profil/visimisi'
                },
                {
                    title: 'Kegiatan',
                    url: '/kegiatan'
                },
                {
                    title: 'Pelaporan',
                    url: '/laporan/create'
                }
            ];

            function setupSearch(input, resultsContainer) {
                input.addEventListener('input', e => {
                    const query = e.target.value.toLowerCase();
                    const results = searchData.filter(item => item.title.toLowerCase().includes(query));
                    const box = resultsContainer.querySelector('div');
                    box.innerHTML = results.length ?
                        results.map(r => `<a href="${r.url}" class="block p-3 rounded-lg text-sm text-gray-700 hover:bg-gray-300 hover:text-[#537b91]">${r.title}</a>`).join('') :
                        `<p class="p-3 text-sm text-gray-500">Tidak ada hasil ditemukan.</p>`;
                    resultsContainer.classList.toggle('hidden', query.length === 0);
                });
            }

            // Desktop search
            const searchBtnDesktop = document.getElementById('search-button-desktop');
            const searchInputDesktop = document.getElementById('search-input-desktop');
            const searchResultsDesktop = document.getElementById('search-results-desktop');
            if (searchBtnDesktop) {
                searchBtnDesktop.addEventListener('click', () => {
                    searchInputDesktop.classList.toggle('is-expanded');
                    searchInputDesktop.focus();
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
                    'rotate(180deg)' :
                    'rotate(0)';
            });

            // Active link
            const currentPath = window.location.pathname;
            document.querySelectorAll('.nav-link, .dropdown-item, #mobile-menu a').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>

</html>