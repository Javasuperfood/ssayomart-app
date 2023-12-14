<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfStock extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_stock' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_produk' => [
                'type'        => 'INT',
                'constraint'  => 11,
                'unsigned'    => true,
            ],
            'id_variasi_item' => [
                'type'        => 'INT',
                'constraint'  => 11,
                'unsigned'    => true,
            ],
            'id_toko' => [
                'type'        => 'INT',
                'constraint'  => 11,
                'unsigned'    => true,
            ],
            'stok' => [
                'type'        => 'INT',
                'constraint' => '12',
            ],
            'created_at' => [
                'type'        => 'timestamp',
                'null'        => true,
            ],
            'updated_at' => [
                'type'   => 'timestamp',
                'null'   => true
            ],
            'update_by' => [
                'type'        => 'INT',
                'constraint'  => 11,
                'unsigned'    => true,
            ]
        ]);
        $this->forge->addKey('id_stock', true);
        $this->forge->addForeignKey('id_produk', 'jsf_produk', 'id_produk', true, 'CASCADE');
        $this->forge->addForeignKey('id_variasi_item', 'jsf_variasi_item', 'id_variasi_item', true, 'CASCADE');
        $this->forge->addForeignKey('id_toko', 'jsf_toko', 'id_toko', true, 'CASCADE');
        $this->forge->createTable('jsf_stock');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_stock');
    }
}
