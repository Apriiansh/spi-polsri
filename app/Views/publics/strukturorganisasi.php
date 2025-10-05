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
    <h2 class="text-2xl md:text-3xl font-semibold text-center text-blue-700 mb-12">Bagan Struktur Organisasi SPI<br/>Politeknik Negeri Sriwijaya</h2>
    
    <!-- Organizational Chart -->
    <div class="flex flex-col items-center">
        
        <!-- Level 1: Direktur -->
        <div class="mb-8">
            <div class="profil-card" onclick="scrollToDetail('direktur')">
                <div class="profil-photo-wrapper-square border-blue-400">
                    <img src="<?= base_url('assets/images/profil/direktur.jpg') ?>" alt="Direktur" class="profil-photo" onerror="this.src='<?= base_url('assets/images/profil/placeholder.jpg') ?>'">
                </div>
                <div class="profil-content">
                    <div class="profil-title">Direktur</div>
                    <div class="profil-name">Dr. Irawan Rusnadi, M.T.</div>
                </div>
                <button class="profil-info-btn">
                    <i class="fas fa-info-circle"></i>
                </button>
            </div>
        </div>

        <!-- Connector -->
        <div class="profil-line-vertical"></div>

        <!-- Level 2: Kepala SPI -->
        <div class="mb-8">
            <div class="profil-card" onclick="scrollToDetail('kepala-spi')">
                <div class="profil-photo-wrapper-square border-yellow-400">
                    <img src="<?= base_url('assets/images/profil/kepala-spi.jpg') ?>" alt="Kepala SPI" class="profil-photo" onerror="this.src='<?= base_url('assets/images/profil/placeholder.jpg') ?>'">
                </div>
                <div class="profil-content">
                    <div class="profil-title">Kepala SPI</div>
                    <div class="profil-name">Edwin Frymaruwah, S.E., M.Ak.</div>
                </div>
                <button class="profil-info-btn">
                    <i class="fas fa-info-circle"></i>
                </button>
            </div>
        </div>

        <!-- Connector dengan cabang ke Sekretaris -->
        <div class="relative w-full flex justify-center mb-8">
            <!-- Garis vertical dari Kepala SPI -->
            <div class="profil-line-vertical"></div>
        </div>

        <!-- Level 3: Sekretaris dan Bidang-bidang dalam satu baris -->
        <div class="relative w-full max-w-6xl mb-8">
            <div class="flex flex-col lg:flex-row items-start justify-center gap-8 lg:gap-12">
                <!-- Sekretaris -->
                <div class="flex flex-col items-center">
                    <div class="profil-card" onclick="scrollToDetail('sekretaris')">
                        <div class="profil-photo-wrapper-square border-teal-400">
                            <img src="<?= base_url('assets/images/profil/sekretaris.jpg') ?>" alt="Sekretaris" class="profil-photo" onerror="this.src='<?= base_url('assets/images/profil/placeholder.jpg') ?>'">
                        </div>
                        <div class="profil-content">
                            <div class="profil-title">Sekretaris</div>
                            <div class="profil-name">Sulastriani, M.Si.</div>
                            <div class="profil-subtitle">Administrasi</div>
                        </div>
                        <button class="profil-info-btn">
                            <i class="fas fa-info-circle"></i>
                        </button>
                    </div>
                </div>

                <!-- Bidang-bidang Section -->
                <div class="flex-1">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 justify-items-center">
                        <!-- Bidang Akuntansi/Keuangan -->
                        <div class="flex flex-col items-center">
                            <div class="profil-card-small" onclick="scrollToDetail('bidang-akuntansi')">
                                <div class="profil-photo-wrapper-small-square border-orange-400">
                                    <img src="<?= base_url('assets/images/profil/bidang-akuntansi.jpg') ?>" alt="Bidang Akuntansi" class="profil-photo" onerror="this.src='<?= base_url('assets/images/profil/placeholder.jpg') ?>'">
                                </div>
                                <div class="profil-content-small">
                                    <div class="profil-title-small">Bidang Akuntansi/Keuangan</div>
                                    <div class="profil-name-small">Tiara Nurpratiwi, S.E., M.Si.</div>
                                </div>
                                <button class="profil-info-btn-small">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Bidang Manajemen SDM -->
                        <div class="flex flex-col items-center">
                            <div class="profil-card-small" onclick="scrollToDetail('bidang-sdm')">
                                <div class="profil-photo-wrapper-small-square border-emerald-400">
                                    <img src="<?= base_url('assets/images/profil/bidang-sdm.jpg') ?>" alt="Bidang SDM" class="profil-photo" onerror="this.src='<?= base_url('assets/images/profil/placeholder.jpg') ?>'">
                                </div>
                                <div class="profil-content-small">
                                    <div class="profil-title-small">Bidang Manajemen SDM</div>
                                    <div class="profil-name-small">Desri Yanto, S.E., M.Si.</div>
                                </div>
                                <button class="profil-info-btn-small">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Bidang Hukum -->
                        <div class="flex flex-col items-center">
                            <div class="profil-card-small" onclick="scrollToDetail('bidang-hukum')">
                                <div class="profil-photo-wrapper-small-square border-red-400">
                                    <img src="<?= base_url('assets/images/profil/bidang-hukum.jpg') ?>" alt="Bidang Hukum" class="profil-photo" onerror="this.src='<?= base_url('assets/images/profil/placeholder.jpg') ?>'">
                                </div>
                                <div class="profil-content-small">
                                    <div class="profil-title-small">Bidang Hukum</div>
                                    <div class="profil-name-small">Dr. Yuli Asmara Tri Putra, S.H., M.Hum.</div>
                                </div>
                                <button class="profil-info-btn-small">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Bidang Manajemen Aset -->
                        <div class="flex flex-col items-center">
                            <div class="profil-card-small" onclick="scrollToDetail('bidang-aset')">
                                <div class="profil-photo-wrapper-small-square border-purple-400">
                                    <img src="<?= base_url('assets/images/profil/bidang-aset.jpg') ?>" alt="Bidang Aset" class="profil-photo" onerror="this.src='<?= base_url('assets/images/profil/placeholder.jpg') ?>'">
                                </div>
                                <div class="profil-content-small">
                                    <div class="profil-title-small">Bidang Manajemen Aset</div>
                                    <div class="profil-name-small">[Nama Kepala Bidang]</div>
                                </div>
                                <button class="profil-info-btn-small">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Bidang Ketatalaksanaan -->
                        <div class="flex flex-col items-center">
                            <div class="profil-card-small" onclick="scrollToDetail('bidang-tata')">
                                <div class="profil-photo-wrapper-small-square border-indigo-400">
                                    <img src="<?= base_url('assets/images/profil/bidang-tata.jpg') ?>" alt="Bidang Tata" class="profil-photo" onerror="this.src='<?= base_url('assets/images/profil/placeholder.jpg') ?>'">
                                </div>
                                <div class="profil-content-small">
                                    <div class="profil-title-small">Bidang Ketatalaksanaan</div>
                                    <div class="profil-name-small">Kurnia Widya Oktarini, S.E., M.Si.</div>
                                </div>
                                <button class="profil-info-btn-small">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Connector to Staf -->
        <div class="profil-line-vertical mt-8"></div>

        <!-- Level 4: Staf Administrasi -->
        <div class="mt-8">
            <div class="profil-card" onclick="scrollToDetail('staf-admin')">
                <div class="profil-photo-wrapper-square border-gray-400">
                    <img src="<?= base_url('assets/images/profil/staf-admin.jpg') ?>" alt="Staf Administrasi" class="profil-photo" onerror="this.src='<?= base_url('assets/images/profil/placeholder.jpg') ?>'">
                </div>
                <div class="profil-content">
                    <div class="profil-title">Staf Administrasi</div>
                    <div class="profil-name">[Nama Staf]</div>
                    <div class="profil-subtitle">Support Staff</div>
                </div>
                <button class="profil-info-btn">
                    <i class="fas fa-info-circle"></i>
                </button>
            </div>
        </div>

    </div>
