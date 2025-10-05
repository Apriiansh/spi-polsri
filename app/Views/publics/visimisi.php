<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="relative bg-gradient-to-br from-blue-300 via-blue-500 to-cyan-500 overflow-hidden pt-5 mb-12">
    <div class="absolute inset-0 bg-black/10"></div>

    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2 blur-2xl"></div>

    <div class="relative container mx-auto px-6 py-16 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600/80 rounded-full mb-6 shadow-lg">
            <i class="fas fa-lightbulb text-white text-4xl"></i>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">VISI DAN MISI</h1>
        <div class="w-24 h-1 bg-white mx-auto rounded-full"></div>
    </div>
</div>

<div class="container mx-auto px-6 pt-12 pb-40">
    <div class="container mx-auto px-6 -mt-6 relative z-10">
        <div class="prose max-w-none text-justify text-gray-800">
            <div class="mb-12">
                <div class="flex items-center space-x-3 mb-6">
                    <h2 class="text-3xl font-extrabold text-gray-900 border-b border-blue-100 pb-2">Visi SPI</h2>
                </div>
                <div class="p-6 bg-blue-50 rounded-xl border-l-4 border-blue-400">
                    <p class="text-lg text-gray-700">
                        "Menjadi mitra strategis dalam mengawal terciptanya <span class="italic">Good and Clean
                            Governance (GCG)</span> di Politeknik Negeri Sriwijaya yang Unggul dan Terkemuka."
                    </p>
                </div>
            </div>

            <div class="mb-8">
                <div class="flex items-center space-x-3 mb-8">
                    <h2 class="text-3xl font-extrabold text-gray-900 border-b border-blue-100 pb-2">Misi SPI</h2>
                </div>

                <!-- Daftar Misi: Menggunakan daftar vertikal yang lebih minimalis dan mudah dibaca -->
                <ul class="space-y-6">

                    <?php
                    $misi_items = [
                        "Mendorong implementasi Good and Clean Governance (GCG) pada setiap unit kerja di Polsri melalui pengawasan yang berkesinambungan dan profesional.",
                        "Menjalankan fungsi pengawasan secara independen dan objektif dengan melaksanakan pengawasan dan evaluasi yang bebas dari intervensi, serta memberikan rekomendasi yang objektif untuk perbaikan proses manajemen dan tata kelola.",
                        "Mengembangkan kompetensi dan menjaga integritas SPI untuk memastikan pelaksanaan pengawasan yang terpercaya dan berkualitas.",
                        "Mendukung dan memastikan akuntabilitas dan transparansi di setiap proses kegiatan Polsri melalui sistem pengawasan dan pelaporan yang efektif.",
                        "Mengintegrasikan teknologi dan pendekatan terkini dalam audit berbasis risiko untuk menciptakan proses pengawasan yang efisien, efektif, dan ekonomis.",
                        "Memberikan masukan strategis kepada manajemen terkait mitigasi risiko dan pengambilan keputusan yang mendukung tercapainya visi Polsri sebagai institusi yang unggul dan terkemuka."
                    ];

                    foreach ($misi_items as $index => $misi) {
                        $number = $index + 1;
                        echo '
                    <li class="flex items-start group">
                        <!-- Indikator Angka Minimalis -->
                        <div class="flex-shrink-0 w-6 h-6 flex items-center justify-center text-sm font-semibold text-blue-600 border border-blue-200 rounded-full mt-1 mr-4 bg-blue-50 group-hover:bg-blue-100 transition duration-150">
                            ' . $number . '
                        </div>
                        <!-- Teks Misi dengan Garis Bawah Halus -->
                        <p class="text-gray-700 leading-relaxed flex-1 py-1 border-b border-gray-100 group-last:border-b-0 group-hover:text-gray-800 transition duration-150">
                            ' . $misi . '
                        </p>
                    </li>';
                    }
                    ?>

                </ul>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>