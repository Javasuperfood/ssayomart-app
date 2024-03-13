<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfPromoProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
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
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'created_at' => [
                'type'        => 'timestamp',
                'null'        => true,
            ],
            'updated_at' => [
                'type'   => 'timestamp',
                'null'   => true
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_promo', 'jsf_promo', 'id_promo', true, 'CASCADE');
        $this->forge->addForeignKey('id_produk', 'jsf_produk', 'id_produk', true, 'CASCADE');
        $this->forge->createTable('jsf_promo_produk');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_promo_produk');
    }
}
