<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUnitKerjaToLaporan extends Migration
{
    public function up()
    {
        $fields = [
            'unit_kerja' => [
                'type'       => 'ENUM',
                'constraint' => [
                    'Senat',
                    'Pusat Penjamin Mutu',
                    'Perencanaan Program dan Penganggaran',
                    'UPT - Perpustakaan',
                    'UPT - TIK',
                    'Bag. Akademik dan Kemahasiswaan',
                    'UPT - TP3A',
                    'P3M',
                    'Pusbangjar',
                    'UPT - Bahasa',
                    'Bag. Adm. Umum dan Keuangan',
                    'UPT - LUK',
                    'UPT - PK2',
                ],
                'null'       => false,
                'after'      => 'lok_kejadian',
            ],
        ];

        $this->forge->addColumn('laporan', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('laporan', 'unit_kerja');
    }
}
