<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddUserIdToKegiatan extends Migration
{
    public function up()
    {
        // 1. Tambah kolom user_id, tapi izinkan NULL untuk sementara
        $this->forge->addColumn('kegiatan', [
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
                'null'       => true, // Izinkan NULL sementara
                'after'      => 'id',
                'default'    => 1,
            ],
        ]);

        // 2. Update semua baris yang ada untuk memiliki user_id = 1 (admin)
        $this->db->query('UPDATE kegiatan SET user_id = 1 WHERE user_id IS NULL');

        // 3. Ubah kolom menjadi NOT NULL sekarang karena semua baris sudah punya nilai
        $this->forge->modifyColumn('kegiatan', [
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
                'null'       => false, // Terapkan NOT NULL
            ],
        ]);

        // 4. Tambahkan foreign key constraint
        $this->db->query('ALTER TABLE `kegiatan` ADD CONSTRAINT `kegiatan_user_id_foreign` FOREIGN KEY(`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down()
    {
        // Menghapus foreign key constraint terlebih dahulu
        $this->db->query('ALTER TABLE `kegiatan` DROP FOREIGN KEY `kegiatan_user_id_foreign`');
        
        // Menghapus kolom user_id
        $this->forge->dropColumn('kegiatan', 'user_id');
    }
}