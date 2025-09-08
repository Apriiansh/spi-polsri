<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddKategoriLaporanToLaporan extends Migration
{
    public function up()
    {
        $this->forge->addColumn('laporan', [
            'kategori_laporan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
                'after' => 'klasifikasi_laporan',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('laporan', 'kategori_laporan');
    }
}
