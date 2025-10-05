<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSlugToKegiatan extends Migration
{
    /**
     * Metode up() untuk menjalankan migrasi.
     * Metode ini akan menambahkan kolom 'slug' ke tabel 'kegiatan'.
     */
    public function up()
    {
        // Mendefinisikan kolom 'slug'
        $fields = [
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'unique'     => true, // Memastikan slug bersifat unik
                'after'      => 'judul', // Menempatkan kolom setelah 'judul'
                'null'       => true,
            ],
        ];

        // Menambahkan kolom ke tabel 'kegiatan'
        $this->forge->addColumn('kegiatan', $fields);
    }

    /**
     * Metode down() untuk mengembalikan migrasi.
     * Metode ini akan menghapus kolom 'slug' dari tabel 'kegiatan'.
     */
    public function down()
    {
        // Menghapus kolom 'slug' dari tabel 'kegiatan'
        $this->forge->dropColumn('kegiatan', 'slug');
    }
}
