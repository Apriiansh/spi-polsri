<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content'); ?>
<div class="p-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Pengguna</h1>
        <a href="<?= base_url('admin/users/create'); ?>" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i> Tambah Pengguna
        </a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="mb-4 p-4 text-sm text-green-800 bg-green-100 border border-green-200 rounded-lg">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="p-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-700">Daftar Pengguna</h2>
        </div>
        <div class="p-4 overflow-x-auto">
            <!-- Tabel untuk layar besar -->
            <table class="hidden lg:table w-full text-left table-auto">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <th class="py-3 px-4 font-semibold text-gray-600">No</th>
                        <th class="py-3 px-4 font-semibold text-gray-600">
                            <div class="flex items-center justify-between">
                                <span>Username</span>
                                <div class="flex flex-col">
                                    <a href="<?= base_url('admin/users?sort=asc'); ?>" class="text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-caret-up <?= (isset($_GET['sort']) && $_GET['sort'] == 'asc') ? 'text-blue-600' : ''; ?>"></i>
                                    </a>
                                    <a href="<?= base_url('admin/users?sort=desc'); ?>" class="text-gray-400 hover:text-gray-600 -mt-1">
                                        <i class="fas fa-caret-down <?= (isset($_GET['sort']) && $_GET['sort'] == 'desc') ? 'text-blue-600' : ''; ?>"></i>
                                    </a>
                                </div>
                            </div>
                        </th>
                        <th class="py-3 px-4 font-semibold text-gray-600">Email</th>
                        <th class="py-3 px-4 font-semibold text-gray-600">Bidang</th>
                        <th class="py-3 px-4 font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($users as $user):
                    ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4 text-sm text-gray-700"><?= $no++; ?></td>
                            <td class="py-3 px-4 text-sm text-gray-700"><?= $user['username']; ?></td>
                            <td class="py-3 px-4 text-sm text-gray-700"><?= $user['email']; ?></td>
                            <td class="py-3 px-4 text-sm text-gray-700"><?= $user['bidang']; ?></td>
                            <td class="py-3 px-4 text-sm text-gray-700 flex items-center space-x-2">
                                <a href="<?= base_url('admin/users/edit/' . $user['id']); ?>" class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?= base_url('admin/users/delete/' . $user['id']); ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                    <?= csrf_field(); ?>
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Card grid untuk layar kecil -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 lg:hidden">
                <?php
                $no = 1;
                foreach ($users as $user):
                ?>
                    <div class="border rounded-lg p-4 shadow hover:shadow-md bg-white">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-semibold text-gray-800"><?= $user['username']; ?></h3>
                            <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded">#<?= $no++; ?></span>
                        </div>
                        <p class="text-sm text-gray-600">Email: <?= $user['email']; ?></p>
                        <p class="text-sm text-gray-600">Bidang: <?= $user['bidang']; ?></p>
                        <div class="flex items-center space-x-3 mt-3">
                            <a href="<?= base_url('admin/users/edit/' . $user['id']); ?>" class="text-blue-600 hover:text-blue-800">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="<?= base_url('admin/users/delete/' . $user['id']); ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                <?= csrf_field(); ?>
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>