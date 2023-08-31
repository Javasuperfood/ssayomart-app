<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfCart extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_cart' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'total' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'created_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ], 'updated_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ],
        ]);
        $this->forge->addKey('id_cart', true);
        $this->forge->addForeignKey('id_user', 'users', 'id');
        $this->forge->createTable('jsf_cart');
    }

    public function down()
    {
        $this->forge->dropForeignKey('jsf_users', 'id');

        $this->forge->dropTable('jsf_cart');
    }
}
