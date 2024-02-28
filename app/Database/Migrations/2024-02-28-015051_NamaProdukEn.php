<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NamaProdukEn extends Migration
{
    public function up()
    {
        $fields = [
            'nama_en' => [
                'type'           => 'varchar',
                'constraint'     => 255,
            ],
            'nama_kr' => [
                'type'           => 'varchar',
                'constraint'     => 255,
            ],
        ];
        $this->forge->addColumn('jsf_produk', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_produk', ['nama_produk_en', 'nama_produk_kr']);
    }
}
