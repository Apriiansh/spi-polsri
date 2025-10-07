<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel' ?></title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4f46e5',
                        'primary-dark': '#3730a3',
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

<body class="bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">
    <!-- Mobile Header -->
    <div class="md:hidden bg-white shadow-lg flex items-center justify-between px-4 py-3 fixed top-0 left-0 right-0 z-50">
        <button id="menu-btn" class="text-gray-700 text-xl p-2 hover:bg-gray-100 rounded-lg transition-colors">
            <i class="fas fa-bars"></i>
        </button>
        <h1 class="font-bold text-lg text-gray-800">Admin Panel</h1>
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
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary to-blue-600 rounded-xl flex items-center justify-center">
                            <i class="fas fa-shield-alt text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold">Admin Panel</h2>
                            <p class="text-slate-400 text-sm">Dashboard</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
                    <a href="<?= site_url('admin/dashboard') ?>" class="nav-item flex items-center space-x-3 p-3 rounded-xl hover:bg-sidebar-hover smooth-transition">
                        <i class="fas fa-home w-5"></i>
                        <span>Dashboard</span>
                    </a>
                    <a href="<?= site_url('admin/users') ?>" class="nav-item flex items-center space-x-3 p-3 rounded-xl hover:bg-sidebar-hover smooth-transition">
                        <i class="fas fa-users w-5"></i>
                        <span>Manajemen User</span>
                    </a>
                    <a href="<?= site_url('admin/kegiatan') ?>" class="nav-item flex items-center space-x-3 p-3 rounded-xl hover:bg-sidebar-hover smooth-transition">
                        <i class="fas fa-calendar-alt w-5"></i>
                        <span>Kegiatan</span>
                    </a>
                    <a href="<?= site_url('admin/artikel') ?>" class="nav-item flex items-center space-x-3 p-3 rounded-xl hover:bg-sidebar-hover smooth-transition">
                        <i class="fas fa-newspaper w-5"></i>
                        <span>Artikel</span>
                    </a>
                    <a href="<?= site_url('admin/peraturan') ?>" class="nav-item flex items-center space-x-3 p-3 rounded-xl hover:bg-sidebar-hover smooth-transition">
                        <i class="fas fa-gavel w-5"></i>
                        <span>Peraturan</span>
                    </a>
                    <a href="<?= site_url('admin/laporan') ?>" class="nav-item flex items-center space-x-3 p-3 rounded-xl hover:bg-sidebar-hover smooth-transition">
                        <i class="fas fa-chart-line w-5"></i>
                        <span>Laporan</span>
                    </a>

                    <!-- Logout -->
                    <div class="pt-4 mt-4 border-t border-slate-700/50">
                        <a href="<?= site_url('logout') ?>" class="flex items-center space-x-3 p-3 rounded-xl bg-red-600/20 hover:bg-red-600 text-red-400 hover:text-white border border-red-600/30 smooth-transition">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </nav>

                <!-- Footer -->
                <div class="p-4 border-t border-slate-700/50 text-center text-slate-500 text-sm">
                    <p>&copy; 2025 Admin Panel</p>
                </div>
            </div>
        </aside>

        <!-- Overlay -->
        <div id="overlay" class="fixed inset-0 bg-black bg-opacity-50 hidden z-30"></div>

        <!-- Main Content -->
        <main class="main-content flex-1 min-h-screen pt-16 md:pt-0">
            <div class="p-6">
                <div class="glass-effect rounded-2xl shadow-xl border border-white/20 p-6">
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

        window.addEventListener('resize', function() {
            if (window.innerWidth >= 768) overlay.classList.add('hidden');
        });
    </script>
    <?= $this->renderSection('scripts') ?>
</body>

</html>