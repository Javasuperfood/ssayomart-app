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
            'id_produk' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'nama_produk' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'harga_produk' => [
                'type'          => 'INT',
                'constraint'    => 11
            ],
            'harga_produk' => [
                'type'          => 'INT',
                'constraint'    => 11
            ],
            'gambar_produk' => [
                'type'          => 'INT',
                'constraint'    => 11
            ],
            'created_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ],'updated_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ]
            
        ]);
        $this->forge->addKey('id_cart', true);

        $this->forge->createTable('jsf_cart');

        $this->forge->addForeignKey('id_user', 'users', 'id');
        $this->forge->addForeignKey('id_produk', 'jsf_produk', 'id_produk');
        $this->forge->addForeignKey('nama_produk', 'jsf_produk', 'nama_produk');
        $this->forge->addForeignKey('harga_produk', 'jsf_produk', 'harga_produk');
        $this->forge->addForeignKey('stock_produk', 'jsf_produk', 'stock_produk');
        $this->forge->addForeignKey('gambar_produk', 'jsf_produk', 'gambar_produk');
    }

    public function down()
    {
        $this->forge->dropForeignKey('jsf_cart', 'id');
        $this->forge->dropForeignKey('jsf_cart', 'id_produk');
        $this->forge->dropForeignKey('jsf_cart', 'nama_produk');
        $this->forge->dropForeignKey('jsf_cart', 'harga_produk');
        $this->forge->dropForeignKey('jsf_cart', 'stock_produk');
        $this->forge->dropForeignKey('jsf_cart', 'gambar_produk');

        $this->forge->dropTable('jsf_cart');
    }
}
