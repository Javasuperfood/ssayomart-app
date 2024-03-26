<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterPromoProduk2 extends Migration
{
    public function up()
    {
        $fields = [
            'required_quantity' => [
                'type'           => 'INT',
                'constraint'     => '10',
                'after'          => 'promo_deskripsi',
            ],

        ];
        $this->forge->addColumn('jsf_promo_produk', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_promo_produk', ['required_quantity']);
    }
}
