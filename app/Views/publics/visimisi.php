<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="relative bg-gradient-to-br from-blue-300 via-blue-500 to-cyan-500 overflow-hidden pt-5 mb-12">
    <div class="absolute inset-0 bg-black/10"></div>

    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2 blur-2xl"></div>

    <div class="relative container mx-auto px-6 py-16 text-center">
        <div class="inline-block p-4 bg-white/10 backdrop-blur-sm rounded-2xl mb-6">
            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
            </svg>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">VISI DAN MISI</h1>
        <div class="w-24 h-1 bg-white mx-auto rounded-full"></div>
    </div>
</div>

<div class="container mx-auto px-6 pt-12 pb-40">
    <div class="container mx-auto px-6 -mt-6 relative z-10">
        <div class="prose max-w-none text-justify text-gray-800">
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