</div>

<!-- Detail Section -->
<div class="px-4 py-8 mb-12">
    <h2 class="text-3xl font-bold text-center text-blue-700 mb-8">Profil Anggota SPI</h2>
    <div class="flex flex-col gap-8">
        <!-- Direktur Detail -->
        <div id="detail-direktur" class="profile-card">
            <h3 class="profile-jabatan">Direktur</h3>
            <div class="profile-card-body">
                <div class="flex-shrink-0">
                    <div class="profile-photo-wrapper-square-large" style="width:180px; height:180px;">
                        <img src="<?= base_url('assets/images/profil/direktur.jpg') ?>" alt="Direktur" class="profile-photo" onerror="this.src='<?= base_url('assets/images/profil/placeholder.jpg') ?>'">
                    </div>
                </div>
                <div class="profile-content flex-1">
                    <h4 class="profile-nama">Dr. Irawan Rusnadi, M.T.</h4>
                    <div class="profile-divider"></div>
                    <p class="profile-bio">Memimpin Politeknik Negeri Sriwijaya dengan pengalaman lebih dari 20 tahun di bidang pendidikan tinggi. Meraih gelar Profesor dalam bidang [Bidang]. Aktif dalam berbagai organisasi profesional dan penelitian.</p>
                </div>
            </div>
        </div>

        <!-- Kepala SPI Detail -->
        <div id="detail-kepala-spi" class="profile-card">
            <h3 class="profile-jabatan">Kepala SPI</h3>
            <div class="profile-card-body">
                <div class="flex-shrink-0">
                    <div class="profile-photo-wrapper-square-large" style="width:180px; height:180px;">
                        <img src="<?= base_url('assets/images/profil/edw.jpg') ?>" alt="Kepala SPI" class="profile-photo" onerror="this.src='<?= base_url('assets/images/profil/placeholder.jpg') ?>'">
                    </div>
                </div>
                <div class="profile-content flex-1">
                    <h4 class="profile-nama">Edwin Frymaruwah, S.E., M.Ak.</h4>
                    <div class="profile-divider"></div>
                    <p class="profile-bio">Bertanggung jawab atas koordinasi Satuan Pengawasan Internal dengan pengalaman audit dan pengawasan selama 15 tahun. Lulusan S2 Akuntansi dan memiliki sertifikasi auditor profesional.</p>
                </div>
            </div>
        </div>

        <!-- Sekretaris Detail -->
        <div id="detail-sekretaris" class="profile-card">
            <h3 class="profile-jabatan">Sekretaris</h3>
            <div class="profile-card-body">
                <div class="flex-shrink-0">
                    <div class="profile-photo-wrapper-square-large" style="width:180px; height:180px;">
                        <img src="<?= base_url('assets/images/profil/sekretaris.jpg') ?>" alt="Sekretaris" class="profile-photo" onerror="this.src='<?= base_url('assets/images/profil/placeholder.jpg') ?>'">
                    </div>
                </div>
                <div class="profile-content flex-1">
                    <h4 class="profile-nama">Sulastriani, M.Si.</h4>
                    <div class="profile-divider"></div>
                    <p class="profile-bio">Mengelola administrasi dan koordinasi SPI dengan pengalaman administrasi lebih dari 10 tahun. Lulusan S1 Administrasi Publik dengan kemampuan manajemen dokumen yang excellent.</p>
                </div>
            </div>
        </div>

        <!-- Bidang Akuntansi Detail -->
        <div id="detail-bidang-akuntansi" class="profile-card">
            <h3 class="profile-jabatan">Bidang Akuntansi/Keuangan</h3>
            <div class="profile-card-body">
                <div class="flex-shrink-0">
                    <div class="profile-photo-wrapper-square-large" style="width:180px; height:180px;">
                        <img src="<?= base_url('assets/images/profil/bidang-akuntansi.jpg') ?>" alt="Bidang Akuntansi" class="profile-photo" onerror="this.src='<?= base_url('assets/images/profil/placeholder.jpg') ?>'">
                    </div>
                </div>
                <div class="profile-content flex-1">
                    <h4 class="profile-nama">Tiara Nurpratiwi, S.E., M.Si.</h4>
                    <div class="profile-divider"></div>
                    <p class="profile-bio">Memimpin audit keuangan dan akuntansi dengan pengalaman 12 tahun. Lulusan S2 Akuntansi dan bersertifikat CPA. Ahli dalam audit laporan keuangan dan sistem akuntansi.</p>
                </div>
            </div>
        </div>

        <!-- Bidang SDM Detail -->
        <div id="detail-bidang-sdm" class="profile-card">
            <h3 class="profile-jabatan">Bidang Manajemen SDM</h3>
            <div class="profile-card-body">
                <div class="flex-shrink-0">
                    <div class="profile-photo-wrapper-square-large" style="width:180px; height:180px;">
                        <img src="<?= base_url('assets/images/profil/bidang-sdm.jpg') ?>" alt="Bidang SDM" class="profile-photo" onerror="this.src='<?= base_url('assets/images/profil/placeholder.jpg') ?>'">
                    </div>
                </div>
                <div class="profile-content flex-1">
                    <h4 class="profile-nama">Desri Yanto, S.E., M.Si.</h4>
                    <div class="profile-divider"></div>
                    <p class="profile-bio">Bertanggung jawab atas audit SDM dengan pengalaman 10 tahun di manajemen SDM. Lulusan S2 Manajemen SDM dengan spesialisasi dalam pengembangan organisasi.</p>
                </div>
            </div>
        </div>

        <!-- Bidang Hukum Detail -->
        <div id="detail-bidang-hukum" class="profile-card">
            <h3 class="profile-jabatan">Bidang Hukum</h3>
            <div class="profile-card-body">
                <div class="flex-shrink-0">
                    <div class="profile-photo-wrapper-square-large" style="width:180px; height:180px;">
                        <img src="<?= base_url('assets/images/profil/bidang-hukum.jpg') ?>" alt="Bidang Hukum" class="profile-photo" onerror="this.src='<?= base_url('assets/images/profil/placeholder.jpg') ?>'">
                    </div>
                </div>
                <div class="profile-content flex-1">
                    <h4 class="profile-nama">Dr. Yuli Asmara Tri Putra, S.H., M.Hum.</h4>
                    <div class="profile-divider"></div>
                    <p class="profile-bio">Menangani aspek hukum dan compliance dengan pengalaman praktik hukum 13 tahun. Lulusan S2 Hukum dengan spesialisasi hukum administrasi negara dan tata kelola.</p>
                </div>
            </div>
        </div>

        <!-- Bidang Aset Detail -->
        <div id="detail-bidang-aset" class="profile-card">
            <h3 class="profile-jabatan">Bidang Manajemen Aset</h3>
            <div class="profile-card-body">
                <div class="flex-shrink-0">
                    <div class="profile-photo-wrapper-square-large" style="width:180px; height:180px;">
                        <img src="<?= base_url('assets/images/profil/bidang-aset.jpg') ?>" alt="Bidang Aset" class="profile-photo" onerror="this.src='<?= base_url('assets/images/profil/placeholder.jpg') ?>'">
                    </div>
                </div>
                <div class="profile-content flex-1">
                    <h4 class="profile-nama">[Nama Kepala Bidang]</h4>
                    <div class="profile-divider"></div>
                    <p class="profile-bio">Mengelola audit aset dan inventaris dengan pengalaman 11 tahun. Lulusan S2 Manajemen dengan fokus pada manajemen aset dan pengadaan barang/jasa.</p>
                </div>
            </div>
        </div>

        <!-- Bidang Ketatalaksanaan Detail -->
        <div id="detail-bidang-tata" class="profile-card">
            <h3 class="profile-jabatan">Bidang Ketatalaksanaan</h3>
            <div class="profile-card-body">
                <div class="flex-shrink-0">
                    <div class="profile-photo-wrapper-square-large" style="width:180px; height:180px;">
                        <img src="<?= base_url('assets/images/profil/bidang-tata.jpg') ?>" alt="Bidang Tata" class="profile-photo" onerror="this.src='<?= base_url('assets/images/profil/placeholder.jpg') ?>'">
                    </div>
                </div>
                <div class="profile-content flex-1">
                    <h4 class="profile-nama">Kurnia Widya Oktarini, S.E., M.Si.</h4>
                    <div class="profile-divider"></div>
                    <p class="profile-bio">Mengawasi tata kelola dan prosedur operasional dengan pengalaman 9 tahun. Lulusan S2 Administrasi Publik dengan keahlian dalam reformasi birokrasi.</p>
                </div>
            </div>
        </div>

        <!-- Staf Administrasi Detail -->
        <div id="detail-staf-admin" class="profile-card">
            <h3 class="profile-jabatan">Staf Administrasi</h3>
            <div class="profile-card-body">
                <div class="flex-shrink-0">
                    <div class="profile-photo-wrapper-square-large" style="width:180px; height:180px;">
                        <img src="<?= base_url('assets/images/profil/staf-admin.jpg') ?>" alt="Staf Administrasi" class="profile-photo" onerror="this.src='<?= base_url('assets/images/profil/placeholder.jpg') ?>'">
                    </div>
                </div>
                <div class="profile-content flex-1">
                    <h4 class="profile-nama">[Nama Staf]</h4>
                    <div class="profile-divider"></div>
                    <p class="profile-bio">Memberikan dukungan administrasi untuk seluruh kegiatan SPI dengan pengalaman 7 tahun. Lulusan S1 Administrasi dengan kemampuan dokumentasi dan pengarsipan yang baik.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Organizational Chart Styles */
