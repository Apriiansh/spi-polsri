<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content'); ?>
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Pengguna</h1>
        <a href="<?= base_url('admin/users/create'); ?>" class="btn-primary">Tambah Pengguna</a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="p-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-700">Daftar Pengguna</h2>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="w-full text-left table-auto">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <th class="py-3 px-4 font-semibold text-gray-600">ID</th>
                            <th class="py-3 px-4 font-semibold text-gray-600">Username</th>
                            <th class="py-3 px-4 font-semibold text-gray-600">Email</th>
                            <th class="py-3 px-4 font-semibold text-gray-600">Role</th>
                            <th class="py-3 px-4 font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 text-sm text-gray-700"><?= $user['id']; ?></td>
                                <td class="py-3 px-4 text-sm text-gray-700"><?= $user['username']; ?></td>
                                <td class="py-3 px-4 text-sm text-gray-700"><?= $user['email']; ?></td>
                                <td class="py-3 px-4 text-sm text-gray-700"><?= $user['role']; ?></td>
                                <td class="py-3 px-4 text-sm text-gray-700 flex items-center space-x-2">
                                    <a href="<?= base_url('admin/users/edit/' . $user['id']); ?>" class="text-blue-600 hover:text-blue-800">Edit</a>
                                    <form action="<?= base_url('admin/users/delete/' . $user['id']); ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                        <?= csrf_field(); ?>
                                        <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>