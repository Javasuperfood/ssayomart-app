<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfVariasiProduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_variasi_produk' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_produk' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'value' => [
                'type'       => 'VARCHAR',
                'constraint' => '225',
            ],
            'harga' => [
                'type'          => 'varchar',
                'constraint'    => '225'
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
        $this->forge->addKey('id_variasi_produk', true);
        $this->forge->addForeignKey('id_produk', 'jsf_produk', 'id_produk', true, 'CASCADE');
        $this->forge->createTable('jsf_variasi_produk');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_variasi_produk');
    }
}
