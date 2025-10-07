<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="p-6">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-gray-800 flex items-center">
            <?= esc($title) ?>
        </h1>
        <a href="<?= base_url('user/peraturan/create') ?>"
            class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 flex items-center space-x-2 transition-colors">
            <i class="fas fa-plus"></i>
            <span>Tambah Peraturan</span>
        </a>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 flex items-center" role="alert">
            <i class="fas fa-check-circle mr-2"></i>
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 flex items-center" role="alert">
            <i class="fas fa-exclamation-circle mr-2"></i>
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- Filter & Search -->
    <div class="bg-white shadow-lg rounded-xl overflow-hidden mb-6">
        <div class="px-4 py-5 sm:px-6 bg-gradient-to-r from-gray-50 to-gray-100 border-b border-gray-200">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                    <h2 class="text-lg font-semibold text-gray-700">Filter Peraturan</h2>
                    <p class="text-sm text-gray-500">Total: <?= $pager->getTotal() ?> peraturan</p>
            </div>
                <form action="<?= base_url('user/peraturan') ?>" method="get" class="flex flex-col sm:flex-row sm:items-center sm:space-x-2 space-y-2 sm:space-y-0 w-full sm:w-auto">
                    <input type="text" name="search" value="<?= esc($search ?? '') ?>" placeholder="Cari judul/peraturan..." class="text-sm px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full sm:w-auto">
                    <select name="kategori" class="text-sm px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full sm:w-auto">
                        <option value="">Semua Kategori</option>
                        <?php foreach ($kategoriData as $kat): ?>
                            <option value="<?= esc($kat) ?>" <?= ($kategori_filter ?? '') == $kat ? 'selected' : '' ?>>
                                <?= esc($kat) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <select name="status" class="text-sm px-3 py-2 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full sm:w-auto">
                        <option value="">Semua Status</option>
                        <option value="pending" <?= ($status_filter ?? '') == 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="published" <?= ($status_filter ?? '') == 'published' ? 'selected' : '' ?>>Published</option>
                        <option value="rejected" <?= ($status_filter ?? '') == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                    </select>
                    <div class="flex items-center space-x-2">
                        <button type="submit" class="w-full sm:w-auto bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 text-sm">Filter</button>
                        <a href="<?= base_url('user/peraturan') ?>" class="w-full sm:w-auto text-center bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-lg hover:bg-gray-300 text-sm">Reset</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Desktop Table -->
    <div class="hidden lg:block bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="p-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-700">Daftar Peraturan</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <th class="py-3 px-4 font-semibold text-gray-600">Judul</th>
                        <th class="py-3 px-4 font-semibold text-gray-600">Peraturan</th>
                        <th class="py-3 px-4 font-semibold text-gray-600">Kategori</th>
                        <th class="py-3 px-4 font-semibold text-gray-600">Status</th>
                        <th class="py-3 px-4 font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($peraturan)) : ?>
                        <?php foreach ($peraturan as $item) : ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 text-sm text-gray-700">
                                    <?= esc($item['judul']); ?>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-700"><?= esc($item['peraturan']); ?></td>
                                <td class="py-3 px-4 text-sm text-gray-700">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                        <?= esc($item['kategori']); ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-700">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                                        <?php if ($item['status'] == 'pending'): ?>
                                            bg-yellow-100 text-yellow-800
                                        <?php elseif ($item['status'] == 'published'): ?>
                                            bg-green-100 text-green-800
                                        <?php else: ?>
                                            bg-red-100 text-red-800
                                        <?php endif; ?>
                                    ">
                                        <?= ucfirst($item['status']); ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-sm">
                                    <div class="flex items-center space-x-3">
                                        <a href="<?= base_url('user/peraturan/show/' . $item['id']); ?>"
                                            class="text-green-600 hover:text-green-800" title="Lihat Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="<?= base_url('user/peraturan/download/' . $item['id']); ?>"
                                            class="text-blue-600 hover:text-blue-800" title="Download">
                                            <i class="fas fa-download"></i>
                                        </a>
                                        <?php if ($item['status'] == 'pending'): ?>
                                            <a href="<?= base_url('user/peraturan/edit/' . $item['id']); ?>"
                                                class="text-indigo-600 hover:text-indigo-800" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="<?= base_url('user/peraturan/delete/' . $item['id']); ?>"
                                                method="post" class="inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus peraturan ini?');">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5" class="py-8 px-4 text-center text-gray-500">
                                <i class="fas fa-inbox text-4xl mb-2 block"></i>
                                Belum ada peraturan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if ($pager->getPageCount() > 1): ?>
            <div class="p-4 border-t border-gray-200">
                <?= $pager->links('default', 'custom_pagination') ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Mobile Card View -->
    <div class="grid grid-cols-1 gap-4 lg:hidden">
        <?php if (!empty($peraturan)) : ?>
            <?php foreach ($peraturan as $item) : ?>
                <div class="bg-white shadow-md rounded-lg p-4 space-y-3">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="text-base font-semibold text-gray-800"><?= esc($item['judul']); ?></h3>
                        </div>
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            <?php if ($item['status'] == 'pending'): ?>
                                bg-yellow-100 text-yellow-800
                            <?php elseif ($item['status'] == 'published'): ?>
                                bg-green-100 text-green-800
                            <?php else: ?>
                                bg-red-100 text-red-800
                            <?php endif; ?>
                        ">
                            <?= ucfirst($item['status']); ?>
                        </span>
                    </div>

                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div>
                            <span class="font-medium text-gray-600">Peraturan:</span>
                            <p class="text-gray-800"><?= esc($item['peraturan']); ?></p>
                        </div>
                    </div>

                    <div>
                        <span class="px-2 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                            <?= esc($item['kategori']); ?>
                        </span>
                    </div>

                    <div class="flex space-x-3 pt-2 border-t border-gray-200">
                        <a href="<?= base_url('user/peraturan/show/' . $item['id']); ?>"
                            class="text-green-600 hover:text-green-800 flex items-center" title="Lihat">
                            <i class="fas fa-eye mr-1"></i> Lihat
                        </a>
                        <a href="<?= base_url('user/peraturan/download/' . $item['id']); ?>"
                            class="text-blue-600 hover:text-blue-800 flex items-center" title="Download">
                            <i class="fas fa-download mr-1"></i> Download
                        </a>
                        <?php if ($item['status'] == 'pending'): ?>
                            <a href="<?= base_url('user/peraturan/edit/' . $item['id']); ?>"
                                class="text-indigo-600 hover:text-indigo-800 flex items-center" title="Edit">
                                <i class="fas fa-edit mr-1"></i> Edit
                            </a>
                            <form action="<?= base_url('user/peraturan/delete/' . $item['id']); ?>"
                                method="post" class="inline"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus peraturan ini?');">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="text-red-600 hover:text-red-800 flex items-center" title="Hapus">
                                    <i class="fas fa-trash mr-1"></i> Hapus
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Mobile Pagination -->
            <?php if ($pager->getPageCount() > 1): ?>
                <div class="p-4">
                    <?= $pager->links('default', 'custom_pagination') ?>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="text-center py-8 text-gray-500">
                <i class="fas fa-inbox text-4xl mb-2 block"></i>
                Belum ada peraturan.
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>