<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableJsfProduk extends Migration
{
    public function up()
    {
        $fields = [
            'brand' => [
                'type'           => 'varchar',
                'constraint'     => 255,
                'after'          => 'id_sub_kategori',
                'null'           => true,
            ],
        ];
        $this->forge->addColumn('jsf_produk', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_produk', ['brand']);
    }
}
