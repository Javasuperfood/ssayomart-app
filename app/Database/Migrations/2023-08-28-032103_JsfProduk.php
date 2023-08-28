<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_produk' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_kategori' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '225',
            ],
            'slug' => [
                'type'          => 'varchar',
                'constraint'    => '225'
            ],
            'sku' => [
                'type'          => 'varchar',
                'constraint'    => '225'
            ],
            'harga' => [
                'type'          => 'varchar',
                'constraint'    => '225'
            ],
            'id_inventory' => [
                'type'          => 'INT',
                'constraint'    => 11
            ],
            'deskripsi' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'gambar' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'created_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ], 'updated_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ],
            'created_by' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'null'          => true
            ],
        ]);
        $this->forge->addKey('id_produk', true);
        $this->forge->addForeignKey('id_kategori', 'jsf_kategori', 'id_kategori');
        $this->forge->createTable('jsf_produk');
    }

    public function down()
    {
        $this->forge->dropForeignKey('jsf_produk', 'id_kategori');

        $this->forge->dropTable('jsf_produk');
    }
}
