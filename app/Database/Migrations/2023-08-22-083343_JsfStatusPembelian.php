<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfStatusPembelian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_status_pembelian' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'status_pembelian' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'deskripsi' => [
                'type'          => 'varchar',
                'constraint'    => '200'
            ],
            'created_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ], 'updated_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ],
        ]);
        $this->forge->addKey('id_status_pembelian', true);

        $this->forge->createTable('jsf_status_pembelian');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_status_pembelian');
    }
}
