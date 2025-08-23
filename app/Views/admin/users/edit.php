<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content'); ?>
<div class="p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Pengguna</h1>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-lg rounded-xl p-6">
        <form action="<?= base_url('admin/users/update/' . $user['id']); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="username" class="form-label">Username</label>
                    <input type="text" id="username" name="username" class="form-input" value="<?= old('username', $user['username']); ?>" required>
                </div>
                <div>
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-input" value="<?= old('email', $user['email']); ?>" required>
                </div>
                <div>
                    <label for="role" class="form-label">Role</label>
                    <select id="role" name="role" class="form-input" required>
                        <option value="user" <?= old('role', $user['role']) == 'user' ? 'selected' : ''; ?>>User</option>
                        <option value="admin" <?= old('role', $user['role']) == 'admin' ? 'selected' : ''; ?>>Admin</option>
                    </select>
                </div>
            </div>
            <div class="mt-6 flex justify-end space-x-4">
                <a href="<?= base_url('admin/users'); ?>" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>