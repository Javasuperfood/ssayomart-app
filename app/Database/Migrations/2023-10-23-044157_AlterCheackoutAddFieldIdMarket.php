<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterCheackoutAddFieldIdMarket extends Migration
{
    public function up()
    {
        $fields = [
            'id_toko' => [
                'type' => 'int',
                'constraint' => 11,
                'after' => 'id_checkout'
            ]
        ];
        $this->forge->addColumn('jsf_checkout', $fields);
    }
    public function down()
    {
        $this->forge->dropColumn('jsf_checkout', ['id_toko']);
    }
}
