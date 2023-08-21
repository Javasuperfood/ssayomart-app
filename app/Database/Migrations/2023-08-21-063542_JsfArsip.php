<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfArsip extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_arsip' => [
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
            'id_produk' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'id_pembelian' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'created_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ],'updated_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ],
        ]);
        $this->forge->addKey('id_arsip', true);
        $this->forge->createTable('jsf_arsip');
        $this->forge->addForeignKey('id_user', 'users', 'id');
        $this->forge->addForeignKey('id_produk', 'jsf_produk', 'id_produk');
        $this->forge->addForeignKey('id_pembelian', 'jsf_pembelian', 'id_pembelian');      
    }

    public function down()
    {
        $this->forge->dropForeignKey('jsf_arsip', 'id');
        $this->forge->dropForeignKey('jsf_arsip', 'id_produk');
        $this->forge->dropForeignKey('jsf_arsip', 'id_pembelian');

        $this->forge->dropTable('jsf_arsip');
    }
}
