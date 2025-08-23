<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">Daftar Kegiatan</h1>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden mb-8">
        <div class="p-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-700">Filter Kegiatan</h2>
        </div>
        <div class="p-4">
            <form action="<?= base_url('kegiatan'); ?>" method="get" class="flex flex-wrap gap-4 items-center">
                <input type="text" name="search" placeholder="Cari judul..."
                    value="<?= esc($search ?? ''); ?>"
                    class="border rounded-lg px-3 py-2 text-sm flex-grow">

                <select name="kategori" class="border rounded-lg px-3 py-2 text-sm">
                    <option value="">Semua Kategori</option>
                    <?php foreach (array_keys($kategoriData) as $kategori_nama) : ?>
                        <option value="<?= esc($kategori_nama); ?>" <?= ($kategori_filter == $kategori_nama) ? 'selected' : ''; ?>>
                            <?= esc($kategori_nama); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <select id="sub_kategori_filter" name="subkategori" class="border rounded-lg px-3 py-2 text-sm">
                    <option value="">Semua Sub Kategori</option>
                    <?php 
                    // Populate subkategori based on selected kategori_filter if available
                    if (!empty($kategori_filter) && isset($kategoriData[$kategori_filter])) {
                        foreach ($kategoriData[$kategori_filter] as $sub_nama) {
                            echo '<option value="' . esc($sub_nama) . '" ' . (($subkategori_filter == $sub_nama) ? 'selected' : '') . '>' . esc($sub_nama) . '</option>';
                        }
                    }
                    ?>
                </select>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-300">Filter</button>
                <a href="<?= base_url('kegiatan'); ?>" class="bg-gray-300 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-400 transition duration-300">Reset</a>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if (!empty($kegiatan)) : ?>
            <?php foreach ($kegiatan as $item) : ?>
                <div class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105">
                    <?php
                    $konten = json_decode($item['konten'], true);
                    $imageUrl = '';
                    if (json_last_error() === JSON_ERROR_NONE && is_array($konten)) {
                        foreach ($konten as $block) {
                            if ($block['type'] === 'image' && !empty($block['content'])) {
                                $imageUrl = $block['content'];
                                break;
                            }
                        }
                    }
                    if (empty($imageUrl)) {
                        $imageUrl = 'https://placehold.co/400x250/9CA3AF/FFFFFF?text=No+Image';
                    }
                    ?>
                    <img src="<?= esc($imageUrl); ?>" alt="<?= esc($item['judul']); ?>" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2"><?= esc($item['judul']); ?></h3>
                        <div class="text-sm text-gray-600 mb-4">
                            <span class="inline-block bg-blue-100 text-blue-800 px-2 py-1 rounded-full mr-2"><?= esc($item['kategori']); ?></span>
                            <span class="inline-block bg-green-100 text-green-800 px-2 py-1 rounded-full"><?= esc($item['sub_kategori']); ?></span>
                        </div>
                        <p class="text-gray-700 text-sm mb-4 line-clamp-3">
                            <?php 
                            $firstParagraph = '';
                            if (json_last_error() === JSON_ERROR_NONE && is_array($konten)) {
                                foreach ($konten as $block) {
                                    if ($block['type'] === 'paragraph' && !empty($block['content'])) {
                                        $firstParagraph = $block['content'];
                                        break;
                                    }
                                }
                            }
                            echo esc($firstParagraph);
                            ?>
                        </p>
                        <a href="<?= base_url('kegiatan/' . $item['id']); ?>" class="text-blue-600 hover:text-blue-800 font-medium">Baca Selengkapnya &rarr;</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="col-span-full bg-white p-6 rounded-lg shadow-lg text-center text-gray-600">
                Tidak ada kegiatan yang ditemukan.
            </div>
        <?php endif; ?>
    </div>

    <div class="mt-8 text-center">
        <?= $pager->links('default', 'default_full') ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kategoriData = <?= json_encode($kategoriData); ?>;
        const kategoriSelect = document.querySelector('select[name="kategori"]');
        const subKategoriSelect = document.getElementById('sub_kategori_filter');
        const currentKategori = kategoriSelect.value;
        const currentSubKategori = "<?= esc($subkategori_filter ?? ''); ?>";

        function populateSubKategori(selectedKategori, selectedSub) {
            subKategoriSelect.innerHTML = '<option value="">Semua Sub Kategori</option>';
            if (selectedKategori && kategoriData[selectedKategori]) {
                kategoriData[selectedKategori].forEach(sub => {
                    const option = document.createElement('option');
                    option.value = sub;
                    option.textContent = sub;
                    if (sub === selectedSub) {
                        option.selected = true;
                    }
                    subKategoriSelect.appendChild(option);
                });
            }
        }

        kategoriSelect.addEventListener('change', function() {
            populateSubKategori(this.value, null);
        });

        // Initial population on page load
        if (currentKategori) {
            populateSubKategori(currentKategori, currentSubKategori);
        }
    });
</script>

<?= $this->endSection() ?>