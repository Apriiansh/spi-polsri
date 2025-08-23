<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container mx-auto p-6">
    <div class="bg-white shadow-lg rounded-xl overflow-hidden p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-4"><?= esc($kegiatan['judul']); ?></h1>
        
        <div class="text-sm text-gray-600 mb-6 border-b pb-4">
            <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded-full mr-2"><?= esc($kegiatan['kategori']); ?></span>
            <span class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded-full mr-2"><?= esc($kegiatan['sub_kategori']); ?></span>
            <span class="inline-block text-gray-500">Dibuat pada: <?= esc(date('d F Y', strtotime($kegiatan['created_at']))); ?></span>
        </div>

        <div class="prose max-w-none">
            <?php 
            $konten = json_decode($kegiatan['konten'], true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($konten)):
                foreach ($konten as $block):
                    switch ($block['type']) {
                        case 'paragraph':
                            echo "<p>" . nl2br(esc($block['content'])) . "</p>";
                            break;
                        case 'image':
                            echo "<img src=\"" . esc($block['content']) . "\" alt='Gambar Konten' class=\"w-full h-auto rounded-lg my-4\">";
                            break;
                        case 'list':
                            if (is_array($block['content']) && !empty($block['content'])) {
                                echo "<ul>";
                                foreach ($block['content'] as $item) {
                                    if (!empty($item)) {
                                        echo "<li>" . esc($item) . "</li>";
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

        <div class="mt-8 text-center">
            <a href="<?= base_url('kegiatan'); ?>" class="bg-gray-300 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-400 transition duration-300">Kembali ke Daftar Kegiatan</a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
