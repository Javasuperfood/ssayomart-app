<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Kategori extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_kategori' => 1,
                'nama_kategori' => 'NORI',
                'deskripsi'    => 'Lorem',
                'slug'    => 'nori',
            ],
            [
                'id_kategori' => 2,
                'nama_kategori' => 'RAMEN                ',
                'deskripsi'    => 'Lorem',
                'slug'    => 'ramen',
            ],
            [
                'id_kategori' => 3,
                'nama_kategori' => 'MAKANAN SAMPING',
                'deskripsi'    => 'Lorem',
                'slug'    => 'makanan-samping',
            ],
            [
                'id_kategori' => 4,
                'nama_kategori' => 'SNACK',
                'deskripsi'    => 'Lorem',
                'slug'    => 'snack',
            ],
            [
                'id_kategori' => 5,
                'nama_kategori' => 'SAYUR & BUAH',
                'deskripsi'    => 'Lorem',
                'slug'    => 'sayur-dan-buah',
            ],
            [
                'id_kategori' => 6,
                'nama_kategori' => 'SEAFOOD',
                'deskripsi'    => 'Lorem',
                'slug'    => 'seafood',
            ],
            [
                'id_kategori' => 7,
                'nama_kategori' => 'DAGING',
                'deskripsi'    => 'Lorem',
                'slug'    => 'daging',
            ],
            [
                'id_kategori' => 8,
                'nama_kategori' => 'BERAS/KACANG',
                'deskripsi'    => 'Lorem',
                'slug'    => 'beras-or-kacang',
            ],
            [
                'id_kategori' => 9,
                'nama_kategori' => 'MAKANAN INSTAN',
                'deskripsi'    => 'Lorem',
                'slug'    => 'mkanan-instan',
            ],
            [
                'id_kategori' => 10,
                'nama_kategori' => 'TELUR',
                'deskripsi'    => 'Lorem',
                'slug'    => 'telur',
            ],
            [
                'id_kategori' => 11,
                'nama_kategori' => 'BAHAN MAKANAN',
                'deskripsi'    => 'Lorem',
                'slug'    => 'bahan-makanan',
            ],
            [
                'id_kategori' => 12,
                'nama_kategori' => 'MINYAK',
                'deskripsi'    => 'Lorem',
                'slug'    => 'minyak',
            ],
            [
                'id_kategori' => 13,
                'nama_kategori' => 'BUBUK CABE',
                'deskripsi'    => 'Lorem',
                'slug'    => 'bubuk-cabe',
            ],
            [
                'id_kategori' => 14,
                'nama_kategori' => 'MINUMAN',
                'deskripsi'    => 'Lorem',
                'slug'    => 'minuman',
            ],
            [
                'id_kategori' => 15,
                'nama_kategori' => 'SUSU & OLAHAN',
                'deskripsi'    => 'Lorem',
                'slug'    => 'susu-dan-olahan',
            ]
        ];

        $this->db->table('jsf_kategori')->insertBatch($data);

        $data2 = [
            [
                'id_kategori' => 2,
                'nama_kategori' => 'MIE KOREA',
                'deskripsi'    => 'Lorem',
                'slug'    => 'mie-korea',
            ],
            [
                'id_kategori' => 2,
                'nama_kategori' => 'MIE INDONESIA',
                'deskripsi'    => 'Lorem',
                'slug'    => 'mie-indonesia',
            ],
            [
                'id_kategori' => 2,
                'nama_kategori' => 'MIE JEPANG',
                'deskripsi'    => 'Lorem',
                'slug'    => 'mie-jepang',
            ],
            [
                'id_kategori' => 3,
                'nama_kategori' => 'ACAR',
                'deskripsi'    => 'Lorem',
                'slug'    => 'acar',
            ],
            [
                'id_kategori' => 3,
                'nama_kategori' => 'KIMCHI',
                'deskripsi'    => 'Lorem',
                'slug'    => 'kimci',
            ],
            [
                'id_kategori' => 4,
                'nama_kategori' => 'NORI',
                'deskripsi'    => 'Lorem',
                'slug'    => 'nori',
            ],
            [
                'id_kategori' => 4,
                'nama_kategori' => 'SNACK KOREA',
                'deskripsi'    => 'Lorem',
                'slug'    => 'snack-korea',
            ],
            [
                'id_kategori' => 5,
                'nama_kategori' => 'SAYUR SEGAR',
                'deskripsi'    => 'Lorem',
                'slug'    => 'sayuran-segar',
            ],
            [
                'id_kategori' => 5,
                'nama_kategori' => 'SAYUR BEKU',
                'deskripsi'    => 'Lorem',
                'slug'    => 'sayuran-beku',
            ],
            [
                'id_kategori' => 3,
                'nama_kategori' => 'BUAH-BUAHAN',
                'deskripsi'    => 'Lorem',
                'slug'    => 'buah-buahan',
            ],
            [
                'id_kategori' => 6,
                'nama_kategori' => 'IKAN',
                'deskripsi'    => 'Lorem',
                'slug'    => 'ikan',
            ],
            [
                'id_kategori' => 6,
                'nama_kategori' => 'KERANG',
                'deskripsi'    => 'Lorem',
                'slug'    => 'kerang',
            ],
            [
                'id_kategori' => 6,
                'nama_kategori' => 'UDANG',
                'deskripsi'    => 'Lorem',
                'slug'    => 'udang',
            ],
            [
                'id_kategori' => 6,
                'nama_kategori' => 'CUMI',
                'deskripsi'    => 'Lorem',
                'slug'    => 'cumi',
            ],
            [
                'id_kategori' => 7,
                'nama_kategori' => 'SAPI',
                'deskripsi'    => 'Lorem',
                'slug'    => 'sapi',
            ],
            [
                'id_kategori' => 7,
                'nama_kategori' => 'AYAM',
                'deskripsi'    => 'Lorem',
                'slug'    => 'ayam',
            ],
            [
                'id_kategori' => 7,
                'nama_kategori' => 'BEBEK',
                'deskripsi'    => 'Lorem',
                'slug'    => 'bebek',
            ],
            [
                'id_kategori' => 7,
                'nama_kategori' => 'BABI',
                'deskripsi'    => 'Lorem',
                'slug'    => 'babi',
            ],
        ];

        $this->db->table('jsf_sub_kategori')->insertBatch($data2);
    }
}
