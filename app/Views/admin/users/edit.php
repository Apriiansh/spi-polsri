<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content'); ?>
<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Pengguna</h1>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700">
            <ul class="list-disc pl-5 space-y-1">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-lg rounded-2xl p-6">
        <form action="<?= base_url('admin/users/update/' . $user['id']); ?>" method="post" class="space-y-6">
            <?= csrf_field(); ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="flex flex-col">
                    <label for="username" class="text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" id="username" name="username" class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="<?= old('username', $user['username']); ?>" required>
                </div>
                <div class="flex flex-col">
                    <label for="email" class="text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="<?= old('email', $user['email']); ?>" required>
                </div>
                <div class="flex flex-col">
                    <label for="bidang" class="text-sm font-medium text-gray-700 mb-1">Bidang</label>
                    <select id="bidang" name="bidang" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="Akuntansi/Keuangan" <?= old('bidang') == 'Akuntansi/Keuangan' ? 'selected' : ''; ?>>Akuntansi/Keuangan</option>
                        <option value="Hukum" <?= old('bidang') == 'Hukum' ? 'selected' : ''; ?>>Hukum</option>
                        <option value="Manajemen SDM" <?= old('bidang') == 'Manajemen SDM' ? 'selected' : ''; ?>>Manajemen SDM</option>
                        <option value="Manajemen Aset" <?= old('bidang') == 'Manajemen Aset' ? 'selected' : ''; ?>>Manajemen Aset</option>
                        <option value="Ketatalaksanaan" <?= old('bidang') == 'Ketatalaksanaan' ? 'selected' : ''; ?>>Ketatalaksanaan</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="<?= base_url('admin/users'); ?>" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">Batal</a>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>