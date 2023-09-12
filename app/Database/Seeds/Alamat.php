<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Alamat extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_user' => 1,
                'label' => 'Rumah',
                'penerima' => 'Alfarizi',
                'alamat_1' => 'Jalan Raya Serang KM.100 No. 124',
                'alamat_2' => 'Jalan Raya Kronjo KM.183 No. 121',
                'id_province' => 3,
                'province' => 'Banten',
                'id_city' => 106,
                'city' => 'Cilegon',
                'zip_code' => '15610',
                'telp' => '085112345678',
                'telp2' => '085112345678'
            ],
            [
                'id_user' => 1,
                'label' => 'Kantor JSF',
                'penerima' => 'Gilang',
                'alamat_1' => 'Jalan Raya Serang KM.100 No. 124',
                'alamat_2' => 'Jalan Raya Kronjo KM.183 No. 121',
                'id_province' => 3,
                'province' => 'Banten',
                'id_city' => 106,
                'city' => 'Cilegon',
                'zip_code' => '15610',
                'telp' => '085112345678',
                'telp2' => '085112345678'
            ],
            [
                'id_user' => 1,
                'label' => 'Bengkel Produksi',
                'penerima' => 'Icha',
                'alamat_1' => 'Jalan Raya Serang KM.100 No. 124',
                'alamat_2' => 'Jalan Raya Kronjo KM.183 No. 121',
                'id_province' => 3,
                'province' => 'Banten',
                'id_city' => 106,
                'city' => 'Cilegon',
                'zip_code' => '15610',
                'telp' => '085112345678',
                'telp2' => '085112345678'
            ]
        ];
        $this->db->table('jsf_alamat_users')->insertBatch($data);
    }
}
