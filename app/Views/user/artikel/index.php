<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="container mx-auto max-w-3xl p-6 pb-16">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800"><?= esc($title) ?></h1>
        <a href="<?= base_url('user/artikel/create') ?>" class="btn btn-primary">Tulis Artikel</a>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <table class="w-full text-left table-auto">
            <thead>
                <tr class="bg-gray-100 border-b border-gray-200">
                    <th class="py-3 px-4 font-semibold text-gray-600">Judul</th>
                    <th class="py-3 px-4 font-semibold text-gray-600">Status</th>
                    <th class="py-3 px-4 font-semibold text-gray-600">Tanggal</th>
                    <th class="py-3 px-4 font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($articles)) : ?>
                    <?php foreach ($articles as $item) : ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-4 text-sm text-gray-700"><?= esc($item['title']); ?></td>
                            <td class="py-3 px-4 text-sm text-gray-700">
                                <?php if ($item['status'] == 'pending'): ?>
                                    <span class="badge bg-warning text-yellow-700">Pending</span>
                                <?php elseif ($item['status'] == 'verified'): ?>
                                    <span class="badge bg-success text-green-700">Terverifikasi</span>
                                <?php else: ?>
                                    <span class="badge bg-danger text-red-700">Ditolak</span>
                                <?php endif; ?>
                            </td>
                            <td class="py-3 px-4 text-sm text-gray-700"><?= esc(date('d M Y', strtotime($item['created_at']))); ?></td>
                            <td class="py-3 px-4 text-sm text-gray-700 flex items-center space-x-2">
                                <a href="<?= base_url('user/artikel/show/' . $item['id']); ?>" class="text-green-600 hover:text-green-800">Lihat</a>
                                <?php if ($item['status'] == 'pending'): ?>
                                    <a href="<?= base_url('user/artikel/edit/' . $item['id']); ?>" class="text-blue-600 hover:text-blue-800">Edit</a>
                                    <form action="<?= base_url('user/artikel/delete/' . $item['id']); ?>" method="post" style="display:inline"
                                        onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
                                        <?= csrf_field(); ?>
                                        <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="4" class="py-3 px-4 text-center text-gray-500">Belum ada artikel.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>