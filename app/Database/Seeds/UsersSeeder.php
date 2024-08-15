<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        // create 3 usuários
        $usuarios = [
            [
                'usuario' => 'user1',
                'senha' => password_hash('user1', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'usuario' => 'user2',
                'senha' => password_hash('user2', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'usuario' => 'user3',
                'senha' => password_hash('user3', PASSWORD_DEFAULT),
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        // insert all usuários
        $this->db->table('users')->insertBatch($usuarios);
    }
}
