<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<!-- Header Section -->
<div class="relative bg-gradient-to-br from-blue-300 via-blue-500 to-cyan-500 overflow-hidden pt-5 mb-12">
    <div class="absolute inset-0 bg-black/10"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2 blur-2xl"></div>
    <div class="relative container mx-auto px-6 py-16 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600/80 rounded-full mb-6 shadow-lg">
            <i class="fas fa-sitemap text-white text-4xl"></i>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 drop-shadow-lg">Struktur Organisasi SPI</h1>
        <div class="w-24 h-1 bg-white mx-auto rounded-full"></div>
    </div>
</div>

<!-- Main Content Section -->
<div class="px-4 py-8 mb-12">
    <h2 class="text-2xl md:text-3xl font-semibold text-center text-blue-700 mb-12">Bagan Struktur Organisasi SPI<br />Politeknik Negeri Sriwijaya</h2>

    <!-- Organizational Chart Image -->
    <div class="container mx-auto flex justify-center">
        <img src="<?= base_url('images/profil/strorg.png') ?>" alt="Struktur Organisasi SPI Politeknik Negeri Sriwijaya" class="w-full max-w-7xl h-auto rounded-lg shadow-lg">
    </div>
</div>

<!-- Detail Section -->
<div class="px-4 py-8 mb-12">
    <h2 class="text-3xl font-bold text-center text-blue-700 mb-12">Profil Anggota SPI</h2>
    <div class="container mx-auto max-w-4xl flex flex-col divide-y divide-gray-200">

        <!-- Kepala SPI Detail -->
        <div id="detail-kepala-spi" class="flex flex-col md:flex-row items-center gap-8 py-10">
            <div class="flex-shrink-0">
                <img src="<?= base_url('images/profil/edw.jpg') ?>" alt="Kepala SPI" class="w-30 h-40 rounded-lg object-cover shadow-md" onerror="this.src='<?= base_url('images/profil/placeholder.jpg') ?>'">
            </div>
            <div class="text-center md:text-left">
                <h3 class="text-xl font-bold text-blue-700">Kepala SPI</h3>
                <h4 class="text-2xl font-semibold text-gray-800 mt-1">Edwin Frymaruwah, S.E., M.Ak.</h4>
                <div class="w-16 h-1 bg-blue-500 my-3 mx-auto md:mx-0"></div>
                <p class="text-gray-600">Bertanggung jawab atas koordinasi Satuan Pengawasan Internal dengan pengalaman audit dan pengawasan selama 15 tahun. Lulusan S2 Akuntansi dan memiliki sertifikasi auditor profesional.</p>
            </div>
        </div>

        <!-- Sekretaris Detail -->
        <div id="detail-sekretaris" class="flex flex-col md:flex-row items-center gap-8 py-10">
            <div class="flex-shrink-0">
                <img src="<?= base_url('images/profil/sr.jpg') ?>" alt="Sekretaris" class="w-30 h-40 rounded-lg object-cover shadow-md" onerror="this.src='<?= base_url('images/profil/placeholder.jpg') ?>'">
            </div>
            <div class="text-center md:text-left">
                <h3 class="text-xl font-bold text-blue-700">Sekretaris</h3>
                <h4 class="text-2xl font-semibold text-gray-800 mt-1">Sulastriani, M.Si.</h4>
                <div class="w-16 h-1 bg-blue-500 my-3 mx-auto md:mx-0"></div>
                <p class="text-gray-600">Mengelola administrasi dan koordinasi SPI dengan pengalaman administrasi lebih dari 10 tahun. Lulusan S1 Administrasi Publik dengan kemampuan manajemen dokumen yang excellent.</p>
            </div>
        </div>

        <!-- Bidang Akuntansi Detail -->
        <div id="detail-bidang-akuntansi" class="flex flex-col md:flex-row items-center gap-8 py-10">
            <div class="flex-shrink-0">
                <img src="<?= base_url('images/profil/tr.jpg') ?>" alt="Bidang Akuntansi" class="w-30 h-40 rounded-lg object-cover shadow-md" onerror="this.src='<?= base_url('images/profil/placeholder.jpg') ?>'">
            </div>
            <div class="text-center md:text-left">
                <h3 class="text-xl font-bold text-blue-700">Bidang Akuntansi/Keuangan</h3>
                <h4 class="text-2xl font-semibold text-gray-800 mt-1">Tiara Nurpratiwi, S.E., M.Si.</h4>
                <div class="w-16 h-1 bg-blue-500 my-3 mx-auto md:mx-0"></div>
                <p class="text-gray-600">Memimpin audit keuangan dan akuntansi dengan pengalaman 12 tahun. Lulusan S2 Akuntansi dan bersertifikat CPA. Ahli dalam audit laporan keuangan dan sistem akuntansi.</p>
            </div>
        </div>

        <!-- Bidang SDM Detail -->
        <div id="detail-bidang-sdm" class="flex flex-col md:flex-row items-center gap-8 py-10">
            <div class="flex-shrink-0">
                <img src="<?= base_url('images/profil/ds.jpg') ?>" alt="Bidang SDM" class="w-30 h-40 rounded-lg object-cover shadow-md" onerror="this.src='<?= base_url('images/profil/placeholder.jpg') ?>'">
            </div>
            <div class="text-center md:text-left">
                <h3 class="text-xl font-bold text-blue-700">Bidang Manajemen SDM</h3>
                <h4 class="text-2xl font-semibold text-gray-800 mt-1">Desri Yanto, S.E., M.Si.</h4>
                <div class="w-16 h-1 bg-blue-500 my-3 mx-auto md:mx-0"></div>
                <p class="text-gray-600">Bertanggung jawab atas audit SDM dengan pengalaman 10 tahun di manajemen SDM. Lulusan S2 Manajemen SDM dengan spesialisasi dalam pengembangan organisasi.</p>
            </div>
        </div>

        <!-- Bidang Hukum Detail -->
        <div id="detail-bidang-hukum" class="flex flex-col md:flex-row items-center gap-8 py-10">
            <div class="flex-shrink-0">
                <img src="<?= base_url('images/profil/yl.jpg') ?>" alt="Bidang Hukum" class="w-30 h-40 rounded-lg object-cover shadow-md" onerror="this.src='<?= base_url('images/profil/placeholder.jpg') ?>'">
            </div>
            <div class="text-center md:text-left">
                <h3 class="text-xl font-bold text-blue-700">Bidang Hukum</h3>
                <h4 class="text-2xl font-semibold text-gray-800 mt-1">Dr. Yuli Asmara Triputra, S.H., M.Hum.</h4>
                <div class="w-16 h-1 bg-blue-500 my-3 mx-auto md:mx-0"></div>
                <p class="text-gray-600">Menangani aspek hukum dan compliance dengan pengalaman praktik hukum 13 tahun. Lulusan S2 Hukum dengan spesialisasi hukum administrasi negara dan tata kelola.</p>
            </div>
        </div>

        <!-- Bidang Aset Detail -->
        <div id="detail-bidang-aset" class="flex flex-col md:flex-row items-center gap-8 py-10">
            <div class="flex-shrink-0">
                <img src="<?= base_url('images/profil/rd.jpg') ?>" alt="Bidang Aset" class="w-30 h-40 rounded-lg object-cover shadow-md" onerror="this.src='<?= base_url('images/profil/placeholder.jpg') ?>'">
            </div>
            <div class="text-center md:text-left">
                <h3 class="text-xl font-bold text-blue-700">Bidang Manajemen Aset</h3>
                <h4 class="text-2xl font-semibold text-gray-800 mt-1">Radius Pranoto, S.T.P. M.Si.</h4>
                <div class="w-16 h-1 bg-blue-500 my-3 mx-auto md:mx-0"></div>
                <p class="text-gray-600">Mengelola audit aset dan inventaris dengan pengalaman 11 tahun. Lulusan S2 Manajemen dengan fokus pada manajemen aset dan pengadaan barang/jasa.</p>
            </div>
        </div>

        <!-- Bidang Ketatalaksanaan Detail -->
        <div id="detail-bidang-tata" class="flex flex-col md:flex-row items-center gap-8 py-10">
            <div class="flex-shrink-0">
                <img src="<?= base_url('images/profil/kr.jpg') ?>" alt="Bidang Tata" class="w-30 h-40 rounded-lg object-cover shadow-md" onerror="this.src='<?= base_url('images/profil/placeholder.jpg') ?>'">
            </div>
            <div class="text-center md:text-left">
                <h3 class="text-xl font-bold text-blue-700">Bidang Ketatalaksanaan</h3>
                <h4 class="text-2xl font-semibold text-gray-800 mt-1">Kurnia Widya Oktarini, S.E., M.Si.</h4>
                <div class="w-16 h-1 bg-blue-500 my-3 mx-auto md:mx-0"></div>
                <p class="text-gray-600">Lulusan dari Akuntansi Universitas Sriwijaya yang mengajar di Jurusan Akuntansi Polsri. Ia aktif dalam publikasi ilmiah sebagai Managing Editor Jurnal Pengabdian Masyarakat Akuntansi, Bisnis dan Ekonomi, dan sejak 2023 memimpin Tax Center Politeknik Negeri Sriwijaya. Saat ini, ia bertanggung jawab di bidang ketatalaksanaan pada Satuan Pengawas Internal (SPI), mendukung tata kelola institusi yang akuntabel dan transparan.
                </p>
            </div>
        </div>

        <!-- Staf Administrasi Detail -->
        <!-- <div id="detail-staf-admin" class="flex flex-col md:flex-row items-center gap-8 py-10">
            <div class="flex-shrink-0">
                <img src="<?= base_url('images/profil/placeholder.jpg') ?>" alt="Staf Administrasi" class="w-40 h-40 rounded-lg object-cover shadow-md" onerror="this.src='<?= base_url('images/profil/placeholder.jpg') ?>'">
            </div>
            <div class="text-center md:text-left">
                <h3 class="text-xl font-bold text-blue-700">Staf Administrasi</h3>
                <h4 class="text-2xl font-semibold text-gray-800 mt-1">[Nama Staf]</h4>
                <div class="w-16 h-1 bg-blue-500 my-3 mx-auto md:mx-0"></div>
                <p class="text-gray-600">Memberikan dukungan administrasi untuk seluruh kegiatan SPI dengan pengalaman 7 tahun. Lulusan S1 Administrasi dengan kemampuan dokumentasi dan pengarsipan yang baik.</p>
            </div>
        </div> -->
    </div>
