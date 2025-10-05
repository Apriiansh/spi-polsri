<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content'); ?>
<!-- Header dengan Tombol Tambah Artikel -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Manajemen Artikel</h1>
        <p class="text-gray-600 mt-1">Kelola artikel dan status verifikasinya</p>
    </div>
</div>

<!-- Alert untuk pesan sukses atau error -->
<?php if (session()->getFlashdata('success')): ?>
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 shadow-sm" role="alert">
        <div class="flex items-center">
            <i class="fas fa-check-circle mr-2"></i>
            <div>
                <p class="font-bold">Sukses!</p>
                <p><?= session()->getFlashdata('success'); ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('errors')): ?>
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 shadow-sm" role="alert">
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            <div>
                <p class="font-bold">Error!</p>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Container utama dengan card -->
<div class="bg-white shadow-lg rounded-xl overflow-hidden">
    <!-- Header Card -->
    <div class="px-4 py-5 sm:px-6 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Daftar Artikel</h2>
                <p class="text-sm text-gray-500">Total: <?= count($articles) ?> artikel</p>
            </div>
            <!-- Search atau filter bisa ditambahkan di sini -->
            <div class="flex items-center space-x-2">
                <div class="text-sm text-gray-500">
                    <i class="fas fa-filter mr-1"></i>
                    Filter by status
                </div>
                <!-- Dropdown filter placeholder -->
                <select class="text-sm px-3 py-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Semua</option>
                    <option value="pending">Pending</option>
                    <option value="verified">Terverifikasi</option>
                    <option value="rejected">Ditolak</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Tabel Desktop -->
    <div class="hidden lg:block">
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penulis</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($articles)): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Tidak ada artikel yang tersedia.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($articles as $article): ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    #<?= esc($article['id']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 max-w-[200px] truncate" title="<?= esc($article['title']) ?>">
                                        <?= esc($article['title']) ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= esc($article['username']) ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?= esc(date('d M Y', strtotime($article['created_at']))) ?>
                                    <div class="text-xs text-gray-400">
                                        <?= esc(date('H:i', strtotime($article['created_at']))) ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php
                                    $statusClass = '';
                                    $statusIcon = '';
                                    switch ($article['status']) {
                                        case 'pending':
                                            $statusClass = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                                            $statusIcon = 'fas fa-clock';
                                            break;
                                        case 'verified':
                                            $statusClass = 'bg-green-100 text-green-800 border-green-200';
                                            $statusIcon = 'fas fa-check-circle';
                                            break;
                                        case 'rejected':
                                            $statusClass = 'bg-red-100 text-red-800 border-red-200';
                                            $statusIcon = 'fas fa-times-circle';
                                            break;
                                    }
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?= $statusClass ?>">
                                        <i class="<?= $statusIcon ?> mr-1"></i>
                                        <?= esc(ucfirst($article['status'])) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-2">
                                        <form action="<?= base_url('admin/artikel/update-status/' . $article['id']) ?>" method="post" class="inline-flex">
                                            <?= csrf_field(); ?>
                                            <select name="status" onchange="this.form.submit()" class="text-sm px-3 py-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200">
                                                <option value="pending" <?= ($article['status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
                                                <option value="verified" <?= ($article['status'] == 'verified') ? 'selected' : '' ?>>Terverifikasi</option>
                                                <option value="rejected" <?= ($article['status'] == 'rejected') ? 'selected' : '' ?>>Ditolak</option>
                                            </select>
                                        </form>
                                        <a href="<?= base_url('admin/artikel/show/' . $article['id']); ?>" class="text-blue-600 hover:text-blue-800 p-1 rounded transition-colors duration-200" title="Lihat artikel">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= base_url('admin/artikel/delete/' . $article['id']); ?>" class="text-red-600 hover:text-red-800 p-1 rounded transition-colors duration-200" title="Hapus artikel" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tampilan Card untuk Tablet & Mobile -->
    <div class="lg:hidden">
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <?php if (empty($articles)): ?>
                    <div class="text-center py-4 text-gray-500 col-span-1 md:col-span-2">
                        Tidak ada artikel yang tersedia.
                    </div>
                <?php else: ?>
                    <?php foreach ($articles as $article): ?>
                        <div class="border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                            <!-- Header Card -->
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-base font-semibold text-gray-900 leading-tight">
                                        <?= esc($article['title']) ?>
                                    </h3>
                                    <p class="text-xs text-gray-500 mt-1">ID: #<?= esc($article['id']) ?></p>
                                </div>
                                <div class="flex-shrink-0 ml-4">
                                    <?php
                                    $statusClass = '';
                                    $statusIcon = '';
                                    switch ($article['status']) {
                                        case 'pending':
                                            $statusClass = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                                            $statusIcon = 'fas fa-clock';
                                            break;
                                        case 'verified':
                                            $statusClass = 'bg-green-100 text-green-800 border-green-200';
                                            $statusIcon = 'fas fa-check-circle';
                                            break;
                                        case 'rejected':
                                            $statusClass = 'bg-red-100 text-red-800 border-red-200';
                                            $statusIcon = 'fas fa-times-circle';
                                            break;
                                    }
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?= $statusClass ?>">
                                        <i class="<?= $statusIcon ?> mr-1"></i>
                                        <?= esc(ucfirst($article['status'])) ?>
                                    </span>
                                </div>
                            </div>

                            <!-- Info Details -->
                            <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm text-gray-600 mb-4">
                                <div>
                                    <span class="font-medium">Penulis:</span> <?= esc($article['username']) ?>
                                </div>
                                <div>
                                    <span class="font-medium">Tanggal:</span> <?= esc(date('d M Y H:i', strtotime($article['created_at']))) ?>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="space-y-3">
                                <!-- Status Update Form -->
                                <form action="<?= base_url('admin/artikel/update-status/' . $article['id']) ?>" method="post" class="w-full">
                                    <?= csrf_field(); ?>
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Update Status:</label>
                                    <select name="status" onchange="this.form.submit()" class="w-full text-sm px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <option value="pending" <?= ($article['status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
                                        <option value="verified" <?= ($article['status'] == 'verified') ? 'selected' : '' ?>>Terverifikasi</option>
                                        <option value="rejected" <?= ($article['status'] == 'rejected') ? 'selected' : '' ?>>Ditolak</option>
                                    </select>
                                </form>

                                <!-- Action Buttons -->
                                <div class="flex flex-wrap gap-2">
                                    <a href="<?= base_url('admin/artikel/show/' . $article['id']); ?>" class="flex items-center justify-center px-3 py-2 text-blue-600 border border-blue-600 rounded-md hover:bg-blue-600 hover:text-white transition-colors duration-200 text-sm">
                                        <i class="fas fa-eye mr-1"></i> Lihat
                                    </a>
                                    <a href="<?= base_url('admin/artikel/delete/' . $article['id']); ?>" class="flex items-center justify-center px-3 py-2 text-red-600 border border-red-600 rounded-md hover:bg-red-600 hover:text-white transition-colors duration-200 text-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Empty State -->
    <?php if (empty($articles)): ?>
        <div class="text-center py-12">
            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-newspaper text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada artikel</h3>
        </div>
    <?php endif; ?>


</div>

<div class="flex justify-center my-8">
    <nav class="flex items-center space-x-1.5 md:space-x-3 bg-white rounded-lg shadow-lg p-2 md:p-4 border border-gray-300" aria-label="Pagination">
        <?= $pager->links('default', 'tailwind_full') ?>
    </nav>
</div>

<?= $this->endSection(); ?>