<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto max-w-3xl p-6 pb-16">
    <div class="bg-white shadow-xl rounded-2xl px-8 py-10">
        <!-- Judul Kegiatan -->
        <h1 class="text-3xl font-extrabold text-gray-800 mb-4 leading-snug">
            <?= esc($kegiatan['judul']) ?>
        </h1>

        <!-- Info Kegiatan -->
        <div class="mb-6 text-sm text-gray-500 flex flex-wrap items-center gap-3">
            <div>
                Status:
                <?php if ($kegiatan['status'] === 'pending'): ?>
                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-semibold">Pending</span>
                <?php elseif ($kegiatan['status'] === 'verified'): ?>
                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-semibold">Terverifikasi</span>
                <?php else: ?>
                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-semibold">Ditolak</span>
                <?php endif; ?>
            </div>
            <div>
                <i class="fas fa-folder me-1"></i>
                Kategori: <span class="font-medium text-gray-700"><?= esc($kegiatan['kategori']) ?></span>
            </div>
            <div>
                <i class="fas fa-calendar-alt me-1"></i>
                Dibuat pada <?= esc(date('d M Y', strtotime($kegiatan['created_at']))) ?>
            </div>
        </div>

        <!-- Konten Kegiatan -->
        <div class="prose max-w-none prose-headings:text-gray-800 prose-p:text-gray-700 prose-a:text-blue-600 prose-strong:text-gray-900 prose-img:rounded-xl prose-img:shadow">
            <?php
            $delta = json_decode($kegiatan['konten'], true);
            if ($delta) {
                try {
                    $lexer = new \nadar\quill\Lexer($kegiatan['konten']);
                    echo $lexer->render();
                } catch (Exception $e) {
                    echo '<p><i>Error rendering content: ' . esc($e->getMessage()) . '</i></p>';
                }
            } else {
                echo '<p><i>Konten tidak dapat ditampilkan.</i></p>';
            }
            ?>
        </div>

        <!-- Tombol Kembali -->
        <div class="mt-8">
            <a href="<?= base_url('user/kegiatan') ?>" class="inline-flex items-center px-5 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-xl shadow transition">
                <i class="fas fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
