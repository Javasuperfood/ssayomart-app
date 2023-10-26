<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfSubKategoriProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_sub_kategori_produk' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_produk' => [
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
            ]
        ]);
        $this->forge->addKey('id_sub_kategori_produk', true);
        $this->forge->addForeignKey('id_produk', 'jsf_produk', 'id_produk', true, 'CASCADE');
        $this->forge->addForeignKey('id_sub_kategori', 'jsf_sub_kategori', 'id_sub_kategori', true, 'CASCADE');

        $this->forge->createTable('jsf_sub_kategori_produk');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_sub_kategori_produk');
    }
}
