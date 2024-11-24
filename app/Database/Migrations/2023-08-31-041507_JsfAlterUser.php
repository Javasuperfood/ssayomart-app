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
            'img' => [
                'type' => 'varchar',
                'constraint' => '225',
                'null' => true,
                'after' => 'fullname',
                'default' => 'default.png'
            ],
            'telp' => [
                'type' => 'varchar',
                'constraint' => '13',
                'null' => true,
                'after' => 'img'
            ],

        ];
        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', ['fullname', 'telp']);
    }
}
