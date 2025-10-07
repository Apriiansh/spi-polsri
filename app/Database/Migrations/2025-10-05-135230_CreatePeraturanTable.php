<?php


namespace App\Database\Migrations;


use CodeIgniter\Database\Migration;


class CreatePeraturanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'judul' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'kategori' => [
                'type' => 'ENUM',
                'constraint' => ['Akuntansi/Keuangan', 'Hukum', 'Manajemen SDM', 'Manajemen Aset', 'Ketatalaksanaan'],
                'null' => false,
            ],
            'peraturan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'file_lampiran' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'published', 'rejected'],
                'default' => 'pending',
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
        ]);


        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addKey('kategori');
        $this->forge->addKey('status');


        $this->forge->createTable('peraturan');
    }


    public function down()
    {
        $this->forge->dropTable('peraturan');
    }
}
