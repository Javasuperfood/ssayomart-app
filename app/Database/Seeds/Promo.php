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
                'title' => 'Promo Kimchi',
                'slug' =>  'promo-kimchi',
                'start_at' => '2023-09-07',
                'end_at' => '2026-12-20',
                'deskripsi' => 'Promo Harga Kimchi',
                'img' => 'promotion-1.jpg'
            ],
            [
                'id_promo' => 2,
                'title' => 'Diskon 20%',
                'slug' =>  'diskon-kwangcheon-kim',
                'start_at' => '2023-09-07',
                'end_at' => '2026-12-20',
                'deskripsi' => 'Diskon 20% Untuk Merayakan Kwangcheon Kim',
                'img' => 'promotion-2.jpg'
            ]
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
