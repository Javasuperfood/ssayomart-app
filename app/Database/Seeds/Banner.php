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
                'img_konten'    => 'content-1.jpg',
            ],
            [
                'title' => 'Banner 2',
                'img'    => 'banner-2.png',
                'img_konten'    => 'content-2.jpg',
            ],
            [
                'title' => 'Banner 3',
                'img'    => 'banner-3.png',
                'img_konten'    => 'content-3.jpg',
            ],
            // [
            //     'title' => 'Banner 4',
            //     'img'    => 'banner-4.png',
            //     'img_konten'    => 'content-1.jpg',
            // ]

        ];

        $this->db->table('jsf_banner')->insertBatch($data);
    }
}
