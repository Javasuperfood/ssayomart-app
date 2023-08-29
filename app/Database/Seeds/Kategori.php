<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Kategori extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kategori' => 'Nori',
                'deskripsi'    => 'Lorem',
                'slug'    => 'nori',
            ],
            [
                'nama_kategori' => 'Makana Beku',
                'deskripsi'    => 'Lorem',
                'slug'    => 'makanan-neku',
            ],
            [
                'nama_kategori' => 'Minuman',
                'deskripsi'    => 'Lorem',
                'slug'    => 'minuman',
            ],
            [
                'nama_kategori' => 'Snack',
                'deskripsi'    => 'Lorem',
                'slug'    => 'snack',
            ],
        ];

        $this->db->table('jsf_kategori')->insertBatch($data);

        $data2 = [
            [
                'id_kategori' => 1,
                'nama_kategori' => 'NoriGo',
                'deskripsi'    => 'Lorem',
                'slug'    => 'norigo',
            ],
            [
                'id_kategori' => 1,
                'nama_kategori' => 'Norigo Product',
                'deskripsi'    => 'Lorem',
                'slug'    => 'norigo-produk',
            ],
            [
                'id_kategori' => 2,
                'nama_kategori' => 'Daging sapi',
                'deskripsi'    => 'Lorem',
                'slug'    => 'daging-sapi',
            ],
            [
                'id_kategori' => 3,
                'nama_kategori' => 'Cola',
                'deskripsi'    => 'Lorem',
                'slug'    => 'cola',
            ],
        ];

        $this->db->table('jsf_sub_kategori')->insertBatch($data2);
    }
}
