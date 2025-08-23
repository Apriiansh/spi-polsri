<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content'); ?>
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800"><?= esc($title); ?></h1>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('error'); ?>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="p-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-700">Daftar Laporan</h2>
        </div>
        <div class="p-4 overflow-x-auto">
            <table class="w-full text-left table-auto">
                <thead>
                    <tr class="bg-gray-100 border-b border-gray-200">
                        <th class="py-3 px-4 font-semibold text-gray-600">No</th>
                        <th class="py-3 px-4 font-semibold text-gray-600">Judul</th>
                        <th class="py-3 px-4 font-semibold text-gray-600">Kategori</th>
                        <th class="py-3 px-4 font-semibold text-gray-600">Tanggal Kejadian</th>
                        <th class="py-3 px-4 font-semibold text-gray-600">Status</th>
                        <th class="py-3 px-4 font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 + (10 * ($pager->getCurrentPage() - 1)); ?>
                    <?php if (!empty($laporan)): ?>
                        <?php foreach ($laporan as $item): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 text-sm text-gray-700"><?= $i++; ?></td>
                                <td class="py-3 px-4 text-sm text-gray-700"><?= esc($item['judul']); ?></td>
                                <td class="py-3 px-4 text-sm text-gray-700"><?= esc($item['kategori_laporan']); ?></td>
                                <td class="py-3 px-4 text-sm text-gray-700"><?= esc(date('d M Y', strtotime($item['tgl_kejadian']))); ?></td>
                                <td class="py-3 px-4 text-sm text-gray-700">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold 
                                        <?php if ($item['status_laporan'] == 'pending'): ?>
                                            bg-yellow-100 text-yellow-800
                                        <?php elseif ($item['status_laporan'] == 'in_progress'): ?>
                                            bg-blue-100 text-blue-800
                                        <?php elseif ($item['status_laporan'] == 'completed'): ?>
                                            bg-green-100 text-green-800
                                        <?php endif; ?>
                                    ">
                                        <?= esc(ucfirst($item['status_laporan'])); ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-700 flex items-center space-x-2">
                                    <a href="<?= base_url('admin/laporan/show/' . $item['id']); ?>" class="text-blue-600 hover:text-blue-800">Detail</a>
                                    <form action="<?= base_url('admin/laporan/delete/' . $item['id']); ?>" method="post"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini?');">
                                        <?= csrf_field(); ?>
                                        <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="py-3 px-4 text-center text-gray-500">Tidak ada laporan yang ditemukan.</td>
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