<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterAuthGroupUsers extends Migration
{
    public function up()
    {
        $fields = [
            'updated_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ],

        ];
        $this->forge->addColumn('auth_groups_users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('auth_groups_users', ['timestamp']);
    }
}
