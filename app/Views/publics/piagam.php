<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="relative bg-gradient-to-br from-blue-300 via-blue-500 to-cyan-500 overflow-hidden pt-5 mb-12">
    <div class="absolute inset-0 bg-black/10"></div>

    <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2 blur-2xl"></div>

    <div class="relative container mx-auto px-6 py-16 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-600/80 rounded-full mb-6 shadow-lg">
            <i class="fas fa-certificate text-white text-4xl"></i>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Piagam Penghargaan Intern</h1>
        <div class="w-24 h-1 bg-white mx-auto rounded-full"></div>
    </div>
</div>


<div class="container mx-auto px-6 py-12">

    <div class="container mx-auto px-6 -mt-6 relative z-10">

        <div class="prose max-w-none text-justify text-gray-800">
            <p class="mb-4">
                Piagam Pengawasan Intern (Internal Audit Charter) adalah dokumen formal yang berisi tentang komitmen pimpinan atas pengakuan keberadaan dan berfungsinya Satuan Pengawasan Internal (SPI) di sebuah organisasi atau badan hukum. Piagam Pengawasan Intern disusun sebagai tindak lanjut dari Peraturan Menteri Keuangan Republik Indonesia (PMK RI) Nomor. 129/PMK.05/2020 sebagaimana terakhir diubah melalui PMK RI Nomor. 202/PMK.05/2022 tentang pedoman pengelolaan Badan Layanan Umum (BLU).
            </p>
            <p class="mb-4">
                Piagam Pengawasan Intern akan menjadi dasar keberadaan dan pelaksanaan tugas-tugas pengawasan oleh SPI agar diketahui oleh pegawai dan pihak lain yang terkait. Audit internal adalah suatu kegiatan pemberian keyakinan (assurance) dan konsultasi yang bersifat independen dan objektif yang bertujuan untuk meningkatkan nilai dan memperbaiki pelaksanaan kegiatan di Politeknik Negeri Sriwijaya (Polsri) yang sesuai dengan kaidah-kaidah Good and Clean Governance (GCG) yang meliputi transparansi, kemandirian, akuntabilitas, dan pertanggunganjawaban, serta kewajaran (fairness) sesuai dengan prinsip institusi yang sehat dan taat kepada Peraturan Perundang-undangan. Keberadaan Piagam Pengawasan Intern bertujuan untuk memberikan pengakuan (recognition) kepada SPI atas segala tugas pokok dan fungsinya di Polsri guna tercapainya rasa saling pengertian dan kerjasama yang baik dalam mewujudkan visi, misi dan tujuan Polsri.
            </p>

            <div class="mt-12 text-center not-prose">
                <a href="<?= base_url('piagam.pdf') ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center px-8 py-4 bg-blue-600 text-white font-bold rounded-lg shadow-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-file-pdf mr-3 text-xl"></i>
                    <span>Lihat Lampiran Piagam (PDF)</span>
                </a>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>