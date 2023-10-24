<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Market extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_toko' => 1,
                'id_user' => 1,
                'deskripsi' => 'Market Utama',
                'alamat_1' => 'Karawaci office park Blok I No.20, Lippo Karawaci Desa/Kelurahan Panunggangan Barat, Kec. Cibodas Kota Tangerang , Provisi Banten Kode Pos. 15139',
                'id_province' => 3,
                'province' => 'Banten',
                'id_city' => 456,
                'city' => 'Kota Tangerang',
                'zip_code' => '15139',
                'telp' => '123456789',
                'latitude' => -6.2203653,
                'longitude' => 106.6228641
            ],
            [
                'id_toko' => 2,
                'id_user' => 2,
                'deskripsi' => 'Market Cabang JKT',
                'alamat_1' => 'Alamat Cabang JKT',
                'id_province' => 6,
                'province' => 'DKI Jakarta',
                'id_city' => 153,
                'city' => 'Kota Jakarta Selatan',
                'zip_code' => '12230',
                'telp' => '11223344556',
                'latitude' => -6.2203653,
                'longitude' => 106.6228641
            ]
        ];
        $this->db->table('jsf_toko')->insertBatch($data);
    }
}
