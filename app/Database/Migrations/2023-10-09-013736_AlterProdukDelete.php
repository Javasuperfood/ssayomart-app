<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterProdukDelete extends Migration
{
    public function up()
    {
        $fields = [
            'deleted_at' => [
                'type'          => 'timestamp',
                'null'          => true,
                'after' => 'updated_at'
            ],
            'updated_by' => [
                'type'          => 'timestamp',
                'null'          => true,
                'after' => 'created_by'
            ]

        ];
        $this->forge->addColumn('jsf_produk', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_produk', ['deleted_at']);
    }
}
