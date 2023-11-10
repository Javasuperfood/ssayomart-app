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
                'title' => 'Diskon Sayuran',
                'slug' =>  'diskon-sayuran',
                'start_at' => '2023-09-07',
                'end_at' => '2026-12-20',
                'deskripsi' => 'Diskon Semua Kategori Sayur',
                'img' => 'promo-1.jpg'
            ],
            [
                'id_promo' => 2,
                'title' => 'Produk Terbaru',
                'slug' =>  'produk-terbaru',
                'start_at' => '2023-09-07',
                'end_at' => '2026-12-20',
                'deskripsi' => 'Produk terbaru dari Ssayomart',
                'img' => 'promo-2.jpg'
            ],
            [
                'id_promo' => 3,
                'title' => 'Spesial Promo',
                'slug' =>  'special-promo',
                'start_at' => '2023-09-07',
                'end_at' => '2026-12-20',
                'deskripsi' => 'Spesial promo dari Ssayomart',
                'img' => 'promo-3.jpg'
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
