<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfGudang extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_gudang' => [
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
            'id_toko' => [
                'type'        => 'INT',
                'constraint'  => 11,
                'unsigned'    => true,

            ],
            'stok' => [
                'type'        => 'INT',
                'constraint' => '12',
                'default' => 0
            ],
            'created_at' => [
                'type'        => 'timestamp',
                'null'        => true,
            ],
            'update_at' => [
                'type'   => 'timestamp',
                'null'   => true
            ],
        ]);
        $this->forge->addKey('id_gudang', true);
        $this->forge->addForeignKey('id_produk', 'jsf_produk', 'id_produk');
        $this->forge->addForeignKey('id_toko', 'jsf_toko', 'id_toko');
        $this->forge->createTable('jsf_gudang');
    }

    public function down()
    {
        $this->forge->dropForeignKey('jsf_gudang', 'id_toko');
        $this->forge->dropForeignKey('jsf_gudang', 'id_produk');
        $this->forge->dropTable('jsf_gudang');
    }
}
