<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfKurir extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kurir' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_kurir' => [
                'type'        => 'varchar',
                'constraint'  => '150',
            ],
            'value_kurir' => [
                'type'        => 'varchar',
                'constraint'  => '150',
            ],
            'created_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ],
            'updated_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ],
        ]);
        $this->forge->addKey('id_kurir', true);
        $this->forge->createTable('jsf_kurir');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_kurir');
    }
}
