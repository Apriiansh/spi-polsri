<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLaporanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'kategori_laporan' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'judul'          => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'isi'            => [
                'type'       => 'TEXT',
            ],
            'tgl_kejadian'   => [
                'type'       => 'DATE',
            ],
            'lok_kejadian'   => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'gambar_bukti'   => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'status_laporan' => [
                'type'       => 'ENUM',
                'constraint' => ['pending', 'in_progress', 'completed'],
                'default'    => 'pending',
            ],
            'created_at'     => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at'     => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('laporan');
    }

    public function down()
    {
        $this->forge->dropTable('laporan');
    }

}
