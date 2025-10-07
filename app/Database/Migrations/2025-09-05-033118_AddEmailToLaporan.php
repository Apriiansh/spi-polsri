<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddEmailToLaporan extends Migration
{
    public function up()
    {
        $this->forge->addColumn('laporan', [
            'email_pelapor' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
                'after' => 'id',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('laporan', 'email_pelapor');
    }
}
