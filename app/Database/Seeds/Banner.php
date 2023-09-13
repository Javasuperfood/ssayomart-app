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
            ],
            [
                'title' => 'Banner 4',
                'img'    => 'banner-4.jpg',
            ],
            [
                'title' => 'Banner 5',
                'img'    => 'banner-5.jpg',
            ]
        ];

        $this->db->table('jsf_banner')->insertBatch($data);
    }
}
