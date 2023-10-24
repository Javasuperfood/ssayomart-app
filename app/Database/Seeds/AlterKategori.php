<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AlterKategori extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_kategori' => 17,
                'nama_kategori' => 'Sup',
                'deskripsi'    => 'Lorem',
                'slug'    => 'Sup',
                'img'    => 'ICON CATEGORY-17.png',
            ]
        ];

        $this->db->table('jsf_kategori')->insertBatch($data);
    }
}
