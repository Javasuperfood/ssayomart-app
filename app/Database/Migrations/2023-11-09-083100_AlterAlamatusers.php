<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterAlamatusers extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('jsf_alamat_users', ['update_at']);
        $fields = [
            'alamat_3' => [
                'type' => 'text',
                'null' => true,
                'after' => 'alamat_2'
            ],
            'latitude' => [
                'type' => 'decimal(9,6)',
                'null' => true,
                'after' => 'telp2'
            ],
            'longitude' => [
                'type' => 'decimal(10,6)',
                'null' => true,
                'after' => 'latitude'
            ],
            'updated_at' => [
                'type' => 'timestamp',
                'null' => true,
                'after' => 'created_at'
            ],


        ];
        $this->forge->addColumn('jsf_alamat_users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_alamat_users', ['alamat_3, latitude, longitude, updated_at']);
        $fields = [
            'update_at' => [
                'type' => 'timestamp',
                'null' => true,
                'after' => 'created_at'
            ],

        ];
        $this->forge->addColumn('jsf_alamat_users', $fields);
    }
}
