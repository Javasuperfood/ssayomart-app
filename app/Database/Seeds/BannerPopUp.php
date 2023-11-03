<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BannerPopUp extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Pop Up Promotion - 1',
                'img'    => 'pop-up-1.png',
            ]

        ];

        $this->db->table('jsf_pop_up_banner')->insertBatch($data);
    }
}
