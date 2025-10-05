<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<h1 class="text-3xl font-bold mb-4">Daftar Laporan</h1>
<table class="min-w-full bg-white rounded-md shadow-md">
    <thead>
        <tr>
            <th class="py-2 px-4 border-b text-left">ID</th>
            <th class="py-2 px-4 border-b text-left">Judul</th>
            <th class="py-2 px-4 border-b text-left">Klasifikasi</th>
            <th class="py-2 px-4 border-b text-left">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($laporan as $l): ?>
            <tr class="hover:bg-gray-50">
                <td class="py-2 px-4 border-b"><?= $l['id'] ?></td>
                <td class="py-2 px-4 border-b"><?= $l['judul'] ?></td>
                <td class="py-2 px-4 border-b"><?= $l['klasifikasi_laporan'] ?></td>
                <td class="py-2 px-4 border-b"><?= $l['status_laporan'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>