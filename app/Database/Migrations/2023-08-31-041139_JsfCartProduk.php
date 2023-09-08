<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfCartProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_cart_produk' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_cart' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'id_produk' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'qty' => [
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
        $this->forge->addKey('id_cart_produk', true);
        $this->forge->addForeignKey('id_cart', 'jsf_cart', 'id_cart');
        $this->forge->createTable('jsf_cart_produk');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_cart_produk');
    }
}
