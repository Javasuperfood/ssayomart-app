<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterSubKategori extends Migration
{
    public function up()
    {
        $fields = [
            'nama_kategori_en' => [
                'type'           => 'varchar',
                'constraint'     => 255,
                'after'          => 'nama_kategori'
            ],
            'nama_kategori_kr' => [
                'type'           => 'varchar',
                'constraint'     => 255,
                'after'          => 'nama_kategori_en'
            ],
        ];
        $this->forge->addColumn('jsf_sub_kategori', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_sub_kategori', ['nama_kategori_en', 'nama_kategori_kr']);
    }
}
