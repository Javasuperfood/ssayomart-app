<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Kupon extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'DISKON HARI RAYA 200%',
                'kode' => 'S4Y0M4RT',
                'deskripsi' => 'lorem',
                'discount' => 0.2,
                'total_buy' => '50000',
                'is_active' => 1,
                'available_kupon' => 5,
                'created_by' => 1
            ],
            [
                'nama' => 'DISKON NATAL -100%',
                'kode' => 'S4Y0M4RTN4t4L',
                'deskripsi' => 'lorem',
                'discount' => 0.2,
                'total_buy' => '1000000',
                'is_active' => 1,
                'available_kupon' => 5,
                'created_by' => 1
            ]
        ];
        $this->db->table('jsf_kupon')->insertBatch($data);
    }
}
