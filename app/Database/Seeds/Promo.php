<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Promo extends Seeder
{
    public function run()
    {
        $data = [
            // [
            //     'id_promo' => 1,
            //     'title' => 'Diskon',
            //     'slug' =>  'diskon',
            //     'start_at' => '2023-09-07',
            //     'end_at' => '2023-12-20',
            //     'deskripsi' => 'lorem',
            //     'img' => 'promo-1.png'
            // ],
            // [
            //     'id_promo' => 2,
            //     'title' => 'Flash Sale',
            //     'slug' =>  'flash-sale',
            //     'start_at' => '2023-09-07',
            //     'end_at' => '2023-12-20',
            //     'deskripsi' => 'lorem',
            //     'img' => 'promo-2.png'
            // ],
            [
                'id_promo' => 1,
                'title' => 'Produk Terbaru',
                'slug' =>  'produk-terbaru',
                'start_at' => '2023-09-07',
                'end_at' => '2023-12-20',
                'deskripsi' => 'lorem',
                'img' => 'promo-3.jpg'
            ],
            [
                'id_promo' => 2,
                'title' => 'Bundling',
                'slug' =>  'bundling',
                'start_at' => '2023-09-07',
                'end_at' => '2023-12-20',
                'deskripsi' => 'lorem',
                'img' => 'promo-4.jpg'
            ],
            [
                'id_promo' => 3,
                'title' => 'Bundling',
                'slug' =>  'bundling',
                'start_at' => '2023-09-07',
                'end_at' => '2023-12-20',
                'deskripsi' => 'lorem',
                'img' => 'promo-4.jpg'
            ],
            [
                'id_promo' => 4,
                'title' => 'Bundling',
                'slug' =>  'bundling',
                'start_at' => '2023-09-07',
                'end_at' => '2023-12-20',
                'deskripsi' => 'lorem',
                'img' => 'promo-4.jpg'
            ],
            [
                'id_promo' => 5,
                'title' => 'Bundling',
                'slug' =>  'bundling',
                'start_at' => '2023-09-07',
                'end_at' => '2023-12-20',
                'deskripsi' => 'lorem',
                'img' => 'promo-4.jpg'
            ],
            [
                'id_promo' => 6,
                'title' => 'Bundling',
                'slug' =>  'bundling',
                'start_at' => '2023-09-07',
                'end_at' => '2023-12-20',
                'deskripsi' => 'lorem',
                'img' => 'promo-4.jpg'
            ],
            [
                'id_promo' => 7,
                'title' => 'Bundling',
                'slug' =>  'bundling',
                'start_at' => '2023-09-07',
                'end_at' => '2023-12-20',
                'deskripsi' => 'lorem',
                'img' => 'promo-4.jpg'
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
