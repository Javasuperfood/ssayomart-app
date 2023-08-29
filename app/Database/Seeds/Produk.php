<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Produk extends Seeder
{
    public function run()
    {
        $lorem = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum incidunt velit, in architecto maiores corporis explicabo quos odio facere dolores minima est, fugit doloribus similique, numquam alias consequatur neque ducimus?';
        $data = [
            [
                'nama' => 'NoriGo',
                'slug'    => 'nori-1',
                'sku'    => 1,
                'harga'    => 20000,
                'stok'    => 100,
                'deskripsi'    => $lorem,
                'id_kategori' => 1,
                'id_sub_kategori' => 1
            ],
            [
                'nama' => 'NoriGo 2',
                'slug'    => 'nori-2',
                'sku'    => 1,
                'harga'    => 20000,
                'stok'    => 100,
                'deskripsi'    => $lorem,
                'id_kategori' => 1,
                'id_sub_kategori' => 2
            ],
            [
                'nama' => 'Daging Sapi',
                'slug'    => 'daging-sapi',
                'sku'    => 1,
                'harga'    => 20000,
                'stok'    => 100,
                'deskripsi'    => $lorem,
                'id_kategori' => 2,
                'id_sub_kategori' => 3
            ],
        ];

        $this->db->table('jsf_produk')->insertBatch($data);
    }
}
