<?= $this->extend('layout/user_main') ?>

<?= $this->section('content'); ?>
<!-- Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Manajemen Laporan</h1>
        <p class="text-gray-600 mt-1">Kelola laporan bidang <?= esc($user_bidang) ?> dan statusnya.</p>
    </div>
</div>

<!-- Alert untuk pesan sukses atau error -->
<?php if (session()->getFlashdata('success')) : ?>
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

<?php if (session()->getFlashdata('error')) : ?>
    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 shadow-sm" role="alert">
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            <div>
                <p class="font-bold">Error!</p>
                <p><?= session()->getFlashdata('error'); ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Container utama dengan card -->
<div class="bg-white shadow-lg rounded-xl overflow-hidden">
    <!-- Header Card dengan Filter -->
    <div class="px-4 py-5 sm:px-6 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Daftar Laporan - Bidang <?= esc($user_bidang) ?></h2>
                <p class="text-sm text-gray-500">Total: <?= $pager->getTotal() ?> laporan</p>
            </div>
            <form action="<?= base_url('user/laporan') ?>" method="get" class="flex flex-col sm:flex-row sm:items-center sm:space-x-2 space-y-2 sm:space-y-0 w-full sm:w-auto">
                <select name="status" class="text-sm px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full sm:w-auto">
                    <option value="">Semua Status</option>
                    <option value="pending" <?= (isset($filters['status']) && $filters['status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
                    <option value="in_progress" <?= (isset($filters['status']) && $filters['status'] == 'in_progress') ? 'selected' : '' ?>>In Progress</option>
                    <option value="completed" <?= (isset($filters['status']) && $filters['status'] == 'completed') ? 'selected' : '' ?>>Completed</option>
                    <option value="not_actionable" <?= (isset($filters['status']) && $filters['status'] == 'not_actionable') ? 'selected' : '' ?>>Not Actionable</option>
                </select>
                <select name="klasifikasi" class="text-sm px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full sm:w-auto">
                    <option value="">Semua Klasifikasi</option>
                    <?php if (!empty($klasifikasi_options)) : ?>
                        <?php foreach ($klasifikasi_options as $klasifikasi) : ?>
                            <?php if (!empty($klasifikasi)) : ?>
                                <option value="<?= esc($klasifikasi) ?>" <?= (isset($filters['klasifikasi']) && $filters['klasifikasi'] == $klasifikasi) ? 'selected' : '' ?>><?= esc(ucfirst($klasifikasi)) ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
                <div class="flex items-center space-x-2">
                    <button type="submit" class="w-full sm:w-auto bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 text-sm">Filter</button>
                    <a href="<?= base_url('user/laporan') ?>" class="w-full sm:w-auto text-center bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 text-sm">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Desktop -->
    <div class="hidden lg:block">
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email Pelapor</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Klasifikasi</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Kejadian</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if (empty($laporan)) : ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada laporan yang ditemukan untuk bidang <?= esc($user_bidang) ?>.</td>
                        </tr>
                    <?php else : ?>
                        <?php $i = 1 + (10 * ($pager->getCurrentPage() - 1)); ?>
                        <?php foreach ($laporan as $item) : ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= $i++; ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900 max-w-[250px] truncate" title="<?= esc($item['judul']) ?>">
                                        <?= esc($item['judul']) ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= esc($item['email_pelapor']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= esc($item['klasifikasi_laporan']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= esc(date('d M Y', strtotime($item['tgl_kejadian']))); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php
                                    $statusClass = '';
                                    $statusIcon = '';
                                    switch ($item['status_laporan']) {
                                        case 'pending':
                                            $statusClass = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                                            $statusIcon = 'fas fa-clock';
                                            break;
                                        case 'in_progress':
                                            $statusClass = 'bg-blue-100 text-blue-800 border-blue-200';
                                            $statusIcon = 'fas fa-sync-alt';
                                            break;
                                        case 'completed':
                                            $statusClass = 'bg-green-100 text-green-800 border-green-200';
                                            $statusIcon = 'fas fa-check-circle';
                                            break;
                                        case 'not_actionable':
                                            $statusClass = 'bg-gray-100 text-gray-800 border-gray-200';
                                            $statusIcon = 'fas fa-times-circle';
                                            break;
                                    }
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?= $statusClass ?>">
                                        <i class="<?= $statusIcon ?> mr-1"></i>
                                        <?= esc(ucfirst(str_replace('_', ' ', $item['status_laporan']))); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-3">
                                        <a href="<?= base_url('user/laporan/show/' . $item['id']); ?>" class="text-blue-600 hover:text-blue-800 p-1 rounded-full transition-colors duration-200" title="Lihat Laporan">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="<?= base_url('user/laporan/delete/' . $item['id']); ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');" class="inline">
                                            <?= csrf_field(); ?>
                                            <button type="submit" class="text-red-600 hover:text-red-800 p-1 rounded-full transition-colors duration-200" title="Hapus Laporan">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
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
                <?php if (empty($laporan)) : ?>
                    <div class="text-center py-4 text-gray-500 col-span-1 md:col-span-2">
                        Tidak ada laporan yang ditemukan untuk bidang <?= esc($user_bidang) ?>.
                    </div>
                <?php else : ?>
                    <?php $i = 1 + (10 * ($pager->getCurrentPage() - 1)); ?>
                    <?php foreach ($laporan as $item) : ?>
                        <div class="border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                            <div class="flex justify-between items-start mb-3">
                                <div class="flex-1 min-w-0">
                                    <h3 class="text-base font-semibold text-gray-900 leading-tight"><?= esc($item['judul']); ?></h3>
                                    <p class="text-xs text-gray-500 mt-1">No: #<?= $i++; ?></p>
                                </div>
                                <div class="flex-shrink-0 ml-4">
                                    <?php
                                    $statusClass = '';
                                    $statusIcon = '';
                                    switch ($item['status_laporan']) {
                                        case 'pending':
                                            $statusClass = 'bg-yellow-100 text-yellow-800 border-yellow-200';
                                            $statusIcon = 'fas fa-clock';
                                            break;
                                        case 'in_progress':
                                            $statusClass = 'bg-blue-100 text-blue-800 border-blue-200';
                                            $statusIcon = 'fas fa-sync-alt';
                                            break;
                                        case 'completed':
                                            $statusClass = 'bg-green-100 text-green-800 border-green-200';
                                            $statusIcon = 'fas fa-check-circle';
                                            break;
                                        case 'not_actionable':
                                            $statusClass = 'bg-gray-100 text-gray-800 border-gray-200';
                                            $statusIcon = 'fas fa-times-circle';
                                            break;
                                    }
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?= $statusClass ?>">
                                        <i class="<?= $statusIcon ?> mr-1"></i>
                                        <?= esc(ucfirst(str_replace('_', ' ', $item['status_laporan']))); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="space-y-1 text-sm text-gray-600 mb-4">
                                <p><span class="font-medium">Email Pelapor:</span> <?= esc($item['email_pelapor']); ?></p>
                                <p><span class="font-medium">Klasifikasi:</span> <?= esc($item['klasifikasi_laporan']); ?></p>
                                <p><span class="font-medium">Tanggal:</span> <?= esc(date('d M Y', strtotime($item['tgl_kejadian']))); ?></p>
                                <p><span class="font-medium">Lokasi:</span> <?= esc($item['lok_kejadian']); ?></p>
                                <p><span class="font-medium">Unit Kerja:</span> <?= esc($item['unit_kerja']); ?></p>
                            </div>

                            <div class="flex flex-wrap gap-2">
                                <a href="<?= base_url('user/laporan/show/' . $item['id']); ?>" class="flex items-center justify-center px-3 py-2 text-blue-600 border border-blue-600 rounded-md hover:bg-blue-600 hover:text-white transition-colors duration-200 text-sm">
                                    <i class="fas fa-eye mr-1"></i> Lihat
                                </a>
                                <form action="<?= base_url('user/laporan/delete/' . $item['id']); ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');" class="inline">
                                    <?= csrf_field(); ?>
                                    <button type="submit" class="flex items-center justify-center px-3 py-2 text-red-600 border border-red-600 rounded-md hover:bg-red-600 hover:text-white transition-colors duration-200 text-sm">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Empty State -->
    <?php if (empty($laporan)) : ?>
        <div class="text-center py-12">
            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-file-alt text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada laporan</h3>
            <p class="text-sm text-gray-500">Saat ini tidak ada laporan yang tersedia untuk bidang <?= esc($user_bidang) ?>.</p>
        </div>
    <?php endif; ?>
</div>

<div class="flex justify-center my-8">
    <nav class="flex items-center space-x-1.5 md:space-x-3 bg-white rounded-lg shadow-lg p-2 md:p-4 border border-gray-300" aria-label="Pagination">
        <?= $pager->links('default', 'default_full') ?>
    </nav>
</div>

<?= $this->endSection(); ?>