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
                'img'    => 'ICON CATEGORY-12.png',
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
                'nama_kategori' => '국물 라면 / RAMEN KUAH',
                'deskripsi'    => 'Lorem',
                'slug'    => '국물-라면-RAMEN-KUAH',
            ],
            [
                'id_kategori' => 8,
                'nama_kategori' => '볶음 라면 / RAMEN GORENG',
                'deskripsi'    => 'Lorem',
                'slug'    => '볶음-라면-RAMEN-GORENG',
            ],
            // [
            //     'id_kategori' => 8,
            //     'nama_kategori' => 'MIE JEPANG',
            //     'deskripsi'    => 'Lorem',
            //     'slug'    => 'mie-jepang',
            // ],
            [
                'id_kategori' => 1,
                'nama_kategori' => '김치 / KIMCHI',
                'deskripsi'    => 'Lorem',
                'slug'    => '김치-KIMCHI',
            ],
            [
                'id_kategori' => 1,
                'nama_kategori' => '반찬 / MAKANAN PENDAMPING',
                'deskripsi'    => 'Lorem',
                'slug'    => '반찬-MAKANAN-PENDAMPING',
            ],
            [
                'id_kategori' => 9,
                'nama_kategori' => '비스킷 / BISKUIT',
                'deskripsi'    => 'Lorem',
                'slug'    => '비스킷-BISKUIT',
            ],
            [
                'id_kategori' => 9,
                'nama_kategori' => '쿠키 / COOKIE',
                'deskripsi'    => 'Lorem',
                'slug'    => '쿠키-COOKIE',
            ],
            [
                'id_kategori' => 9,
                'nama_kategori' => '파이 / PIE',
                'deskripsi'    => 'Lorem',
                'slug'    => '파이-PIE',
            ],
            [
                'id_kategori' => 3,
                'nama_kategori' => '과일 / BUAH',
                'deskripsi'    => 'Lorem',
                'slug'    => '과일-BUAH',
            ],
            [
                'id_kategori' => 3,
                'nama_kategori' => '채소 / SAYUR',
                'deskripsi'    => 'Lorem',
                'slug'    => '채소-SAYUR',
            ],
            // [
            //     'id_kategori' => 3,
            //     'nama_kategori' => 'BUAH-BUAHAN',
            //     'deskripsi'    => 'Lorem',
            //     'slug'    => 'buah-buahan',
            // ],
            [
                'id_kategori' => 6,
                'nama_kategori' => '생선 / IKAN',
                'deskripsi'    => 'Lorem',
                'slug'    => '생선-IKAN',
            ],
            [
                'id_kategori' => 6,
                'nama_kategori' => '조개 / KERANG',
                'deskripsi'    => 'Lorem',
                'slug'    => '조개-KERANG',
            ],
            // [
            //     'id_kategori' => 6,
            //     'nama_kategori' => 'UDANG',
            //     'deskripsi'    => 'Lorem',
            //     'slug'    => 'udang',
            // ],
            [
                'id_kategori' => 6,
                'nama_kategori' => '오징어 / CUMI',
                'deskripsi'    => 'Lorem',
                'slug'    => '오징어-CUMI',
            ],
            [
                'id_kategori' => 5,
                'nama_kategori' => '소고기 / DAGING SAPI',
                'deskripsi'    => 'Lorem',
                'slug'    => '소고기-DAGING-SAPI',
            ],
            [
                'id_kategori' => 5,
                'nama_kategori' => '닭고기 / DAGING AYAM',
                'deskripsi'    => 'Lorem',
                'slug'    => '닭고기-DAGING-AYAM',
            ],
            [
                'id_kategori' => 5,
                'nama_kategori' => '돼지고기 / DAGING BABI',
                'deskripsi'    => 'Lorem',
                'slug'    => '돼지고기-DAGING-BABI',
            ],
            [
                'id_kategori' => 5,
                'nama_kategori' => '계란 / TELUR',
                'deskripsi'    => 'Lorem',
                'slug'    => '계란-TELUR',
            ],
            [
                'id_kategori' => 2,
                'nama_kategori' => '김 / NORI',
                'deskripsi'    => 'Lorem',
                'slug'    => '김-NORI',
            ],
            [
                'id_kategori' => 10,
                'nama_kategori' => '빵 / ROTI',
                'deskripsi'    => 'Lorem',
                'slug'    => '빵-ROTI',
            ],
            [
                'id_kategori' => 11,
                'nama_kategori' => '우유 / SUSU',
                'deskripsi'    => 'Lorem',
                'slug'    => '우유-SUSU',
            ],
            [
                'id_kategori' => 11,
                'nama_kategori' => '두유 / SUSU KEDELAI',
                'deskripsi'    => 'Lorem',
                'slug'    => '두유-SUSU KEDELAI',
            ],
            [
                'id_kategori' => 11,
                'nama_kategori' => '치즈 / KEJU',
                'deskripsi'    => 'Lorem',
                'slug'    => '치즈-KEJU',
            ],
            [
                'id_kategori' => 12,
                'nama_kategori' => '튀김용 / UNTUK GORENGAN',
                'deskripsi'    => 'Lorem',
                'slug'    => '튀김용-UNTUK-GORENGAN',
            ],
            [
                'id_kategori' => 12,
                'nama_kategori' => '요리용 / UNTUK MASAKAN',
                'deskripsi'    => 'Lorem',
                'slug'    => '요리용-UNTUK-MASAKAN',
            ],
            [
                'id_kategori' => 12,
                'nama_kategori' => '건강용 / UNTUK SEHAT',
                'deskripsi'    => 'Lorem',
                'slug'    => '건강용-UNTUK-SEHAT',
            ],
            [
                'id_kategori' => 13,
                'nama_kategori' => '음료 / MINUMAN',
                'deskripsi'    => 'Lorem',
                'slug'    => '음료-MINUMAN',
            ],
            [
                'id_kategori' => 13,
                'nama_kategori' => '커피 / KOPI',
                'deskripsi'    => 'Lorem',
                'slug'    => '커피-KOPI',
            ],
            [
                'id_kategori' => 13,
                'nama_kategori' => '차 / TEH',
                'deskripsi'    => 'Lorem',
                'slug'    => '차-TEH',
            ],
            [
                'id_kategori' => 14,
                'nama_kategori' => '만두 / DUMPLING',
                'deskripsi'    => 'Lorem',
                'slug'    => '만두-DUMPLING',
            ],
            [
                'id_kategori' => 14,
                'nama_kategori' => '냉동식품 / MAKANAN BEKU',
                'deskripsi'    => 'Lorem',
                'slug'    => '냉동식품-MAKANAN BEKU',
            ],
            [
                'id_kategori' => 15,
                'nama_kategori' => '샴푸 / SHAMPOO',
                'deskripsi'    => 'Lorem',
                'slug'    => '샴푸-SHAMPOO',
            ],
            [
                'id_kategori' => 15,
                'nama_kategori' => '비누 / SABUN',
                'deskripsi'    => 'Lorem',
                'slug'    => '비누-SABUN',
            ],
            [
                'id_kategori' => 15,
                'nama_kategori' => '칫솔, 치약 / SIKAT GIGI, PASTA GIGI',
                'deskripsi'    => 'Lorem',
                'slug'    => '칫솔-치약-SIKAT GIGI-PASTA GIGI',
            ],
            [
                'id_kategori' => 16,
                'nama_kategori' => '밀폐용기 / KONTAINER',
                'deskripsi'    => 'Lorem',
                'slug'    => '밀폐용기 / KONTAINER',
            ],
            [
                'id_kategori' => 16,
                'nama_kategori' => '팬 / PANCI',
                'deskripsi'    => 'Lorem',
                'slug'    => '팬-PANCI',
            ],
            [
                'id_kategori' => 16,
                'nama_kategori' => '뚝배기 / TUKBAEGI',
                'deskripsi'    => 'Lorem',
                'slug'    => '뚝배기-TUKBAEGI',
            ],
        ];

        $this->db->table('jsf_sub_kategori')->insertBatch($data2);
    }
}
