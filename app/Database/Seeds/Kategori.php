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
                'nama_kategori' => 'Kimchi & Makanan Pendamping',
                'deskripsi'    => 'Lorem',
                'slug'    => 'kimchi-dan-makanan-pendamping',
                'img'    => 'ICON CATEGORY-01.png',
            ],
            [
                'id_kategori' => 2,
                'nama_kategori' => 'Nori',
                'deskripsi'    => 'Lorem',
                'slug'    => 'nori',
                'img'    => 'ICON CATEGORY-02.png',
            ],
            [
                'id_kategori' => 3,
                'nama_kategori' => 'Buah & Sayur',
                'deskripsi'    => 'Lorem',
                'slug'    => 'buah-dan-sayur',
                'img'    => 'ICON CATEGORY-03.png',
            ],
            [
                'id_kategori' => 4,
                'nama_kategori' => 'Saus & Bubuk Cabai',
                'deskripsi'    => 'Lorem',
                'slug'    => 'saus-dan-bubuk-cabai',
                'img'    => 'ICON CATEGORY-04.png',
            ],
            [
                'id_kategori' => 5,
                'nama_kategori' => 'Daging & Telur',
                'deskripsi'    => 'Lorem',
                'slug'    => 'daging-dan-telur',
                'img'    => 'ICON CATEGORY-05.png',
            ],
            [
                'id_kategori' => 6,
                'nama_kategori' => 'Makanan Laut',
                'deskripsi'    => 'Lorem',
                'slug'    => 'makanan-laut',
                'img'    => 'ICON CATEGORY-06.png',
            ],
            [
                'id_kategori' => 7,
                'nama_kategori' => 'Beras & kacang',
                'deskripsi'    => 'Lorem',
                'slug'    => 'beras-dan-kacang',
                'img'    => 'ICON CATEGORY-07.png',
            ],
            [
                'id_kategori' => 8,
                'nama_kategori' => 'Ramen',
                'deskripsi'    => 'Lorem',
                'slug'    => 'ramen',
                'img'    => 'ICON CATEGORY-08.png',
            ],
            [
                'id_kategori' => 9,
                'nama_kategori' => 'Snack',
                'deskripsi'    => 'Lorem',
                'slug'    => 'snack',
                'img'    => 'ICON CATEGORY-09.png',
            ],
            [
                'id_kategori' => 10,
                'nama_kategori' => 'Roti',
                'deskripsi'    => 'Lorem',
                'slug'    => 'roti',
                'img'    => 'ICON CATEGORY-10.png',
            ],
            [
                'id_kategori' => 11,
                'nama_kategori' => 'Susu & Olahan',
                'deskripsi'    => 'Lorem',
                'slug'    => 'susu-dan-olahan',
                'img'    => 'ICON CATEGORY-11.png',
            ],
            [
                'id_kategori' => 12,
                'nama_kategori' => 'Minyak',
                'deskripsi'    => 'Lorem',
                'slug'    => 'minyak',
                'img'    => 'ICON-CATEGORY-12.png',
            ],
            [
                'id_kategori' => 13,
                'nama_kategori' => 'Minuman Kopi & Teh',
                'deskripsi'    => 'Lorem',
                'slug'    => 'minuman-kopi-dan-teh',
                'img'    => 'ICON CATEGORY-13.png',
            ],
            [
                'id_kategori' => 14,
                'nama_kategori' => 'Dumpling & Makanan Beku',
                'deskripsi'    => 'Lorem',
                'slug'    => 'dumpling-dan-makanan-beku',
                'img'    => 'ICON CATEGORY-14.png',
            ],
            [
                'id_kategori' => 15,
                'nama_kategori' => 'Kosmetik',
                'deskripsi'    => 'Lorem',
                'slug'    => 'Kosmetik',
                'img'    => 'ICON CATEGORY-15.png',
            ],
            [
                'id_kategori' => 16,
                'nama_kategori' => 'Peralatan Dapur',
                'deskripsi'    => 'Lorem',
                'slug'    => 'peralatan-dapur',
                'img'    => 'ICON CATEGORY-16.png',
            ]
        ];

        $this->db->table('jsf_kategori')->insertBatch($data);

        $data2 = [
            [
                'id_kategori' => 8,
                'nama_kategori' => 'MIE KOREA',
                'deskripsi'    => 'Lorem',
                'slug'    => 'mie-korea',
            ],
            [
                'id_kategori' => 8,
                'nama_kategori' => 'MIE INDONESIA',
                'deskripsi'    => 'Lorem',
                'slug'    => 'mie-indonesia',
            ],
            [
                'id_kategori' => 8,
                'nama_kategori' => 'MIE JEPANG',
                'deskripsi'    => 'Lorem',
                'slug'    => 'mie-jepang',
            ],
            [
                'id_kategori' => 1,
                'nama_kategori' => 'ACAR',
                'deskripsi'    => 'Lorem',
                'slug'    => 'acar',
            ],
            [
                'id_kategori' => 1,
                'nama_kategori' => 'KIMCHI',
                'deskripsi'    => 'Lorem',
                'slug'    => 'kimci',
            ],
            [
                'id_kategori' => 9,
                'nama_kategori' => 'NORI',
                'deskripsi'    => 'Lorem',
                'slug'    => 'nori',
            ],
            [
                'id_kategori' => 9,
                'nama_kategori' => 'SNACK KOREA',
                'deskripsi'    => 'Lorem',
                'slug'    => 'snack-korea',
            ],
            [
                'id_kategori' => 3,
                'nama_kategori' => 'SAYUR SEGAR',
                'deskripsi'    => 'Lorem',
                'slug'    => 'sayuran-segar',
            ],
            [
                'id_kategori' => 3,
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
                'id_kategori' => 5,
                'nama_kategori' => 'SAPI',
                'deskripsi'    => 'Lorem',
                'slug'    => 'sapi',
            ],
            [
                'id_kategori' => 5,
                'nama_kategori' => 'AYAM',
                'deskripsi'    => 'Lorem',
                'slug'    => 'ayam',
            ],
            [
                'id_kategori' => 5,
                'nama_kategori' => 'BEBEK',
                'deskripsi'    => 'Lorem',
                'slug'    => 'bebek',
            ],
            [
                'id_kategori' => 5,
                'nama_kategori' => 'BABI',
                'deskripsi'    => 'Lorem',
                'slug'    => 'babi',
            ],
        ];

        $this->db->table('jsf_sub_kategori')->insertBatch($data2);
    }
}
