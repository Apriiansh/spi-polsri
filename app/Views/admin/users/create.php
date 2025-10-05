<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content'); ?>
<div class="p-4 sm:p-6">
    <h1 class="text-xl sm:text-2xl font-semibold text-gray-800 mb-6">Tambah Pengguna Baru</h1>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="mb-4 p-4 rounded-lg bg-red-100 border border-red-200 text-red-700 text-sm">
            <ul class="list-disc list-inside">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-md rounded-xl p-4 sm:p-6">
        <form action="<?= base_url('admin/users/store'); ?>" method="post" class="space-y-4">
            <?= csrf_field(); ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
                <div class="flex flex-col">
                    <label for="username" class="text-sm font-medium text-gray-700 mb-1">Username</label>
                    <input type="text" id="username" name="username" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?= old('username'); ?>" required>
                </div>
                <div class="flex flex-col">
                    <label for="email" class="text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="<?= old('email'); ?>" required>
                </div>
                <div class="flex flex-col">
                    <label for="password" class="text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
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
                <input type="hidden" name="role" value="user">
            </div>

            <div class="pt-4 flex justify-end space-x-3">
                <a href="<?= base_url('admin/users'); ?>" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition">Batal</a>
                <button type="submit" class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>