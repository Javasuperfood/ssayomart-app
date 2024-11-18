<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTableJsfProduk extends Migration
{
    public function up()
    {
        $fields = [
            'sort' => [
                'type'          => 'int',
                'constraint'     => 11,
                'null' => true,
                'after' => 'img'
            ]
        ];
        $this->forge->addColumn('jsf_produk', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_produk', ['sort']);
    }
}
