<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfPembelian extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pembelian' => [
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
            'id_kupon' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'payment_link' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255'
            ],
            'qty_produk' => [
                'type'          => 'INT',
                'constraint'    => 11
            ],
            'harga' => [
                'type'          => 'varchar',
                'constraint'    => '200'
            ],
            'total_harga' => [
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
        $this->forge->addKey('id_pembelian', true);
        $this->forge->addForeignKey('id_user', 'users', 'id');
        $this->forge->addForeignKey('id_produk', 'jsf_produk', 'id_produk');
        $this->forge->addForeignKey('id_kupon', 'jsf_kupon', 'id_kupon');
        $this->forge->createTable('jsf_pembelian');
    }

    public function down()
    {
        $this->forge->dropForeignKey('jsf_pembelian', 'id');
        $this->forge->dropForeignKey('jsf_pembelian', 'id_produk');
        $this->forge->dropForeignKey('jsf_pembelian', 'id_kupon');

        $this->forge->dropTable('jsf_pembelian');
    }
}
