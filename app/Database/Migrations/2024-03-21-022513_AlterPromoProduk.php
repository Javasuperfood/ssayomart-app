<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterPromoProduk extends Migration
{
    public function up()
    {
        $fields = [
            'promo_img' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'after'          => 'id_produk',
                'default'        => 'default.png'
            ],
            'promo_deskripsi' => [
                'type'           => 'VARCHAR',
                'constraint'     => '255',
                'after'          => 'promo_img'
            ],
        ];
        $this->forge->addColumn('jsf_promo_produk', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_promo_produk', ['promo_img', 'promo_deskripsi']);
    }
}
