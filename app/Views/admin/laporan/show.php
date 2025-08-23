<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content'); ?>
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800"><?= esc($title); ?></h1>
        <a href="<?= base_url('admin/laporan'); ?>" class="btn-secondary">Kembali ke Daftar Laporan</a>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden p-6 mb-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Detail Laporan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <p class="text-gray-600"><strong>ID Laporan:</strong> <?= esc($laporan['id']); ?></p>
                <p class="text-gray-600"><strong>Kategori:</strong> <?= esc($laporan['kategori_laporan']); ?></p>
                <p class="text-gray-600"><strong>Judul:</strong> <?= esc($laporan['judul']); ?></p>
                <p class="text-gray-600"><strong>Tanggal Kejadian:</strong> <?= esc(date('d F Y', strtotime($laporan['tgl_kejadian']))); ?></p>
                <p class="text-gray-600"><strong>Lokasi Kejadian:</strong> <?= esc($laporan['lok_kejadian']); ?></p>
                <p class="text-gray-600"><strong>Dibuat pada:</strong> <?= esc(date('d F Y H:i', strtotime($laporan['created_at']))); ?></p>
                <p class="text-gray-600"><strong>Terakhir Diperbarui:</strong> <?= esc(date('d F Y H:i', strtotime($laporan['updated_at']))); ?></p>
            </div>
            <div>
                <p class="text-gray-600"><strong>Isi Laporan:</strong></p>
                <p class="text-gray-800 bg-gray-50 p-3 rounded-md"><?= nl2br(esc($laporan['isi'])); ?></p>
            </div>
        </div>

        <div class="mt-6">
            <p class="text-gray-600"><strong>Gambar Bukti:</strong></p>
            <?php if (!empty($laporan['gambar_bukti'])): ?>
                <img src="<?= base_url('uploads/bukti/' . $laporan['gambar_bukti']); ?>" alt="Gambar Bukti" class="max-w-xs h-auto rounded-lg shadow-md mt-2">
            <?php else: ?>
                <p class="text-gray-500">Tidak ada gambar bukti.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden p-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-4">Perbarui Status Laporan</h2>
        <form action="<?= base_url('admin/laporan/update-status/' . $laporan['id']); ?>" method="post">
            <?= csrf_field(); ?>
            <div class="mb-4">
                <label for="status_laporan" class="block text-sm font-medium text-gray-700">Status:</label>
                <select name="status_laporan" id="status_laporan" class="mt-1 block w-full md:w-1/2 border rounded-lg px-3 py-2 text-sm">
                    <option value="pending" <?= ($laporan['status_laporan'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
                    <option value="in_progress" <?= ($laporan['status_laporan'] == 'in_progress') ? 'selected' : ''; ?>>In Progress</option>
                    <option value="completed" <?= ($laporan['status_laporan'] == 'completed') ? 'selected' : ''; ?>>Completed</option>
                </select>
            </div>
            <button type="submit" class="btn-primary">Perbarui Status</button>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>