<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterProduk_bahasa extends Migration
{
    public function up()
    {
        $fields = [
            'nama_en' => [
                'type'           => 'varchar',
                'constraint'     => 255,
                'after'          => 'nama',
                'null'           => true,
            ],
            'nama_kr' => [
                'type'           => 'varchar',
                'constraint'     => 255,
                'after'          => 'nama_en',
                'null'           => true,
            ],
        ];
        $this->forge->addColumn('jsf_produk', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_produk', ['nama_en', 'nama_kr']);
    }
}
