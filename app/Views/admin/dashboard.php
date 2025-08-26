<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-4 space-y-10">
    <!-- Header -->
    <div class="text-center space-y-2">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Dashboard Admin</h1>
        <p class="text-gray-600 text-base md:text-lg">Kelola sistem dengan mudah</p>
    </div>

    <!-- Kartu Statistik -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users -->
        <div class="bg-white rounded-xl p-6 shadow-sm border flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Total Users</p>
                <p class="text-2xl font-bold text-gray-900"><?= $totalUsers ?? 0 ?></p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                </svg>
            </div>
        </div>

        <!-- Laporan -->
        <div class="bg-white rounded-xl p-6 shadow-sm border flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Laporan</p>
                <p class="text-2xl font-bold text-gray-900"><?= $totalReports ?? 0 ?></p>
            </div>
            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
            </div>
        </div>

        <!-- Artikel -->
        <div class="bg-white rounded-xl p-6 shadow-sm border flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Artikel</p>
                <p class="text-2xl font-bold text-gray-900"><?= $totalArticles ?? 0 ?></p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
        </div>

        <!-- Kegiatan -->
        <div class="bg-white rounded-xl p-6 shadow-sm border flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Kegiatan</p>
                <p class="text-2xl font-bold text-gray-900"><?= $totalEvents ?? 0 ?></p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Chart -->
    <div class="bg-white rounded-xl shadow-sm border p-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik Aktivitas (6 Bulan Terakhir)</h3>
        <div class="overflow-x-auto">
            <div class="min-w-[300px] h-80">
                <canvas id="statsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Kelola Users -->
        <div class="bg-white rounded-xl shadow-sm border p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-semibold text-gray-900">Kelola Users</h4>
                    <p class="text-sm text-gray-600">Manajemen pengguna sistem</p>
                </div>
                <a href="<?= site_url('admin/users') ?>" class="inline-flex items-center px-3 py-2 rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Kelola Laporan -->
        <div class="bg-white rounded-xl shadow-sm border p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.082 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-semibold text-gray-900">Kelola Laporan</h4>
                    <p class="text-sm text-gray-600">Review dan tindak lanjut laporan</p>
                </div>
                <a href="<?= site_url('admin/laporan') ?>" class="inline-flex items-center px-3 py-2 rounded-md text-red-700 bg-red-100 hover:bg-red-200 text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>

        <!-- Kelola Artikel -->
        <div class="bg-white rounded-xl shadow-sm border p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="font-semibold text-gray-900">Kelola Artikel</h4>
                    <p class="text-sm text-gray-600">Manajemen konten artikel</p>
                </div>
                <a href="<?= site_url('admin/artikel') ?>" class="inline-flex items-center px-3 py-2 rounded-md text-purple-700 bg-purple-100 hover:bg-purple-200 text-sm font-medium">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('statsChart').getContext('2d');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= json_encode($chartLabels ?? ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun']) ?>,
                datasets: [{
                    label: 'Laporan Masuk',
                    data: <?= json_encode($chartReports ?? [0, 0, 0, 0, 0, 0]) ?>,
                    borderColor: '#EF4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    fill: true,
                    tension: 0.4
                }, {
                    label: 'Artikel Dibuat',
                    data: <?= json_encode($chartArticles ?? [0, 0, 0, 0, 0, 0]) ?>,
                    borderColor: '#8B5CF6',
                    backgroundColor: 'rgba(139, 92, 246, 0.1)',
                    fill: true,
                    tension: 0.4
                }, {
                    label: 'Kegiatan Dibuat',
                    data: <?= json_encode($chartEvents ?? [0, 0, 0, 0, 0, 0]) ?>,
                    borderColor: '#10B981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 16
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#f1f5f9'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                elements: {
                    point: {
                        radius: 4,
                        hoverRadius: 8
                    },
                    line: {
                        borderWidth: 2
                    }
                }
            }
        });
    });
</script>

<?= $this->endSection() ?>