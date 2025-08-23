<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto max-w-xl p-6 pb-16">
    <div class="bg-white shadow-xl rounded-2xl px-8 py-10">

        <h1 class="text-2xl font-bold text-gray-800 mb-8 text-center">Profil Saya</h1>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="mb-4 px-4 py-3 rounded bg-green-100 border border-green-300 text-green-800 text-center">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('pw_success')): ?>
            <div class="mb-4 px-4 py-3 rounded bg-green-100 border border-green-300 text-green-800 text-center">
                <?= session()->getFlashdata('pw_success') ?>
            </div>
        <?php endif; ?>

        <!-- Profil Read Only -->
        <div id="profil-display">
            <div class="flex items-center space-x-4 mb-6">
                <div class="w-14 h-14 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-2xl text-white font-bold">
                    <?= strtoupper(substr($user['username'], 0, 1)) ?>
                </div>
                <div>
                    <div class="font-semibold text-lg text-gray-800"><?= esc($user['username']) ?></div>
                    <div class="text-slate-500"><?= esc($user['email']) ?></div>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <button type="button" onclick="toggleEditProfil(true)" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition w-full sm:w-auto">Edit Profil</button>
                <button type="button" onclick="toggleEditPassword(true)" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg shadow transition w-full sm:w-auto">Ganti Password</button>
            </div>
        </div>

        <!-- Form Edit Profil (hidden by default) -->
        <div id="profil-edit" style="display: none;">
            <h2 class="text-lg font-semibold mb-4 text-indigo-700 mt-8">Edit Profil</h2>
            <form action="<?= site_url('/user/profile/update') ?>" method="post" class="space-y-4">
                <?= csrf_field() ?>
                <div>
                    <label for="username" class="block mb-1 text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username"
                        class="form-control block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        value="<?= old('username', $user['username'] ?? '') ?>" required autocomplete="off">
                    <?php if (session('errors.username')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= session('errors.username') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="email" class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email"
                        class="form-control block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        value="<?= old('email', $user['email'] ?? '') ?>" required autocomplete="off">
                    <?php if (session('errors.email')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= session('errors.email') ?></p>
                    <?php endif; ?>
                </div>
                <div class="flex gap-3 pt-1">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition">Simpan</button>
                    <button type="button" onclick="toggleEditProfil(false)"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg shadow transition">Batal</button>
                </div>
            </form>
        </div>

        <!-- Form Ganti Password (hidden by default) -->
        <div id="profil-password" style="display: none;">
            <h2 class="text-lg font-semibold mb-4 text-indigo-700 mt-8">Ganti Password</h2>
            <form action="<?= site_url('/user/profile/updatePassword') ?>" method="post" class="space-y-4">
                <?= csrf_field() ?>
                <div>
                    <label for="old_password" class="block mb-1 text-sm font-medium text-gray-700">Password Lama</label>
                    <input type="password" id="old_password" name="old_password"
                        class="form-control block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    <?php if (session('pw_errors.old_password')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= session('pw_errors.old_password') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="new_password" class="block mb-1 text-sm font-medium text-gray-700">Password Baru</label>
                    <input type="password" id="new_password" name="new_password"
                        class="form-control block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    <?php if (session('pw_errors.new_password')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= session('pw_errors.new_password') ?></p>
                    <?php endif; ?>
                </div>
                <div>
                    <label for="confirm_new_password" class="block mb-1 text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                    <input type="password" id="confirm_new_password" name="confirm_new_password"
                        class="form-control block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    <?php if (session('pw_errors.confirm_new_password')): ?>
                        <p class="text-red-500 text-xs mt-1"><?= session('pw_errors.confirm_new_password') ?></p>
                    <?php endif; ?>
                </div>
                <div class="flex gap-3 pt-1">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition">Ganti Password</button>
                    <button type="button" onclick="toggleEditPassword(false)"
                        class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold px-6 py-2 rounded-lg shadow transition">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleEditProfil(show) {
        document.getElementById('profil-display').style.display = show ? 'none' : '';
        document.getElementById('profil-edit').style.display = show ? '' : 'none';
        document.getElementById('profil-password').style.display = 'none';
    }

    function toggleEditPassword(show) {
        document.getElementById('profil-display').style.display = show ? 'none' : '';
        document.getElementById('profil-password').style.display = show ? '' : 'none';
        document.getElementById('profil-edit').style.display = 'none';
    }

    // Jika session show_pw_tab, langsung buka form password
    <?php if (session('show_pw_tab')): ?>
        toggleEditPassword(true);
    <?php endif; ?>
</script>

<?= $this->endSection() ?>