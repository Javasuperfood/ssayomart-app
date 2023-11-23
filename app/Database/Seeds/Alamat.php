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
                'label' => 'Rumah Tangerang',
                'penerima' => 'Adib Alfaini',
                'alamat_1' => 'Jalan Kalimantan, Lippo Village, Panunggangan Barat, Cibodas, Tangerang, Banten, Jawa, 15139, Indonesia',
                'alamat_2' => 'Jalan Kalimantan, Lippo Village, Panunggangan Barat, Cibodas, Tangerang, Banten, Jawa, 15139, Indonesia',
                'alamat_3' => 'Jalan Kalimantan, Lippo Village, Panunggangan Barat, Cibodas, Tangerang, Banten, Jawa, 15139, Indonesia',
                'id_province' => 3,
                'province' => 'Banten',
                'id_city' => 456,
                'city' => 'Kota Tangerang',
                'zip_code' => '15139',
                'telp' => '085112345678',
                'telp2' => '085112345678',
                'latitude' => -6.219030,
                'longitude' => 106.619629
            ],
            [
                'id_user' => 1,
                'label' => 'Rumah Jakarta',
                'penerima' => 'Gilang Aditia',
                'alamat_1' => 'Jalan Raya Serang KM.100 No. 124',
                'alamat_2' => 'Jalan Raya Kronjo KM.183 No. 121',
                'alamat_3' => 'Jalan Jatibaru, RW 03, Kampung Bali, Tanah Abang, Jakarta Pusat, Daerah Khusus Ibukota Jakarta, Jawa, 10250, Indonesia',
                'id_province' => 6,
                'province' => 'DKI Jakarta',
                'id_city' => 106,
                'city' => 'Kota Jakarta Selatan',
                'zip_code' => '11410',
                'telp' => '085112345678',
                'telp2' => '085112345678',
                'latitude' => -6.182595,
                'longitude' => 106.813331
            ],
            [
                'id_user' => 1,
                'label' => 'Rumah Sukabumi',
                'penerima' => 'Anto Walker',
                'alamat_1' => 'Jalan Arief Rahman Hakim, Sriwidari, Sukabumi, Jawa Barat, Jawa, 43111, Indonesia',
                'alamat_2' => 'Jalan Arief Rahman Hakim, Sriwidari, Sukabumi, Jawa Barat, Jawa, 43111, Indonesia',
                'alamat_3' => 'Jalan Arief Rahman Hakim, Sriwidari, Sukabumi, Jawa Barat, Jawa, 43111, Indonesia',
                'id_province' => 9,
                'province' => 'Jawa Barat',
                'id_city' => 430,
                'city' => 'Kabupaten Sukabumi',
                'zip_code' => '43144',
                'telp' => '085112345678',
                'telp2' => '085112345678'
            ]
        ];
        $this->db->table('jsf_alamat_users')->insertBatch($data);
    }
}
