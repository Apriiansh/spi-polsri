<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>
<div class="container mx-auto px-6 py-12">
    <div class="max-w-4xl mx-auto text-gray-800 leading-relaxed">
        <h1 class="text-4xl font-bold text-center mb-6">Visi dan Misi</h1>

        <div class="prose max-w-none text-justify">
            <h2 class="text-3xl font-bold mb-4">Visi SPI</h2>
            <p class="mb-4">
                SPI Politeknik Negeri Sriwijaya sebagai auditor internal yang profesional dan independen dalam melaksanakan tugas, fungsi, dan tanggung jawab dalam penguatan tata kelola, akuntabilitas, dan citra publik pendidikan untuk mewujudkan <b>Good Governance</b> atas penyelenggaraan kegiatan Politeknik Negeri Sriwijaya.
            </p>

            <h2 class="text-3xl font-bold mb-4">Misi SPI</h2>
            <ul class="list-disc list-inside mb-4 pl-4">
                <li>Membantu pimpinan Politeknik Negeri Sriwijaya untuk mengidentifikasi, meminimalkan, dan berupaya semaksimal mungkin mengurangi terjadinya risiko atas penyelenggaraan kegiatan Polsri.</li>
                <li>Sebagai mitra kerja di berbagai tingkat manajemen dan melakukan fasilitas serta bimbingan dalam mengelola berbagai kegiatan yang dinilai berpotensi menimbulkan masalah, dan membantu mengatasi berbagai masalah yang dihadapi.</li>
                <li>Bersama-sama dengan pimpinan Politeknik Negeri Sriwijaya turut serta mengantarkan dan menjaga lembaga Polsri pada kondisi akuntabel.</li>
            </ul>
        </div>
    </div>
</div>
<?= $this->endSection() ?>