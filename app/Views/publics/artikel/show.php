<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto max-w-2xl p-6 pb-16">
    <div class="bg-white shadow-xl rounded-2xl px-8 py-10">
        <h1 class="text-2xl font-bold text-gray-800 mb-2"><?= esc($article['title']) ?></h1>
        <div class="mb-4 text-gray-500 text-sm">
            Status:
            <?php if ($article['status'] == 'pending'): ?>
                <span class="badge bg-warning text-yellow-700">Pending</span>
            <?php elseif ($article['status'] == 'verified'): ?>
                <span class="badge bg-success text-green-700">Terverifikasi</span>
            <?php else: ?>
                <span class="badge bg-danger text-red-700">Ditolak</span>
            <?php endif; ?>
            <span class="ms-2">Dibuat pada <?= esc(date('d M Y', strtotime($article['created_at']))) ?></span>
        </div>
        <div class="ql-snow">
            <div class="ql-editor">
                <?php
                $delta = json_decode($article['content'], true);
                if ($delta) {
                    try {
                        $lexer = new \nadar\quill\Lexer($article['content']);
                        echo $lexer->render();
                    } catch (Exception $e) {
                        echo "<p><i>Error rendering content: " . esc($e->getMessage()) . "</i></p>";
                    }
                } else {
                    echo "<p><i>Konten tidak dapat ditampilkan.</i></p>";
                }
                ?>
            </div>
        </div>
        <div class="mt-6">
            <a href="<?= base_url('user/artikel') ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>