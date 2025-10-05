<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Data akun yang akan di-seed
        $data = [
            [
                'username' => 'admin',
                'email'    => 'spipolsri@polsri.ac.id',
                'password' => password_hash('password123', PASSWORD_DEFAULT), 
                'role'     => 'admin', 
            ],
            [
                'username' => 'user1',
                'email'    => 'user@polsri.ac.id',
                'password' => password_hash('password123', PASSWORD_DEFAULT), 
                'role'     => 'user', 
            ]
        ];

        // Memasukkan data ke tabel 'users'
        // Gunakan try...catch untuk penanganan error
        try {
            foreach ($data as $user) {
                $this->db->table('users')->insert($user);
            }
            echo "Data pengguna berhasil di-seed.\n";
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}
