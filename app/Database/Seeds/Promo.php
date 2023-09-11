<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Promo extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_promo' => 1,
                'title' => 'Diskon Minguan',
                'slug' =>  'diskon-mingguan',
                'start_at' => '2023-09-07',
                'end_at' => '2023-09-20',
                'deskripsi' => 'lorem'
            ],
            [
                'id_promo' => 2,
                'title' => 'Diskon Harian',
                'slug' =>  'diskon-harian',
                'start_at' => '2023-09-07',
                'end_at' => '2023-09-20',
                'deskripsi' => 'lorem'
            ],
            [
                'id_promo' => 3,
                'title' => 'Promo siang hari',
                'slug' =>  'promo-siang-hari',
                'start_at' => '2023-09-07',
                'end_at' => '2023-09-20',
                'deskripsi' => 'lorem'
            ],
        ];

        $this->db->table('jsf_promo')->insertBatch($data);
        $data2 = [
            [
                'id_promo' => 1,
                'id_produk' => 1,
                'discount' => 0.1,
                'min' => 1,
            ],
            [
                'id_promo' => 1,
                'id_produk' => 2,
                'discount' => 0.1,
                'min' => 1,
            ],
            [
                'id_promo' => 1,
                'id_produk' => 1,
                'discount' => 0.1,
                'min' => 1,
            ],
        ];

        $this->db->table('jsf_promo_item')->insertBatch($data2);
    }
}
