<?= $this->extend('layout/admin_main'); ?>

<?= $this->section('content'); ?>
<style>
    .preview-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 2rem;
        background-color: #fff;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .preview-header h1 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #212529;
        margin-bottom: 0.5rem;
    }

    .preview-meta {
        font-size: 0.9rem;
        color: #6c757d;
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #dee2e6;
    }

    .preview-meta .badge {
        display: inline-block;
        padding: 0.35em 0.65em;
        font-size: 75%;
        font-weight: 700;
        line-height: 1;
        color: #fff;
        border-radius: 0.375rem;
    }

    .preview-meta .bg-primary {
        background-color: #0d6efd;
    }

    .preview-content {
        font-family: 'Georgia', serif;
        line-height: 1.8;
        color: #343a40;
    }

    .preview-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 2rem 0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }
</style>

<div class="preview-container">
    <div class="preview-header">
        <h1><?= esc($kegiatan['judul']); ?></h1>
    </div>
    <div class="preview-meta">
        <span class="badge bg-primary"><?= esc($kegiatan['kategori']); ?></span>
        <span class="ms-2">Dibuat pada: <?= esc(date('d F Y', strtotime($kegiatan['created_at']))); ?></span>
    </div>

    <div class="preview-content prose max-w-none">
        <?php if (isset($kegiatan['konten']) && !empty($kegiatan['konten'])): ?>
            <?php
            $konten = $kegiatan['konten'];
            if (is_string($konten) && ($decoded = json_decode($konten, true)) && isset($decoded['ops'])) {
                // Render Quill Delta JSON sebagai HTML
                $lexer = new \nadar\quill\Lexer($konten);
                echo $lexer->render();
            } else {
                // Fallback jika konten bukan JSON
                echo $konten;
            }
            ?>
        <?php else: ?>
            <p><em>Tidak ada konten untuk ditampilkan.</em></p>
        <?php endif; ?>
    </div>

    <a href="<?= base_url('admin/kegiatan'); ?>" class="back-link">Kembali ke Daftar Kegiatan</a>
</div>

<?= $this->endSection(); ?>
