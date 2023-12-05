<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterProdukShorting extends Migration
{
    public function up()
    {
        $fields = [
            'short' => [
                'type'          => 'INT',
            ]
        ];
        $this->forge->addColumn('jsf_produk', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_produk', ['short']);
    }
}
