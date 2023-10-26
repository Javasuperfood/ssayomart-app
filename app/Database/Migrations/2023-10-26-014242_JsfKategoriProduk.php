<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfKategoriProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kategori_produk' => [
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
            'id_kategori' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null' => true
            ]

        ]);
        $this->forge->addKey('id_kategori_produk', true);

        $this->forge->addForeignKey('id_produk', 'jsf_produk', 'id_produk', true, 'CASCADE');
        $this->forge->addForeignKey('id_kategori', 'jsf_kategori', 'id_kategori', true, 'CASCADE');


        $this->forge->createTable('jsf_kategori_produk');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_kategori_produk');
    }
}