.profil-card {
    position: relative;
    background: white;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    cursor: pointer;
    transition: all 0.3s ease;
    max-width: 280px;
    border: 2px solid #e5e7eb;
}

.profil-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    border-color: #3b82f6;
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

/* Profile Card Styles */
.profile-card {
    background: white;
    border-radius: 1rem;
    overflow: hidden;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    transition: all 0.3s ease;
    border: 2px solid #e5e7eb;
}

.profile-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    border-color: #3b82f6;
}

.profile-card.highlight {
    border-color: #3b82f6;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
    animation: pulse 2s ease-in-out;
}

.profile-card-body {
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 2rem;
    padding: 1.5rem;
}

.profile-photo-wrapper {
    width: 100%;
    height: 250px;
    overflow: hidden;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.profile-photo-wrapper-square-large {
    border-radius: 0.5rem;
    overflow: hidden;
    background: #f3f4f6;
}

.profile-photo {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.profile-content {
    /* padding is now on profile-card-body */
}

.profile-jabatan {
    font-size: 1.125rem;
    font-weight: 700;
    color: white;
    background: linear-gradient(to right, #3b82f6, #60a5fa);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    text-align: center;
    padding: 0.75rem 1.5rem;
}

.profile-nama {
    font-size: 1.25rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 1rem;
}

.profile-divider {
    width: 50px;
    height: 3px;
    background: linear-gradient(to right, #3b82f6, #8b5cf6);
    margin-bottom: 1rem;
    border-radius: 2px;
}

.profile-bio {
    font-size: 0.95rem;
    line-height: 1.6;
    color: #64748b;
}

/* Animations */
@keyframes pulse {
    0%, 100% {
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.2);
    }
    50% {
        box-shadow: 0 0 0 8px rgba(59, 130, 246, 0.1);
    }
}

/* Responsive adjustments */
@media (max-width: 1024px) {
    .profil-line-horizontal {
        display: none;
    }
}

@media (max-width: 640px) {
    .profil-card {
        max-width: 240px;
        padding: 1.25rem;
    }
    
    .profil-card-small {
        max-width: 150px;
        padding: 0.75rem;
    }
    
    .profile-photo-wrapper {
        height: 200px;
    }
    
    .profile-card-body {
        flex-direction: column;
        text-align: center;
    }
}
</style>

<script>
function scrollToDetail(id) {
    const element = document.getElementById('detail-' + id);
    if (element) {
        // Remove highlight from all cards
        document.querySelectorAll('.profile-card').forEach(card => {
            card.classList.remove('highlight');
        });
        
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