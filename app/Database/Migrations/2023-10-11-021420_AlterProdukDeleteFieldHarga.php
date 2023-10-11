<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterProdukDeleteFieldHarga extends Migration
{
    public function up()
    {
        $this->forge->dropColumn('jsf_produk', ['harga']);
    }

    public function down()
    {
        //
    }
}
