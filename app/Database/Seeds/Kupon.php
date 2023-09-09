<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Kupon extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'kupon 1',
                'kode' => 'AAAA',
                'deskripsi' => 'lorem',
                'discount' => 0.2,
                'total_buy' => '50000',
                'is_active' => 1,
                'available_kupon' => 5
            ],
            [
                'nama' => 'kupon 2',
                'kode' => 'AAAB',
                'deskripsi' => 'lorem',
                'discount' => 0.2,
                'total_buy' => '1000000',
                'is_active' => 1,
                'available_kupon' => 5
            ]
        ];
        $this->db->table('jsf_kupon')->insertBatch($data);
    }
}
