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
            'nama_produk' => [
                'type'       => 'VARCHAR',
                'constraint' => '225',
            ],
            'harga_produk' => [
                'type'          => 'varchar',
                'constraint'    => '100'
            ],
            'deskripsi_produk' => [
                'type'          => 'varchar',
                'constraint'    => '200'
            ],
            'stock_produk' => [
                'type'          => 'INT',
                'constraint'    => 11
            ],
            'gambar_produk' => [
                'type'          => 'varchar',
                'constraint'    => '255'
            ],
            'slug' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'created_by' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'null'          => true
            ],
            'created_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ], 'updated_at' => [
                'type'          => 'timestamp',
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
