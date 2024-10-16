<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableNotification extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_checkout' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'order_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'message' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'is_read' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 0,
            ],
            'created_at' => [
                'type'       => 'timestamp',
                'null' => true
            ],
            'updated_at' => [
                'type'       => 'timestamp',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_checkout', 'jsf_checkout', 'id_checkout');
        $this->forge->addForeignKey('id_user', 'users', 'id');
        $this->forge->createTable('jsf_notification');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_notification');
    }
}
