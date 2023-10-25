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
                'lable' => 'Market Utama',
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
                'lable' => 'Market Cabang JKT',
                'deskripsi' => 'Market Cabang JKT',
                'alamat_1' => 'Jl. K.S. Tubun No.92 - 94, RT.10/RW.1, Slipi, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11410',
                'id_province' => 6,
                'province' => 'DKI Jakarta',
                'id_city' => 153,
                'city' => 'Kota Jakarta Selatan',
                'zip_code' => '11410',
                'telp' => '11223344556',
                'latitude' => -6.2203653,
                'longitude' => 106.6228641
            ],
            [
                'id_toko' => 3,
                'lable' => 'Market Cabang SYB',
                'deskripsi' => 'Market Cabang JKT',
                'alamat_1' => 'Jl. Bubutan No.1-7, Bubutan, Kec. Bubutan, Surabaya, Jawa Timur 60174',
                'id_province' => 11,
                'province' => 'Jawa Timur',
                'id_city' => 343,
                'city' => 'Kota Pasuruan',
                'zip_code' => '60174',
                'telp' => '11223344556',
                'latitude' => -6.2203653,
                'longitude' => 106.6228641
            ],
        ];
        $this->db->table('jsf_toko')->insertBatch($data);
    }
}
