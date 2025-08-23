<aside class="fixed left-0 top-0 w-64 h-screen bg-sidebar text-white shadow-2xl z-50">
    <div class="flex flex-col h-full">
        <!-- Header -->
        <div class="p-6 border-b border-slate-700/50">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-gradient-to-br from-primary to-blue-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.031 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold">Admin Panel</h2>
                    <p class="text-slate-400 text-sm">Dashboard</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 p-4 space-y-2">
            <div class="space-y-1">
                <a href="/admin/dashboard" class="nav-item group flex items-center space-x-3 p-3 rounded-xl smooth-transition hover:bg-sidebar-hover hover:translate-x-1">
                    <div class="w-5 h-5 text-slate-400 group-hover:text-white smooth-transition">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                        </svg>
                    </div>
                    <span class="font-medium group-hover:text-white text-slate-300 smooth-transition">Dashboard</span>
                </a>

                <a href="/admin/users" class="nav-item group flex items-center space-x-3 p-3 rounded-xl smooth-transition hover:bg-sidebar-hover hover:translate-x-1">
                    <div class="w-5 h-5 text-slate-400 group-hover:text-white smooth-transition">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                    </div>
                    <span class="font-medium group-hover:text-white text-slate-300 smooth-transition">Manajemen User</span>
                </a>

                <a href="/admin/artikel" class="nav-item group flex items-center space-x-3 p-3 rounded-xl smooth-transition hover:bg-sidebar-hover hover:translate-x-1">
                    <div class="w-5 h-5 text-slate-400 group-hover:text-white smooth-transition">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>
                    <span class="font-medium group-hover:text-white text-slate-300 smooth-transition">Artikel</span>
                </a>

                <a href="/admin/laporan" class="nav-item group flex items-center space-x-3 p-3 rounded-xl smooth-transition hover:bg-sidebar-hover hover:translate-x-1">
                    <div class="w-5 h-5 text-slate-400 group-hover:text-white smooth-transition">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <span class="font-medium group-hover:text-white text-slate-300 smooth-transition">Laporan</span>
                </a>

                <a href="/admin/kegiatan" class="nav-item group flex items-center space-x-3 p-3 rounded-xl smooth-transition hover:bg-sidebar-hover hover:translate-x-1">
                    <div class="w-5 h-5 text-slate-400 group-hover:text-white smooth-transition">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <span class="font-medium group-hover:text-white text-slate-300 smooth-transition">Kegiatan</span>
                </a>
            </div>

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
                <p>&copy; 2025 Admin Panel</p>
            </div>
        </div>
    </div>
</aside>