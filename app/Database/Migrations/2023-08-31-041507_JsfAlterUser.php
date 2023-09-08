<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUser extends Migration
{
    public function up()
    {

        $fields = [
            'fullname' => [
                'type' => 'varchar',
                'constraint' => '225',
                'null' => true,
                'after' => 'username'
            ],
            'telp' => [
                'type' => 'varchar',
                'constraint' => '13',
                'null' => true,
                'after' => 'fullname'
            ]
        ];
        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['fullname', 'telp']);
    }
}
