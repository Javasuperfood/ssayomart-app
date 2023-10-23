<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Blog extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_blog'           => 1,
                'judul_blog'        => 'Bulgogi',
                'tanggal_dibuat'    => '2023-10-14 03:08:51',
                'img_thumbnail'     => 'blog-1.png',
                'slug'              => 'bulgogi',
                'created_by'        => 1,
                'link_video'        => 'https://www.youtube.com/watch?v=Oq1LZhiaYYk',
                'isi_blog'          => ''
            ],
            [
                'id_blog'           => 2,
                'judul_blog'        => 'Ramen',
                'tanggal_dibuat'    => '2023-10-14 03:24:07',
                'img_thumbnail'     => 'blog-2.png',
                'slug'              => 'ramen',
                'created_by'        => 1,
                'link_video'        => 'https://www.youtube.com/watch?v=DynZrC5VikU',
                'isi_blog'          => ''
            ],

            [
                'id_blog'           => 3,
                'judul_blog'        => 'Toppoki',
                'tanggal_dibuat'    => '2023-10-14 03:36:52',
                'img_thumbnail'     => 'blog-3.png',
                'slug'              => 'toppoki',
                'created_by'        => 1,
                'link_video'        => 'https://www.youtube.com/watch?v=I5mioCFF6oA',
                'isi_blog'          => ''
            ]
        ];
        $this->db->table('jsf_blog')->insertBatch($data);
    }
}
