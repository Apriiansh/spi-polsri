<?= $this->extend('layout/user_main') ?>
<?= $this->section('content') ?>

<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800"><?= esc($title) ?></h1>
        <a href="<?= base_url('user/artikel/create') ?>" class="btn btn-primary flex items-center space-x-2">
            <i class="fas fa-plus"></i>
            <span>Tulis Artikel</span>
        </a>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- Desktop Table -->
    <div class="hidden lg:block bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="p-4 bg-gray-50 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-700">Daftar Artikel Saya</h2>
        </div>
        <div class="p-4 overflow-x-auto">
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
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                                        <?php if ($item['status'] == 'pending'): ?>
                                            bg-yellow-100 text-yellow-800
                                        <?php elseif ($item['status'] == 'verified'): ?>
                                            bg-green-100 text-green-800
                                        <?php else: ?>
                                            bg-red-100 text-red-800
                                        <?php endif; ?>
                                    ">
                                        <?= ucfirst($item['status']); ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-sm text-gray-700"><?= esc(date('d M Y', strtotime($item['created_at']))); ?></td>
                                <td class="py-3 px-4 text-sm text-gray-700 flex items-center space-x-3">
                                    <a href="<?= base_url('user/artikel/show/' . $item['id']); ?>" class="text-green-600 hover:text-green-800"><i class="fas fa-eye"></i></a>
                                    <?php if ($item['status'] == 'pending'): ?>
                                        <a href="<?= base_url('user/artikel/edit/' . $item['id']); ?>" class="text-blue-600 hover:text-blue-800"><i class="fas fa-edit"></i></a>
                                        <form action="<?= base_url('user/artikel/delete/' . $item['id']); ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
                                            <?= csrf_field(); ?>
                                            <button type="submit" class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
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

    <!-- Mobile Card View -->
    <div class="grid grid-cols-1 gap-4 lg:hidden">
        <?php if (!empty($articles)) : ?>
            <?php foreach ($articles as $item) : ?>
                <div class="bg-white shadow-md rounded-lg p-4 space-y-2">
                    <div class="flex justify-between items-center">
                        <h3 class="text-base font-semibold text-gray-800"><?= esc($item['title']); ?></h3>
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            <?php if ($item['status'] == 'pending'): ?>
                                bg-yellow-100 text-yellow-800
                            <?php elseif ($item['status'] == 'verified'): ?>
                                bg-green-100 text-green-800
                            <?php else: ?>
                                bg-red-100 text-red-800
                            <?php endif; ?>
                        ">
                            <?= ucfirst($item['status']); ?>
                        </span>
                    </div>
                    <p class="text-sm text-gray-600"><span class="font-medium">Tanggal:</span> <?= esc(date('d M Y', strtotime($item['created_at']))); ?></p>
                    <div class="flex space-x-3 pt-2">
                        <a href="<?= base_url('user/artikel/show/' . $item['id']); ?>" class="text-green-600 hover:text-green-800"><i class="fas fa-eye"></i></a>
                        <?php if ($item['status'] == 'pending'): ?>
                            <a href="<?= base_url('user/artikel/edit/' . $item['id']); ?>" class="text-blue-600 hover:text-blue-800"><i class="fas fa-edit"></i></a>
                            <form action="<?= base_url('user/artikel/delete/' . $item['id']); ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus artikel ini?');">
                                <?= csrf_field(); ?>
                                <button type="submit" class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="text-center text-gray-500">Belum ada artikel.</div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>