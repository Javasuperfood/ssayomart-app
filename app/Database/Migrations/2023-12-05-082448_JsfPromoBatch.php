<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfPromoBatch extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_promo_item_batch' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_promo' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'id_produk' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'       => true,
            ],
            'discount' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => 0.00,
            ],
            'min' => [
                'type' => 'int',
                'constraint'     => 11,
                'null' => true,
            ],
            'created_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ], 'updated_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ],
        ]);
        $this->forge->addKey('id_promo_item_batch', true);
        // $this->forge->addForeignKey('id_produk', 'jsf_produk', 'id_produk');
        $this->forge->addForeignKey('id_produk', 'jsf_produk', 'id_produk');
        $this->forge->createTable('jsf_promo_batch');
    }

    public function down()
    {

        $this->forge->dropTable('jsf_promo_batch');
    }
}
