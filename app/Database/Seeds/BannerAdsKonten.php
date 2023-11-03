<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BannerAdsKonten extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Adsvertisements - 1',
                'img'    => 'ads-1.jpg',
            ],
            [
                'title' => 'Adsvertisements - 2',
                'img'    => 'ads-2.jpg',
            ]

        ];

        $this->db->table('jsf_ads_konten')->insertBatch($data);
    }
}
