<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfCheckoutProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_checkout_produk' => [
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
            'id_produk' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'qty' => [
                'type'           => 'INT',
                'constraint'     => 11,
            ],
            'harga' => [
                'type'           => 'varchar',
                'constraint'     => 225,
            ],
            'created_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ], 'updated_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ],
        ]);
        $this->forge->addKey('id_checkout_produk', true);
        $this->forge->addForeignKey('id_checkout', 'jsf_checkout', 'id_checkout');
        $this->forge->addForeignKey('id_produk', 'jsf_produk', 'id_produk');

        $this->forge->createTable('jsf_checkout_produk');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_checkout_produk');
    }
}
