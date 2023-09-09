<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfWishlistProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_wishlist_produk' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_wishlist' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'id_produk' => [
                'type'       => 'INT',
                'constraint' => 11,
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
        $this->forge->addKey('id_wishlist_produk', true);
        $this->forge->addForeignKey('id_wishlist', 'jsf_wishlist', 'id_wishlist');
        $this->forge->createTable('jsf_wishlist_produk');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_wishlist_produk');
    }
}
