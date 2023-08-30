<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterProduk extends Migration
{
    public function up()
    {
        $this->forge->addColumn('jsf_produk', [
            'id_sub_kategori' => [
                'type'           => 'INT',
                'constraint'     => '11',
                'unsigned'       => 'true',
                'null'           => 'true'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_produk', 'id_sub_kategori');
    }
}
