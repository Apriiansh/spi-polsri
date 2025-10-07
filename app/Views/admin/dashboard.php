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
                <i class="fas fa-users text-blue-600 text-2xl"></i>
            </div>
        </div>

        <!-- Laporan -->
        <div class="bg-white rounded-xl p-6 shadow-sm border flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Laporan</p>
                <p class="text-2xl font-bold text-gray-900"><?= $totalReports ?? 0 ?></p>
            </div>
            <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-file-alt text-red-600 text-2xl"></i>
            </div>
        </div>

        <!-- Artikel -->
        <div class="bg-white rounded-xl p-6 shadow-sm border flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Artikel</p>
                <p class="text-2xl font-bold text-gray-900"><?= $totalArticles ?? 0 ?></p>
            </div>
            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-newspaper text-purple-600 text-2xl"></i>
            </div>
        </div>

        <!-- Kegiatan -->
        <div class="bg-white rounded-xl p-6 shadow-sm border flex items-center justify-between">
            <div>
                <p class="text-sm font-medium text-gray-600">Kegiatan</p>
                <p class="text-2xl font-bold text-gray-900"><?= $totalEvents ?? 0 ?></p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                <i class="fas fa-calendar-alt text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Chart Aktivitas -->
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Statistik Aktivitas (6 Bulan Terakhir)</h3>
            <div class="overflow-x-auto">
                <div class="min-w-[300px] h-80">
                    <canvas id="statsChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Chart Status Laporan -->
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Distribusi Status Laporan</h3>
            <div class="overflow-x-auto">
                <div class="min-w-[300px] h-80 flex items-center justify-center">
                    <canvas id="reportStatusChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Chart Aktivitas
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

        // Chart Status Laporan
        const reportCtx = document.getElementById('reportStatusChart').getContext('2d');
        new Chart(reportCtx, {
            type: 'pie',
            data: {
                labels: <?= json_encode($reportStatusLabels ?? []) ?>,
                datasets: [{
                    label: 'Status Laporan',
                    data: <?= json_encode($reportStatusCounts ?? []) ?>,
                    backgroundColor: <?= json_encode($reportStatusColors ?? []) ?>,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                }
            }
        });
    });
</script>

<?= $this->endSection() ?>