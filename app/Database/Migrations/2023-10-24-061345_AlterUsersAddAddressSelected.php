<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUsersAddAddressSelected extends Migration
{
    public function up()
    {
        $fields = [
            'address_selected' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => true,
                'after' => 'avatar'
            ]

        ];
        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['address_selected']);
    }
}
