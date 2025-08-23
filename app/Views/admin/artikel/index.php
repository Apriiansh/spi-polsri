<?= $this->extend('layout/admin_main') ?>

<?= $this->section('content'); ?>
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Artikel</h1>
    </div>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success'); ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('errors')): ?>
        <div class="alert alert-danger">
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <?= $error ?><br>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="p-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-700">Daftar Artikel</h2>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto">
                <table class="w-full text-left table-auto">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200">
                            <th class="py-3 px-4 font-semibold text-gray-600">ID</th>
                            <th class="py-3 px-4 font-semibold text-gray-600">Judul</th>
                            <th class="py-3 px-4 font-semibold text-gray-600">Penulis</th>
                            <th class="py-3 px-4 font-semibold text-gray-600">Tanggal Dibuat</th>
                            <th class="py-3 px-4 font-semibold text-gray-600">Status</th>
                            <th class="py-3 px-4 font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articles as $article): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                <td class="py-3 px-4 text-sm text-gray-700"><?= esc($article['id']) ?></td>
                                <td class="py-3 px-4 text-sm text-gray-700"><?= esc($article['title']) ?></td>
                                <td class="py-3 px-4 text-sm text-gray-700"><?= esc($article['user_id']) ?></td>
                                <td class="py-3 px-4 text-sm text-gray-700"><?= esc(date('d M Y H:i', strtotime($article['created_at']))) ?></td>
                                <td class="py-3 px-4 text-sm text-gray-700">
                                    <?php
                                    $statusClass = '';
                                    switch ($article['status']) {
                                        case 'pending':
                                            $statusClass = 'bg-yellow-400 text-yellow-800';
                                            break;
                                        case 'verified':
                                            $statusClass = 'bg-green-400 text-green-800';
                                            break;
                                        case 'rejected':
                                            $statusClass = 'bg-red-400 text-red-800';
                                            break;
                                    }
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $statusClass ?>"><?= esc(ucfirst($article['status'])) ?></span>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-700 flex items-center space-x-2">

                                    <form action="<?= base_url('admin/artikel/update-status/' . $article['id']) ?>" method="post" class="inline-flex items-center">
                                        <?= csrf_field(); ?>
                                        <select name="status" onchange="this.form.submit()" class="ml-2 form-select text-sm p-1.5 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            <option value="pending" <?= ($article['status'] == 'pending') ? 'selected' : '' ?>>Pending</option>
                                            <option value="verified" <?= ($article['status'] == 'verified') ? 'selected' : '' ?>>Terverifikasi</option>
                                            <option value="rejected" <?= ($article['status'] == 'rejected') ? 'selected' : '' ?>>Ditolak</option>
                                        </select>
                                    </form>

                                    <a href="<?= base_url('admin/artikel/show/' . $article['id']); ?>" class="text-blue-600 hover:text-blue-800">Lihat</a>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>