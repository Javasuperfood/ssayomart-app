<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterCheckoutProduk extends Migration
{
    public function up()
    {

        $fields = [
            'id_variasi_item' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'after' => 'id_produk'
            ]

        ];
        $this->forge->addColumn('jsf_checkout_produk', $fields);
        $this->forge->addForeignKey('id_variasi_item', 'jsf_variasi_item', 'id_variasi_item', true, 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_checkout_produk', ['id_variasi_item']);
    }
}
