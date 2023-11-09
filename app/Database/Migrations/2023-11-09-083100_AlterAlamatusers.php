<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterAlamatusers extends Migration
{
    public function up()
    {
        $fields = [
            'alamat_3' => [
                'type' => 'text',
                'null' => true,
                'after' => 'alamat_2'
            ],
            'latitude' => [
                'type' => 'decimal(10,8)',
                'null' => true,
                'after' => 'telp2'
            ],
            'longitude' => [
                'type' => 'decimal(11,8)',
                'null' => true,
                'after' => 'latitude'
            ]

        ];
        $this->forge->addColumn('jsf_alamat_users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_alamat_users', ['alamat_3, latitude, longitude']);
    }
}
