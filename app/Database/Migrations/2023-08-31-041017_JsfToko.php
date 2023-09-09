<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfToko extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_toko' => [
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
            'deskripsi' => [
                'type'        => 'text',
                'null'        => true
            ],
            'alamat_1' => [
                'type'        => 'text',
            ],
            'alamat_2' => [
                'type'        => 'text',
                'null'        => true
            ],

            'id_province' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'province' => [
                'type'        => 'varchar',
                'constraint'  => '225',
            ],
            'id_city' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true
            ],
            'city' => [
                'type'        => 'varchar',
                'constraint' => '225',
            ],
            'zip_code' => [
                'type'        => 'INT',
                'constraint' => '11',

            ],
            'telp' => [
                'type'        => 'varchar',
                'constraint' => '225',

            ],
            'telp2' => [
                'type'        => 'varchar',
                'constraint' => '225',
                'null'          => true
            ],
            'created_at' => [
                'type'        => 'timestamp',
                'null'        => true,
            ],
            'update_at' => [
                'type'   => 'timestamp',
                'null'   => true
            ],
        ]);
        $this->forge->addKey('id_toko', true);
        $this->forge->addForeignKey('id_user', 'users', 'id');
        $this->forge->createTable('jsf_toko');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_toko');
    }
}
