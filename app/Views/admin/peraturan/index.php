<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content') ?>
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Manajemen Peraturan</h1>
        <p class="text-gray-600 mt-1">Verifikasi dan kelola peraturan yang dikirim oleh pengguna.</p>
    </div>
</div>

<!-- Flash Messages -->
<?php if (session()->getFlashdata('success')) : ?>
    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 shadow-sm" role="alert">
        <p><?= session()->getFlashdata('success') ?></p>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('error')) : ?>
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 shadow-sm" role="alert">
        <p><?= session()->getFlashdata('error') ?></p>
    </div>
<?php endif; ?>

<!-- Main Content -->
<div class="bg-white shadow-lg rounded-xl overflow-hidden">
    <!-- Card Header -->
    <div class="px-4 py-5 sm:px-6 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Daftar Peraturan</h2>
                <p class="text-sm text-gray-500">Total: <?= $pager->getTotal('peraturan') ?> peraturan</p>
            </div>
            <form action="<?= base_url('admin/peraturan') ?>" method="get" class="flex flex-col sm:flex-row sm:items-center sm:space-x-2 space-y-2 sm:space-y-0 w-full sm:w-auto">
                <input type="text" name="search" value="<?= esc($search ?? '') ?>" placeholder="Cari judul/user..." class="text-sm px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full sm:w-auto">
                <select name="status" class="text-sm px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full sm:w-auto">
                    <option value="">Semua Status</option>
                    <option value="pending" <?= ($status_filter ?? '') == 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="published" <?= ($status_filter ?? '') == 'published' ? 'selected' : '' ?>>Published</option>
                    <option value="rejected" <?= ($status_filter ?? '') == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                </select>
                <div class="flex items-center space-x-2">
                    <button type="submit" class="w-full sm:w-auto bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 text-sm">Filter</button>
                    <a href="<?= base_url('admin/peraturan') ?>" class="w-full sm:w-auto text-center bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 text-sm">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengirim</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if (empty($peraturan)) : ?>
                    <tr>
                        <td colspan="7" class="px-6 py-10 text-center text-gray-500">Tidak ada data peraturan.</td>
                    </tr>
                <?php else : ?>
                    <?php $i = 1 + (10 * ($pager->getCurrentPage('peraturan') - 1)); ?>
                    <?php foreach ($peraturan as $item) : ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-500"><?= $i++; ?></td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900 max-w-xs truncate" title="<?= esc($item['judul']) ?>">
                                    <?= esc($item['judul']) ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500"><?= esc($item['username']) ?></td>
                            <td class="px-6 py-4 text-sm text-gray-500"><?= esc($item['kategori']) ?></td>
                            <td class="px-6 py-4 text-sm text-gray-500"><?= date('d M Y', strtotime($item['created_at'])) ?></td>
                            <td class="px-6 py-4">
                                <form action="<?= base_url('admin/peraturan/update-status/' . $item['id']) ?>" method="post">
                                    <?= csrf_field() ?>
                                    <?php
                                    $statusClass = '';
                                    switch ($item['status']) {
                                        case 'pending': $statusClass = 'bg-yellow-100 text-yellow-800 border-yellow-300 focus:ring-yellow-200'; break;
                                        case 'published': $statusClass = 'bg-green-100 text-green-800 border-green-300 focus:ring-green-200'; break;
                                        case 'rejected': $statusClass = 'bg-red-100 text-red-800 border-red-300 focus:ring-red-200'; break;
                                    }
                                    ?>
                                    <select name="status" onchange="this.form.submit()" class="text-xs font-medium border rounded-full px-2.5 py-1 w-full <?= $statusClass ?> focus:outline-none focus:ring-2">
                                        <option value="pending" <?= $item['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="published" <?= $item['status'] == 'published' ? 'selected' : '' ?>>Published</option>
                                        <option value="rejected" <?= $item['status'] == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <a href="<?= base_url('admin/peraturan/show/' . $item['id']) ?>" class="text-blue-600 hover:text-blue-800" title="Lihat Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?= base_url('admin/peraturan/download/' . $item['id']) ?>" class="text-green-600 hover:text-green-800" title="Download File">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php if ($pager->getPageCount('peraturan') > 1) : ?>
        <div class="p-4 border-t border-gray-200">
            <?= $pager->links('peraturan', 'tailwind_full') ?>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>