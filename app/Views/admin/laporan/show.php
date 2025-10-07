<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content'); ?>
<div class="p-6 space-y-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between md:items-center gap-3">
        <h1 class="text-2xl font-bold text-gray-800"><?= esc($title); ?></h1>
        <a href="<?= base_url('admin/laporan'); ?>"
            class="px-4 py-2 text-sm font-medium bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition">
            ← Kembali
        </a>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="p-3 text-sm text-green-700 bg-green-50 rounded-lg">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="p-3 text-sm text-red-700 bg-red-50 rounded-lg">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <!-- Detail Laporan -->
    <div class="bg-white shadow-sm rounded-xl p-6 space-y-6">
        <h2 class="text-lg font-semibold text-gray-700 border-b pb-2">Detail Laporan</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
            <div class="space-y-2">
                <p><span class="font-medium text-black-600">ID Laporan:</span> <?= esc($laporan['id']); ?></p>
                <p><span class="font-medium text-black-600">Email Pelapor:</span> <?= esc($laporan['email_pelapor']); ?></p>
                <p><span class="font-medium text-black-600">Klasifikasi:</span> <?= esc($laporan['klasifikasi_laporan']); ?></p>
                <p><span class="font-medium text-black-600">Kategori:</span> <?= esc($laporan['kategori_laporan']); ?></p>
                <p><span class="font-medium text-black-600">Judul:</span> <?= esc($laporan['judul']); ?></p>
                <p><span class="font-medium text-black-600">Tanggal Kejadian:</span> <?= esc(date('d F Y', strtotime($laporan['tgl_kejadian']))); ?></p>
                <p><span class="font-medium text-black-600">Lokasi Kejadian:</span> <?= esc($laporan['lok_kejadian']); ?></p>
                <p><span class="font-medium text-black-600">Dibuat:</span> <?= esc(date('d F Y H:i', strtotime($laporan['created_at']))); ?></p>
                <p><span class="font-medium text-black-600">Terakhir Update:</span> <?= esc(date('d F Y H:i', strtotime($laporan['updated_at']))); ?></p>
            </div>
            <div>
                <p class="font-medium text-gray-600 mb-1">Isi Laporan:</p>
                <div class="bg-gray-50 p-3 rounded-lg text-gray-800 leading-relaxed">
                    <?= nl2br(esc($laporan['isi'])); ?>
                </div>
            </div>
        </div>

        <!-- Gambar Bukti -->
        <div>
            <p class="font-medium text-gray-600 mb-2">Gambar Bukti:</p>
            <?php if (!empty($laporan['gambar_bukti'])): ?>
                <img src="<?= base_url('uploads/bukti/' . $laporan['gambar_bukti']); ?>"
                    alt="Gambar Bukti"
                    class="w-full max-w-md rounded-lg shadow-md">
            <?php else: ?>
                <p class="text-gray-500 text-sm">Tidak ada gambar bukti.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Form Update Status -->
    <div class="bg-white shadow-sm rounded-xl p-6">
        <h2 class="text-lg font-semibold text-gray-700 border-b pb-2 mb-4">Perbarui Status</h2>
        <form action="<?= base_url('admin/laporan/update-status/' . $laporan['id']); ?>" method="post" class="space-y-4">
            <?= csrf_field(); ?>
            <div>
                <label for="status_laporan" class="block text-sm font-medium text-gray-700 mb-1">Status:</label>
                <select name="status_laporan" id="status_laporan"
                    class="w-full md:w-1/3 border rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="pending" <?= ($laporan['status_laporan'] == 'pending') ? 'selected' : ''; ?>>Menunggu</option>
                    <option value="in_progress" <?= ($laporan['status_laporan'] == 'in_progress') ? 'selected' : ''; ?>>Diproses</option>
                    <option value="completed" <?= ($laporan['status_laporan'] == 'completed') ? 'selected' : ''; ?>>Selesai</option>
                    <option value="not_actionable" <?= ($laporan['status_laporan'] == 'not_actionable') ? 'selected' : ''; ?>>Tidak Dapat Ditindaklanjuti</option>
                </select>
            </div>
            <button type="submit"
                class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-sm text-sm font-medium transition">
                Perbarui Status
            </button>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>