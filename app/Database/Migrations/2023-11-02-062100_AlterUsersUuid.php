<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUsersUuid extends Migration
{
    public function up()
    {
        $fields = [
            'uuid' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
                'after' => 'id'
            ]

        ];
        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['uuid']);
    }
}
