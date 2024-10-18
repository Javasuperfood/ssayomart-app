<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterProdukBahasaNew extends Migration
{
    public function up()
    {
        $fields = [
            'nama_en' => [
                'type'           => 'varchar',
                'constraint'     => 255,
                'null'           => true,
                'after'          => 'nama'
            ],
            'nama_kr' => [
                'type'           => 'varchar',
                'constraint'     => 255,
                'null'           => true,
                'after'          => 'nama_en'
            ],
        ];
        $this->forge->addColumn('jsf_produk', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_produk', ['nama_en', 'nama_kr']);
    }
}
