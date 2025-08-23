<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CleanupKategoriTables extends Migration
{
    public function up()
    {
        // Drop foreign keys from the 'kegiatan' table first.
        // Note: The constraint names are guessed based on common conventions.
        // If this fails, the exact constraint names must be verified from the database schema.
        if ($this->db->tableExists('kegiatan')) {
            $this->forge->dropForeignKey('kegiatan', 'kegiatan_kategori_id_foreign');
            $this->forge->dropForeignKey('kegiatan', 'kegiatan_sub_kategori_id_foreign');
        }

        // Drop sub_kategori and kategori tables
        $this->forge->dropTable('sub_kategori', true);
        $this->forge->dropTable('kategori', true);

        // Modify kegiatan table: drop old columns and add new ones
        if ($this->db->tableExists('kegiatan')) {
            $this->forge->dropColumn('kegiatan', ['kategori_id', 'sub_kategori_id']);

            $this->forge->addColumn('kegiatan', [
                'kategori' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => false,
                    'after' => 'judul',
                ],
                'sub_kategori' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => false,
                    'after' => 'kategori',
                ],
            ]);
        }
    }

    public function down()
    {
        // Recreate kategori table
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'nama_kategori' => ['type' => 'VARCHAR', 'constraint' => '100'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kategori');

        // Recreate sub_kategori table
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'auto_increment' => true],
            'kategori_id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true],
            'nama_subkategori' => ['type' => 'VARCHAR', 'constraint' => '100'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('sub_kategori');

        // Revert changes on kegiatan table
        if ($this->db->tableExists('kegiatan')) {
            $this->forge->dropColumn('kegiatan', ['kategori', 'sub_kategori']);

            $this->forge->addColumn('kegiatan', [
                'kategori_id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'null' => false],
                'sub_kategori_id' => ['type' => 'INT', 'constraint' => 5, 'unsigned' => true, 'null' => false],
            ]);

            // Re-add foreign keys
            $this->forge->addForeignKey('kategori_id', 'kategori', 'id', 'CASCADE', 'CASCADE', 'kegiatan_kategori_id_foreign');
            $this->forge->addForeignKey('sub_kategori_id', 'sub_kategori', 'id', 'CASCADE', 'CASCADE', 'kegiatan_sub_kategori_id_foreign');
        }
    }
}
