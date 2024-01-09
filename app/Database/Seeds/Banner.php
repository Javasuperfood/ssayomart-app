<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Banner extends Seeder
{
    public function run()
    {
        // BANNER KONTEN
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
            [
                'title' => 'Banner 4',
                'img'    => 'banner-5.jpg',
                'img_konten'    => 'content-4.jpg',
            ]
        ];

        $this->db->table('jsf_banner')->insertBatch($data);

        // BANNER ADS
        $data2 = [
            [
                'title' => 'Adsvertisements - 1',
                'img'    => 'ads-1.jpg',
            ],
            [
                'title' => 'Adsvertisements - 2',
                'img'    => 'ads-2.jpg',
            ]
        ];

        $this->db->table('jsf_ads_konten')->insertBatch($data2);

        // BANNER POP UP
        $data3 = [
            [
                'title' => 'Pop Up Promotion - 1',
                'img'    => 'pop-up-1.png',
            ]
        ];

        $this->db->table('jsf_pop_up_banner')->insertBatch($data3);

        // BANNER PROMOTION
        $data4 = [
            [
                'title' => 'Banner Promotion - 1',
                'img'    => 'promo-1.jpg',
            ],
            [
                'title' => 'Banner Promotion - 2',
                'img'    => 'promo-2.jpg',
            ],
            [
                'title' => 'Banner Promotion - 3',
                'img'    => 'promo-3.jpg',
            ],
        ];

        $this->db->table('jsf_banner_promotion')->insertBatch($data4);
    }
}
