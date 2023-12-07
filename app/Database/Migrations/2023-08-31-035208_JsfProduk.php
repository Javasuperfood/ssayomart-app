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
                'null' => true
            ],
            'id_sub_kategori' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true
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
                'constraint'    => '225',
                'null' => true
            ],
            'harga' => [
                'type'          => 'varchar',
                'constraint'    => '225'
            ],
            'deskripsi' => [
                'type'          => 'TEXT'
            ],
            'img' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'default'       => 'default.png'
            ],
            'is_active' => [
                'type' => 'int',
                'constraint' => 2,
                'default' => 1
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
        $this->forge->addForeignKey('id_kategori', 'jsf_kategori', 'id_kategori', true, 'CASCADE');
        $this->forge->addForeignKey('id_sub_kategori', 'jsf_sub_kategori', 'id_sub_kategori', true, 'CASCADE');

        $this->forge->createTable('jsf_produk');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_produk');
    }
}
