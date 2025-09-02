<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'User Panel' ?></title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1',
                        'primary-dark': '#4f46e5',
                        sidebar: '#1e293b',
                        'sidebar-hover': '#334155'
                    }
                }
            }
        }
    </script>
    <style>
        .smooth-transition {
            transition: all 0.3s ease;
        }

        .glass-effect {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        @media (min-width: 768px) {
            .main-content {
                margin-left: 16rem;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 to-indigo-50 min-h-screen">
    <!-- Mobile Header/Navbar -->
    <div class="md:hidden bg-white shadow-lg flex items-center justify-between px-4 py-3 fixed top-0 left-0 right-0 z-50">
        <button id="menu-btn" class="text-gray-700 text-xl p-2 hover:bg-gray-100 rounded-lg transition-colors">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="font-bold text-lg text-gray-800"><?= $title ?? 'User Panel' ?></h1>
        <div class="w-8 h-8 bg-primary rounded-full flex items-center justify-center">
            <i class="fas fa-user text-white text-sm"></i>
        </div>
    </div>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-sidebar text-white shadow-2xl z-40 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
            <div class="flex flex-col h-full">
                <!-- Sidebar Header -->
                <div class="p-6 border-b border-slate-700/50">
                    <h2 class="text-xl font-bold">User Panel</h2>
                    <p class="text-slate-400 text-sm">Content Creator</p>
                </div>

                <!-- User Info -->
                <div class="p-4">
                    <div class="bg-gradient-to-r from-indigo-600/20 to-purple-600/20 rounded-2xl p-4 border border-indigo-500/20">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-400 to-purple-500 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-sm">
                                    <?= strtoupper(substr(session()->get('username') ?? 'U', 0, 1)) ?>
                                </span>
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-white text-sm">
                                    <?= session()->get('username') ?? 'User' ?>
                                </p>
                            </div>
                            <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                    <a href="/user/dashboard" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-sidebar-hover smooth-transition">
                        <i class="fa-solid fa-house text-slate-400"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="/user/artikel" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-sidebar-hover smooth-transition">
                        <i class="fa-regular fa-file-lines text-slate-400"></i>
                        <span>Artikel</span>
                    </a>
                    <a href="/user/kegiatan" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-sidebar-hover smooth-transition">
                        <i class="fa-solid fa-pen-to-square text-slate-400"></i>
                        <span>Kegiatan</span>
                    </a>
                    <a href="/user/profile" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-sidebar-hover smooth-transition">
                        <i class="fa-solid fa-user text-slate-400"></i>
                        <span>Profil</span>
                    </a>

                    <!-- Logout -->
                    <div class="pt-4 mt-4 border-t border-slate-700/50">
                        <a href="/logout" class="flex items-center space-x-3 p-3 rounded-xl bg-red-600/20 hover:bg-red-600 text-red-400 hover:text-white border border-red-600/30 smooth-transition">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </nav>

                <!-- Sidebar Footer -->
                <div class="p-4 border-t border-slate-700/50 text-center text-slate-500 text-sm">
                    <p>&copy; 2025 User Panel</p>
                </div>
            </div>
        </aside>

        <!-- Overlay -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-30"></div>

        <!-- Main Content -->
        <main class="main-content flex-1 min-h-screen pt-16 md:pt-0">
            <div class="p-4 md:p-6 lg:p-8">
                <div class="glass-effect rounded-2xl shadow-xl border border-white/20 p-4 md:p-6 lg:p-8">
                    <?= $this->renderSection('content') ?>
                </div>
            </div>
        </main>
    </div>

    <script>
        const menuBtn = document.getElementById('menu-btn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        function toggleSidebar() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        menuBtn?.addEventListener('click', toggleSidebar);
        overlay?.addEventListener('click', toggleSidebar);

        // Tutup sidebar saat klik link di mobile
        document.querySelectorAll('a[href^="/user"]').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 768) {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                }
            });
        });

        // Auto hide overlay saat resize desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) {
                overlay.classList.add('hidden');
            }
        });
    </script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>