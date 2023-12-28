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
                'deskripsi' => 'Cabang Market Ssayomart Karawaci',
                'alamat_1' => 'Blok I No. 20, Karawaci Office Park, Jl. Imam Bonjol, Panunggangan Bar., Kec. Cibodas, Kota Tangerang, Banten',
                'alamat_2' => '',
                'id_province' => 3,
                'province' => 'Banten',
                'id_city' => 456,
                'city' => 'Kota Tangerang',
                'zip_code' => '15139',
                'telp' => '02135290000',
                'latitude' => -6.22393874,
                'longitude' => 106.61877357
            ],
            // [
            //     'id_toko' => 2,
            //     'lable' => 'Market Cabang Jakarta',
            //     'deskripsi' => 'Market Cabang Jakarta',
            //     'alamat_1' => 'Jl. K.S. Tubun No.92 - 94, RT.10/RW.1, Slipi, Kec. Palmerah, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta 11410',
            //     'alamat_2' => 'RW 02, Gambir, Jakarta Pusat, Daerah Khusus Ibukota Jakarta, Jawa, 10110, Indonesia',
            //     'id_province' => 6,
            //     'province' => 'DKI Jakarta',
            //     'id_city' => 153,
            //     'city' => 'Kota Jakarta Selatan',
            //     'zip_code' => '11410',
            //     'telp' => '08511234562',
            //     'latitude' => -6.185723,
            //     'longitude' => 106.832424
            // ],
            // [
            //     'id_toko' => 3,
            //     'lable' => 'Market Cabang Sukabumi',
            //     'deskripsi' => 'Market Cabang Sukabumi',
            //     'alamat_1' => 'Jalan Koleberes, Citamiang, Sukabumi, Jawa Barat, Jawa, 43144',
            //     'alamat_2' => 'Jalan Koleberes, Citamiang, Sukabumi, Jawa Barat, Jawa, 43144',
            //     'id_province' => 9,
            //     'province' => 'Jawa Barat',
            //     'id_city' => 430,
            //     'city' => 'Kabupaten Sukabumi',
            //     'zip_code' => '43144',
            //     'telp' => '08511234562',
            //     'latitude' => -6.939323,
            //     'longitude' => 106.919036
            // ],
        ];
        $this->db->table('jsf_toko')->insertBatch($data);
    }
}
