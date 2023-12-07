<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterMarket extends Migration
{
    public function up()
    {
        $fields = [
            'latitude' => [
                'type' => 'decimal(10,8)',
                'null' => true,
                'after' => 'telp2'
            ],
            'longitude' => [
                'type' => 'decimal(11,8)',
                'null' => true,
                'after' => 'latitude'
            ],

        ];
        $this->forge->addColumn('jsf_toko', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_toko', ['latitude', 'longitude']);
    }
}
