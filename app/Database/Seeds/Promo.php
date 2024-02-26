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
            ],
            [
                'id_promo' => 3,
                'title' => 'Promo Terbaru',
                'slug' =>  'promo-terbaru',
                'start_at' => '2023-09-07',
                'end_at' => '2026-12-20',
                'deskripsi' => 'Produk terbatu dari Ssayomart',
                'img' => 'promotion-3.jpg'
            ],
            [
                'id_promo' => 4,
                'title' => 'Diskon Sayuran',
                'slug' =>  'diskon-sayuran',
                'start_at' => '2023-09-07',
                'end_at' => '2026-12-20',
                'deskripsi' => 'Diskon semua sayuran',
                'img' => 'promotion-4.jpg'
            ]


        ];

        $this->db->table('jsf_promo')->insertBatch($data);
        $data2 = [
            [
                'id_promo' => 1,
                'id_produk' => 100,
                'discount' => 0.1,
                'min' => 1,
            ],
            [
                'id_promo' => 1,
                'id_produk' => 99,
                'discount' => 0.1,
                'min' => 1,
            ],
            [
                'id_promo' => 1,
                'id_produk' => 98,
                'discount' => 0.1,
                'min' => 1,
            ],
        ];

        $this->db->table('jsf_promo_batch')->insertBatch($data2);
    }
}
