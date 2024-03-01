<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Produk extends Seeder
{
    public function run()
    {
        // $lorem = 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum incidunt velit, in architecto maiores corporis explicabo quos odio facere dolores minima est, fugit doloribus similique, numquam alias consequatur neque ducimus?';
        // $data = [
        //     [
        //         'nama' => 'NoriGo',
        //         'slug'    => 'nori-1',
        //         'sku'    => 1,
        //         'harga'    => 20000,
        //         'deskripsi'    => $lorem,
        //         'id_kategori' => 1,
        //         'id_sub_kategori' => 1
        //     ],
        //     [
        //         'nama' => 'NoriGo 2',
        //         'slug'    => 'nori-2',
        //         'sku'    => 1,
        //         'harga'    => 20000,
        //         'deskripsi'    => $lorem,
        //         'id_kategori' => 1,
        //         'id_sub_kategori' => 2
        //     ],
        //     [
        //         'nama' => 'Daging Sapi',
        //         'slug'    => 'daging-sapi',
        //         'sku'    => 1,
        //         'harga'    => 20000,
        //         'deskripsi'    => $lorem,
        //         'id_kategori' => 2,
        //         'id_sub_kategori' => 3
        //     ],
        // ];

        // $this->db->table('jsf_produk')->insertBatch($data);
        $variasi = [
            [
                'id_variasi' => 1,
                'nama_varian' => 'Rasa',
            ],
        ];
        $this->db->table('jsf_variasi')->insertBatch($variasi);
        $harga = [
            '1' => 10000,
            '2' => 15000,
            '3' => 20000,
        ];

        $rasa = [
            '1' => 'Sapi',
            '2' => 'Balado',
            '3' => 'Cabai',
        ];
        $berat = [
            '1' => '1000',
            '2' => '1500',
            '3' => '2000',
        ];
        for ($i = 1; $i <= 300; $i++) {
            $idK = mt_rand(1, 16);
            $idS = null;
            if ($idK == 1) {
                $idS = mt_rand(1, 2);
            }
            if ($idK == 2) {
                $idS = mt_rand(3, 4);
            }
            if ($idK == 3) {
                $idS = mt_rand(5, 6);
            }
            if ($idK == 4) {
                $idS = mt_rand(7, 9);
            }
            if ($idK == 5) {
                $idS = mt_rand(10, 13);
            }
            if ($idK == 6) {
                $idS = mt_rand(14, 16);
            }
            if ($idK == 7) {
                $idS = mt_rand(17, 19);
            }
            if ($idK == 8) {
                $idS = mt_rand(20, 21);
            }
            if ($idK == 9) {
                $idS = mt_rand(22, 24);
            }
            if ($idK == 10) {
                $idS = mt_rand(25, 26);
            }
            if ($idK == 11) {
                $idS = mt_rand(27, 29);
            }
            if ($idK == 12) {
                $idS = mt_rand(30, 32);
            }
            if ($idK == 13) {
                $idS = mt_rand(33, 35);
            }
            if ($idK == 14) {
                $idS = mt_rand(36, 37);
            }
            if ($idK == 15) {
                $idS = mt_rand(38, 40);
            }
            if ($idK == 16) {
                $idS = mt_rand(41, 43);
            }
            $faker = \Faker\Factory::create();
            // $nama = $faker->sentence(mt_rand(1, 2));
            // $slug = url_title($nama, '-', true);

            $data = [
                'nama' => 'Produk Indo ' . $i,
                'nama_en' => 'Produk Inggris ' . $i,
                'nama_kr' => 'Produk Korea ' . $i,
                'slug'    => url_title('Produk ' . $i, '-', true),
                'sku'    => $faker->numberBetween(1000000, 9000000),
                // 'harga'    => $harga[mt_rand(1, 3)],
                'deskripsi'    => $faker->paragraph(2),
                'id_kategori' => $idK,
                'id_sub_kategori' => $idS
                // 'id_sub_kategori' => null
            ];
            $this->db->table('jsf_produk')->insert($data);


            $id_variasi = 1;
            for ($j = 1; $j <= 1; $j++) {
                if ($id_variasi == 1) {
                    $val = $rasa[mt_rand(1, 3)];
                }
                if ($id_variasi == 2) {
                    $val = $berat[mt_rand(1, 3)];
                }
                $dataItem = [
                    'id_variasi' => $id_variasi,
                    'id_produk' => $i,
                    'value_item' => $val,
                    'berat' => 500,
                    'harga_item' => $harga[mt_rand(1, 3)],
                ];
                $this->db->table('jsf_variasi_item')->insert($dataItem);
            }
        }
    }
}
