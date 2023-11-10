<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfDeleteAccountUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_request_delete' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'        => 'INT',
                'constraint'  => 11,
                'unsigned'    => true,
            ],
            'alasan' => [
                'type'        => 'varchar',
                'constraint'  => '255',

            ],
            'created_at' => [
                'type'        => 'timestamp',
                'null'        => true,
            ],
            'updated_at' => [
                'type'   => 'timestamp',
                'null'   => true
            ]
        ]);
        $this->forge->addKey('id_request_delete', true);
        $this->forge->addForeignKey('id_user', 'users', 'id');
        $this->forge->createTable('jsf_request_delete');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_request_delete');
    }
}
