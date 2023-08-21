<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AddGroupUser extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'darth',
            'email'    => 'darth@theempire.com',
        ];

        // Simple Queries
        $this->db->query('INSERT INTO auth_groups_users (id, user_id, group,) VALUES(:username:, :email:)', $data);

        // Using Query Builder
        $this->db->table('users')->insert($data);
    }
}
