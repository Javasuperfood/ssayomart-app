<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Banner extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Banner 1',
                'img'    => 'banner-1.jpg',
            ],
            [
                'title' => 'Banner 2',
                'img'    => 'banner-2.jpg',
            ],
            [
                'title' => 'Banner 3',
                'img'    => 'banner-3.jpg',
            ]
        ];

        $this->db->table('jsf_banner')->insertBatch($data);
    }
}
