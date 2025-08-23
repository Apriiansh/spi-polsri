<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="text-center">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">Halaman <?= $title ?></h1>
    <p class="text-lg text-gray-600">Konten akan ditambahkan di sini.</p>
</div>
<?= $this->endSection() ?>