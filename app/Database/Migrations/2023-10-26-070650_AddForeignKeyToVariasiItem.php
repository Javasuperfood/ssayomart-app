<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddForeignKeyToVariasiItem extends Migration
{
    public function up()
    {
        // $this->forge->addColumn('jsf_variasi_item', [
        //     'id_produk_batch' => [
        //         'type' => 'INT',
        //         'constraint' => 11,
        //         'unsigned' => true,
        //     ],
        // ]);

        // $this->forge->addForeignKey('id_produk_batch', 'jsf_produk_batch', 'id_produk_batch', true, 'CASCADE');
    }

    public function down()
    {
        // $this->forge->dropColumn('jsf_variasi_item', 'id_produk_batch');
    }
}
