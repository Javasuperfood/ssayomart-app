<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AdminToko extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_admin_toko' => [
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
            'id_toko' => [
                'type'        => 'INT',
                'constraint'  => 11,
                'unsigned'    => true,

            ],
            'created_by' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'updated_by' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'   => false
            ],
            'created_at' => [
                'type'        => 'timestamp',
                'null'        => false,
                'null'        => true,
            ],
            'updated_at' => [
                'type'   => 'timestamp',
                'null'   => true
            ],
        ]);
        $this->forge->addKey('id_admin_toko', true);
        $this->forge->addForeignKey('id_user', 'users', 'id');
        $this->forge->addForeignKey('id_toko', 'jsf_toko', 'id_toko');
        $this->forge->createTable('jsf_admin_toko');
    }

    public function down()
    {
        $this->forge->dropForeignKey('jsf_admin_toko', 'jsf_admin_toko_id_user_foreign');
        $this->forge->dropForeignKey('jsf_admin_toko', 'jsf_admin_toko_id_toko_foreign');
        $this->forge->dropTable('jsf_admin_toko');
    }
}
