<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content'); ?>

<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Manajemen Kegiatan</h1>
    </div>
    <a href="<?= base_url('admin/kegiatan/create') ?>" class="inline-flex items-center px-4 py-2 bg-primary text-white rounded-lg shadow-md hover:bg-primary-dark transition-all duration-200 hover:shadow-lg transform hover:-translate-y-0.5">
        <i class="fas fa-plus mr-2"></i>
        Tambah Kegiatan
    </a>
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

<?php if (session()->getFlashdata('error')): ?>
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

<!-- Container utama -->
<div class="bg-white shadow-lg rounded-xl overflow-hidden">
    <!-- Header Card dengan Search -->
    <div class="px-4 py-5 sm:px-6 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-700">Daftar Kegiatan</h2>
                <p class="text-sm text-gray-500">Total: <?= count($kegiatan) ?> kegiatan</p>
            </div>
            <form action="<?= base_url('admin/kegiatan'); ?>" method="get" class="flex items-center gap-2">
                <input type="text" name="search" placeholder="Cari..." value="<?= esc($search); ?>" class="text-sm px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <button type="submit" class="px-3 py-2 bg-gray-600 text-white rounded-md shadow hover:bg-gray-700 transition-all duration-200">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Tabel Desktop -->
    <div class="hidden lg:block">
        <div class="overflow-x-auto">
            <table class="w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penulis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $i = 1 + ($pager->getCurrentPage() - 1) * $pager->getPerPage(); ?>
                    <?php if (empty($kegiatan)): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada kegiatan yang ditemukan.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($kegiatan as $keg): ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 text-sm text-gray-900"><?= $i++; ?></td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900"><?= esc($keg['judul']); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-500"><?= esc($keg['username'] ?? 'Admin'); ?></td>
                                <td class="px-6 py-4 text-sm text-gray-500"><?= esc($keg['kategori']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php
                                    $statusClass = '';
                                    $statusIcon = '';
                                    switch ($keg['status']) {
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
                                        <?= esc(ucfirst($keg['status'])) ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center space-x-2">
                                        <form action="<?= base_url('admin/kegiatan/update-status/' . $keg['id']) ?>" method="post" class="inline-flex">
                                            <?= csrf_field(); ?>
                                            <select name="status" onchange="this.form.submit()" class="text-sm px-3 py-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-all duration-200">
                                                <option value="pending" <?= ($keg['status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
                                                <option value="verified" <?= ($keg['status'] == 'verified') ? 'selected' : '' ?>>Terverifikasi</option>
                                                <option value="rejected" <?= ($keg['status'] == 'rejected') ? 'selected' : '' ?>>Ditolak</option>
                                            </select>
                                        </form>
                                        <a href="<?= base_url('admin/kegiatan/show/' . $keg['slug']); ?>" class="text-blue-600 hover:text-blue-800 p-1 rounded transition-colors duration-200" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= base_url('admin/kegiatan/edit/' . $keg['id']); ?>" class="text-yellow-600 hover:text-yellow-800 p-1 rounded transition-colors duration-200" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?= base_url('admin/kegiatan/delete/' . $keg['id']); ?>" method="post" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?');">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="text-red-600 hover:text-red-800 p-1 rounded transition-colors duration-200" title="Hapus">
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

    <!-- Card Mobile -->
    <div class="lg:hidden p-4 space-y-4">
        <?php if (empty($kegiatan)) : ?>
            <div class="text-center py-4 text-gray-500">Tidak ada kegiatan yang ditemukan.</div>
        <?php else : ?>
            <?php foreach ($kegiatan as $keg) : ?>
                <div class="border border-gray-200 rounded-lg p-4 shadow-sm hover:shadow-md transition-shadow duration-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-base font-semibold text-gray-900 leading-tight"><?= esc($keg['judul']); ?></h3>
                            <p class="text-xs text-gray-500 mt-1">Oleh: <?= esc($keg['username'] ?? 'Admin'); ?> | Kategori: <?= esc($keg['kategori']); ?></p>
                        </div>
                        <?php
                        $status_classes = [
                            'pending' => 'bg-yellow-100 text-yellow-800',
                            'verified' => 'bg-green-100 text-green-800',
                            'rejected' => 'bg-red-100 text-red-800',
                        ];
                        $status_class = $status_classes[$keg['status']] ?? 'bg-gray-100 text-gray-800';
                        ?>
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?= $status_class; ?>">
                            <?= ucfirst(esc($keg['status'])); ?>
                        </span>
                    </div>
                    <div class="flex justify-end space-x-3 mt-4">
                        <a href="<?= base_url('admin/kegiatan/show/' . $keg['slug']); ?>" class="text-blue-600 hover:text-blue-800" title="Lihat">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="<?= base_url('admin/kegiatan/edit/' . $keg['id']); ?>" class="text-yellow-600 hover:text-yellow-800" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="<?= base_url('admin/kegiatan/delete/' . $keg['id']); ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?');">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                        <!-- Dropdown untuk status -->
                        <div x-data="{ open: false }" class="relative inline-block text-left">
                            <button @click="open = !open" class="text-gray-600 hover:text-gray-800 p-1 rounded transition-colors duration-200" title="Ubah Status">
                                <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10" style="display: none;">
                                <div class="py-1">
                                    <form action="<?= base_url('admin/kegiatan/update-status/' . $keg['id']); ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="status" value="verified">
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" <?= $keg['status'] === 'verified' ? 'disabled' : ''; ?>>
                                            Verified
                                        </button>
                                    </form>
                                    <form action="<?= base_url('admin/kegiatan/update-status/' . $keg['id']); ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="status" value="pending">
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" <?= $keg['status'] === 'pending' ? 'disabled' : ''; ?>>
                                            Pending
                                        </button>
                                    </form>
                                    <form action="<?= base_url('admin/kegiatan/update-status/' . $keg['id']); ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="status" value="rejected">
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" <?= $keg['status'] === 'rejected' ? 'disabled' : ''; ?>>
                                            Rejected
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<div class="flex justify-center my-8">
    <nav class="flex items-center space-x-1.5 md:space-x-3 bg-white rounded-lg shadow-lg p-2 md:p-4 border border-gray-300" aria-label="Pagination">
        <?= $pager->links('default', 'tailwind_full') ?>
    </nav>
</div>

<!-- Floating Action Button Mobile -->
<div class="sm:hidden fixed bottom-6 right-6 z-10">
    <a href="<?= base_url('admin/kegiatan/create') ?>" class="w-14 h-14 bg-primary text-white rounded-lg shadow-lg flex items-center justify-center hover:bg-primary-dark transition-all duration-300 hover:scale-110">
        <i class="fas fa-plus text-xl"></i>
    </a>
</div>

<?= $this->endSection(); ?>