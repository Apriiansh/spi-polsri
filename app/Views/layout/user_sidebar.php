<aside class="fixed left-0 top-0 w-64 h-screen bg-gradient-to-b from-slate-800 to-slate-900 text-white shadow-2xl z-50">
    <div class="flex flex-col h-full">
        <!-- Header -->
        <div class="p-6 border-b border-slate-700/50">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold">User Panel</h2>
                    <p class="text-slate-400 text-sm">Content Creator</p>
                </div>
            </div>
        </div>

        <!-- User Info Card -->
        <div class="p-4">
            <div class="bg-gradient-to-r from-indigo-600/20 to-purple-600/20 backdrop-blur-sm rounded-2xl p-4 border border-indigo-500/20">
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
        <nav class="flex-1 p-4 space-y-2">
            <div class="space-y-1">
                <!-- Dashboard -->
                <a href="/user/dashboard" class="nav-item group flex items-center space-x-3 p-3 rounded-xl smooth-transition hover:bg-slate-700/50 hover:translate-x-1">
                    <div class="w-5 h-5 text-slate-400 group-hover:text-indigo-400 smooth-transition">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        </svg>
                    </div>
                    <span class="font-medium group-hover:text-white text-slate-300 smooth-transition">Dashboard</span>
                </a>

                <!-- Artikel Section -->
                <div class="pt-4">
                    <p class="text-slate-500 text-xs uppercase tracking-wider font-semibold px-3 mb-2">Konten</p>

                    <a href="/user/artikel" class="nav-item group flex items-center space-x-3 p-3 rounded-xl smooth-transition hover:bg-slate-700/50 hover:translate-x-1">
                        <div class="w-5 h-5 text-slate-400 group-hover:text-indigo-400 smooth-transition">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                            </svg>
                        </div>
                        <span class="font-medium group-hover:text-white text-slate-300 smooth-transition">Artikel Saya</span>
                    </a>

                    <a href="/user/artikel/create" class="nav-item group flex items-center space-x-3 p-3 rounded-xl smooth-transition hover:bg-slate-700/50 hover:translate-x-1">
                        <div class="w-5 h-5 text-slate-400 group-hover:text-green-400 smooth-transition">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <span class="font-medium group-hover:text-white text-slate-300 smooth-transition">Tulis Artikel</span>
                    </a>

                </div>

                <!-- Account Section -->
                <div class="pt-4">
                    <p class="text-slate-500 text-xs uppercase tracking-wider font-semibold px-3 mb-2">Akun</p>

                    <a href="/user/profile" class="nav-item group flex items-center space-x-3 p-3 rounded-xl smooth-transition hover:bg-slate-700/50 hover:translate-x-1">
                        <div class="w-5 h-5 text-slate-400 group-hover:text-indigo-400 smooth-transition">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <span class="font-medium group-hover:text-white text-slate-300 smooth-transition">Profil</span>
                    </a>
                </div>
            </div>

            <!-- Logout -->
            <div class="pt-4 mt-4 border-t border-slate-700/50">
                <a href="/logout" class="nav-item group flex items-center space-x-3 p-3 rounded-xl smooth-transition bg-red-600/20 hover:bg-red-600 text-red-400 hover:text-white border border-red-600/30">
                    <div class="w-5 h-5 smooth-transition">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                    </div>
                    <span class="font-medium smooth-transition">Logout</span>
                </a>
            </div>
        </nav>

        <!-- Footer -->
        <div class="p-4 border-t border-slate-700/50">
            <div class="text-center text-slate-500 text-sm">
                <p>&copy; 2025 User Panel</p>
                <p class="text-xs mt-1">Content Management</p>
            </div>
        </div>
    </div>
</aside>