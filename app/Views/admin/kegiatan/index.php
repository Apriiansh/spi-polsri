<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content'); ?>
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800"><?= $title; ?></h1>
        <a href="<?= base_url('admin/kegiatan/create'); ?>" class="btn-primary">Tambah Kegiatan</a>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden mb-6">
        <div class="p-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-700">Filter Kegiatan</h2>
        </div>
        <div class="p-4">
            <form action="<?= base_url('admin/kegiatan'); ?>" method="get" class="flex flex-wrap gap-3 items-center">
                <input type="text" name="search" placeholder="Cari kegiatan..."
                    value="<?= esc($search ?? ''); ?>"
                    class="border rounded-lg px-3 py-2 text-sm">

                <select name="kategori" id="kategori-filter" class="border rounded-lg px-3 py-2 text-sm">
                    <option value="">Semua Kategori</option>
                    <?php foreach ($kategoriData as $kategoriName => $subKategoriList): ?>
                        <option value="<?= esc($kategoriName); ?>" <?= (isset($kategori_filter) && $kategori_filter == $kategoriName) ? 'selected' : ''; ?>>
                            <?= esc($kategoriName); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <select name="subkategori" id="subkategori-filter" class="border rounded-lg px-3 py-2 text-sm">
                    <option value="">Semua Sub Kategori</option>
                    <?php
                    // Populate subcategories if a category is already selected
                    if (isset($kategori_filter) && !empty($kategori_filter) && isset($kategoriData[$kategori_filter])) {
                        foreach ($kategoriData[$kategori_filter] as $subKategoriItem) {
                            echo '<option value="' . esc($subKategoriItem) . '" ' . ((isset($subkategori_filter) && $subkategori_filter == $subKategoriItem) ? 'selected' : '') . '>' . esc($subKategoriItem) . '</option>';
                        }
                    }
                    ?>
                </select>

                <button type="submit" class="btn-secondary">Filter</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const kategoriFilter = document.getElementById('kategori-filter');
            const subkategoriFilter = document.getElementById('subkategori-filter');
            const kategoriData = <?= json_encode($kategoriData); ?>;

            function updateSubkategoriOptions() {
                const selectedKategori = kategoriFilter.value;
                subkategoriFilter.innerHTML = '<option value="">Semua Sub Kategori</option>'; // Reset subkategori options

                if (selectedKategori && kategoriData[selectedKategori]) {
                    kategoriData[selectedKategori].forEach(function(sub) {
                        const option = document.createElement('option');
                        option.value = sub;
                        option.textContent = sub;
                        // Preserve selected subkategori if it matches
                        if ('<?= esc($subkategori_filter ?? ''); ?>' === sub) {
                            option.selected = true;
                        }
                        subkategoriFilter.appendChild(option);
                    });
                }
            }

            kategoriFilter.addEventListener('change', updateSubkategoriOptions);

            // Initial update in case a category was pre-selected on page load
            updateSubkategoriOptions();
        });
    </script>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="p-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-700">Daftar Kegiatan</h2>
        </div>
        <div class="p-4 overflow-x-auto">
            <table class="w-full text-left table-auto">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <th class="py-3 px-4 font-semibold text-gray-600">No</th>
                        <th class="py-3 px-4 font-semibold text-gray-600">Judul</th>
                        <th class="py-3 px-4 font-semibold text-gray-600">Kategori</th>
                        <th class="py-3 px-4 font-semibold text-gray-600">Sub Kategori</th>
                        <th class="py-3 px-4 font-semibold text-gray-600">Tanggal</th>
                        <th class="py-3 px-4 font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($kegiatan)) : ?>
                        <?php $i = 1 + (10 * ($pager->getCurrentPage() - 1)); ?>
                        <?php foreach ($kegiatan as $item) : ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 text-sm text-gray-700"><?= $i++; ?></td>
                                <td class="py-3 px-4 text-sm text-gray-700"><?= esc($item['judul']); ?></td>
                                <td class="py-3 px-4 text-sm text-gray-700"><?= esc($item['kategori'] ?? 'N/A'); ?></td>
                                <td class="py-3 px-4 text-sm text-gray-700"><?= esc($item['sub_kategori'] ?? 'N/A'); ?></td>
                                <td class="py-3 px-4 text-sm text-gray-700"><?= esc(date('d M Y', strtotime($item['created_at']))); ?></td>
                                <td class="py-3 px-4 text-sm text-gray-700 flex items-center space-x-2">
                                    <a href="<?= base_url('admin/kegiatan/show/' . $item['id']); ?>" class="text-green-600 hover:text-green-800">Lihat</a>
                                    <a href="<?= base_url('admin/kegiatan/edit/' . $item['id']); ?>" class="text-blue-600 hover:text-blue-800">Edit</a>
                                    <form action="<?= base_url('admin/kegiatan/delete/' . $item['id']); ?>" method="post"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?');">
                                        <?= csrf_field(); ?>
                                        <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="6" class="py-3 px-4 text-center text-gray-500">Tidak ada data kegiatan ditemukan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        <?= $pager->links('default', 'default_full') ?>
    </div>
</div>
<?= $this->endSection(); ?>