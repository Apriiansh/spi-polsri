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
        text-align: center;
        white-space: nowrap;
        vertical-align: baseline;
        border-radius: 0.375rem;
    }

    .preview-meta .bg-primary {
        background-color: #0d6efd;
    }

    .preview-meta .bg-secondary {
        background-color: #6c757d;
    }

    .preview-content {
        font-family: 'Georgia', serif;
        line-height: 1.8;
        color: #343a40;
    }

    .preview-content p {
        margin-bottom: 1.5rem;
    }

    .preview-content img {
        max-width: 100%;
        height: auto;
        border-radius: 0.5rem;
        margin: 2rem 0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .preview-content ul {
        list-style-type: disc;
        padding-left: 2rem;
        margin-bottom: 1.5rem;
    }

    .preview-content li {
        margin-bottom: 0.5rem;
    }

    .back-link {
        display: inline-block;
        margin-top: 2rem;
        padding: 0.75rem 1.25rem;
        font-size: 1rem;
        font-weight: 600;
        border-radius: 0.5rem;
        background-color: #6c757d;
        color: white;
        text-decoration: none;
        transition: background-color 0.15s ease-in-out;
    }

    .back-link:hover {
        background-color: #5c636a;
    }
</style>

<div class="preview-container">
    <div class="preview-header">
        <h1><?= esc($kegiatan['judul']); ?></h1>
    </div>
    <div class="preview-meta">
        <span class="badge bg-primary"><?= esc($kegiatan['kategori']); ?></span>
        <span class="badge bg-secondary"><?= esc($kegiatan['sub_kategori']); ?></span>
        <span class="ms-2">Dibuat pada: <?= esc(date('d F Y', strtotime($kegiatan['created_at']))); ?></span>
    </div>

    <div class="preview-content">
        <?php 
        $konten = json_decode($kegiatan['konten'], true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($konten)):
            foreach ($konten as $block):
                switch ($block['type']) {
                    case 'paragraph':
                        echo "<p>" . nl2br(esc($block['content'])) . "</p>";
                        break;
                    case 'image':
                        echo "<img src=\"" . esc($block['content']) . "\" alt='Gambar Konten'>";
                        break;
                    case 'list':
                        $listItems = [];
                        if (is_array($block['content'])) {
                            $listItems = $block['content'];
                        } elseif (is_string($block['content'])) {
                            $listItems = explode("\n", trim($block['content']));
                        }

                        if (!empty($listItems)) {
                            echo "<ul>";
                            foreach ($listItems as $item) {
                                $trimmedItem = trim($item);
                                if (!empty($trimmedItem)) {
                                    echo "<li>" . esc($trimmedItem) . "</li>";
                                }
                            }
                            echo "</ul>";
                        }
                        break;
                }
            endforeach;
        else:
            echo "<p>Konten tidak dapat ditampilkan.</p>";
        endif;
        ?>
    </div>
</div>

<?= $this->endSection(); ?>
