<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content') ?>
<div class="max-w-4xl mx-auto">
    <!-- Back Button -->
    <div class="mb-4">
        <a href="<?= base_url('admin/peraturan') ?>" class="text-gray-600 hover:text-gray-800 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar Peraturan
        </a>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6" role="alert">
            <p><?= session()->getFlashdata('success') ?></p>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6" role="alert">
            <p><?= session()->getFlashdata('error') ?></p>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <!-- Header -->
        <div class="p-6 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200 flex justify-between items-center">
            <h1 class="text-xl font-bold text-gray-800">Detail Peraturan</h1>
            <?php
            $statusClass = '';
            switch ($peraturan['status']) {
                case 'pending':
                    $statusClass = 'bg-yellow-100 text-yellow-800';
                    break;
                case 'published':
                    $statusClass = 'bg-green-100 text-green-800';
                    break;
                case 'rejected':
                    $statusClass = 'bg-red-100 text-red-800';
                    break;
            }
            ?>
            <span class="px-3 py-1 rounded-full text-sm font-semibold <?= $statusClass ?>">
                <?= ucfirst($peraturan['status']) ?>
            </span>
        </div>

        <!-- Content -->
        <div class="p-6 space-y-6">
            <div>
                <h2 class="text-lg font-bold text-gray-900 leading-relaxed">
                    <?= esc($peraturan['judul']) ?>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Info Pengirim -->
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm font-medium text-gray-500 mb-1">Pengirim</p>
                    <p class="text-gray-800 font-semibold"><?= esc($peraturan['username']) ?></p>
                    <p class="text-gray-600 text-sm"><?= esc($peraturan['email']) ?></p>
                </div>
                <!-- Tanggal Upload -->
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm font-medium text-gray-500 mb-1">Tanggal Upload</p>
                    <p class="text-gray-800 font-semibold"><?= date('d F Y, H:i', strtotime($peraturan['created_at'])) ?> WIB</p>
                </div>
                <!-- Peraturan -->
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm font-medium text-gray-500 mb-1">Peraturan</p>
                    <p class="text-gray-800 font-semibold"><?= esc($peraturan['peraturan']) ?></p>
                </div>
                <!-- Kategori -->
                <div class="p-4 bg-gray-50 rounded-lg">
                    <p class="text-sm font-medium text-gray-500 mb-1">Kategori</p>
                    <p class="text-gray-800 font-semibold"><?= esc($peraturan['kategori']) ?></p>
                </div>
            </div>

            <!-- File Lampiran -->
            <div class="p-4 bg-blue-50 rounded-lg border border-blue-200 flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-file-alt text-blue-500 text-2xl mr-4"></i>
                    <div>
                        <p class="font-medium text-blue-800">File Lampiran</p>
                        <p class="text-sm text-blue-700"><?= esc($peraturan['file_lampiran']) ?></p>
                    </div>
                </div>
                <a href="<?= base_url('admin/peraturan/download/' . $peraturan['id']) ?>" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm">
                    <i class="fas fa-download mr-2"></i> Download
                </a>
            </div>
        </div>

        <!-- Action Footer -->
        <?php if ($peraturan['status'] == 'pending') : ?>
            <div class="p-6 bg-gray-50 border-t border-gray-200">
                <h3 class="text-md font-semibold text-gray-700 mb-3">Aksi Verifikasi</h3>
                <div class="flex flex-col sm:flex-row gap-3">
                    <form action="<?= base_url('admin/peraturan/update-status/' . $peraturan['id']) ?>" method="post" class="flex-1">
                        <?= csrf_field() ?>
                        <input type="hidden" name="status" value="published">
                        <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            <i class="fas fa-check-circle mr-2"></i> Setujui (Publish)
                        </button>
                    </form>
                    <form action="<?= base_url('admin/peraturan/update-status/' . $peraturan['id']) ?>" method="post" class="flex-1">
                        <?= csrf_field() ?>
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                            <i class="fas fa-times-circle mr-2"></i> Tolak (Reject)
                        </button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>