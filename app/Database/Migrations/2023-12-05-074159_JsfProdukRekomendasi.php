<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfProdukRekomendasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rekomendasi' => [
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
            'short' => [
                'type'        => 'INT',
                'constraint' => 11,
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
        $this->forge->addKey('id_rekomendasi', true);
        $this->forge->addForeignKey('id_produk', 'jsf_produk', 'id_produk', true, 'CASCADE');
        $this->forge->createTable('jsf_produk_rekomendasi');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_produk_rekomendasi');
    }
}