</div>

<style>
    .h-30 {
        height: 7.5rem;
        /* 120px */
    }

    .profil-card-small {
        position: relative;
        background: white;
        border-radius: 0.75rem;
        padding: 1rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid #e5e7eb;
        width: 100%;
        max-width: 180px;
    }

    .profil-card-small:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        border-color: #3b82f6;
    }

    .profil-photo-wrapper {
        width: 96px;
        height: 96px;
        border-radius: 50%;
        overflow: hidden;
        border-width: 4px;
        margin: 0 auto 1rem;
        background: #f3f4f6;
    }

    .profil-photo-wrapper-square {
        width: 96px;
        height: 96px;
        border-radius: 0.5rem;
        overflow: hidden;
        border-width: 4px;
        margin: 0 auto 1rem;
        background: #f3f4f6;
    }

    .profil-photo-wrapper-small {
        width: 64px;
        height: 64px;
        border-radius: 50%;
        overflow: hidden;
        border-width: 3px;
        margin: 0 auto 0.75rem;
        background: #f3f4f6;
    }

    .profil-photo-wrapper-small-square {
        width: 64px;
        height: 64px;
        border-radius: 0.375rem;
        overflow: hidden;
        border-width: 3px;
        margin: 0 auto 0.75rem;
        background: #f3f4f6;
    }

    .profil-photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .profil-content {
        text-align: center;
    }

    .profil-content-small {
        text-align: center;
        min-height: 70px;
    }

    .profil-title {
        font-weight: 700;
        font-size: 1.125rem;
        color: #1e40af;
        margin-bottom: 0.25rem;
    }

    .profil-title-small {
        font-weight: 600;
        font-size: 0.75rem;
        color: #1e40af;
        margin-bottom: 0.25rem;
        line-height: 1.2;
    }

    .profil-name {
        font-weight: 600;
        font-size: 0.95rem;
        color: #374151;
        margin-bottom: 0.25rem;
    }

    .profil-name-small {
        font-weight: 500;
        font-size: 0.7rem;
        color: #6b7280;
        line-height: 1.2;
    }

    .profil-subtitle {
        font-size: 0.75rem;
        color: #9ca3af;
    }

    .profil-info-btn {
        position: absolute;
        top: 0.75rem;
        right: 0.75rem;
        color: #3b82f6;
        background: #eff6ff;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .profil-info-btn:hover {
        background: #3b82f6;
        color: white;
    }

    .profil-info-btn-small {
        position: absolute;
        top: 0.5rem;
        right: 0.5rem;
        color: #3b82f6;
        background: #eff6ff;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.75rem;
        transition: all 0.3s ease;
    }

    .profil-info-btn-small:hover {
        background: #3b82f6;
        color: white;
    }

    /* Connectors */
    .profil-line-vertical {
        width: 2px;
        height: 40px;
        background: linear-gradient(to bottom, #93c5fd, #3b82f6);
    }

    .profil-line-vertical-short {
        width: 2px;
        height: 30px;
        background: linear-gradient(to bottom, #93c5fd, #3b82f6);
        margin: 0 auto;
    }

    .profil-line-horizontal {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(to right, #93c5fd, #3b82f6, #93c5fd);
    }

    .profile-photo {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Animations */
    @keyframes pulse {

        0%,
        100% {
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
        }

        50% {
            box-shadow: 0 0 0 8px rgba(59, 130, 246, 0.1);
        }
    }

    /* Responsive adjustments */
    @media (max-width: 1024px) {
        .profil-card-small {
            max-width: 150px;
            padding: 0.75rem;
        }
    }

    @media (max-width: 640px) {
        /* You can add mobile-specific styles here if needed */
    }
</style>

<script>
    function scrollToDetail(id) {
        const element = document.getElementById('detail-' + id);
        if (element) {
            // Add highlight to target card
            element.classList.add('highlight');

            // Smooth scroll to element
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });

            // Remove highlight after animation
            setTimeout(() => {
                element.classList.remove('highlight');
            }, 3000);
        }
    }
</script>

<?= $this->endSection() ?>