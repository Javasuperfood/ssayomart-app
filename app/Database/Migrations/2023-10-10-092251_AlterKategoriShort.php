<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterKategoriShort extends Migration
{
    public function up()
    {
        $fields = [
            'short' => [
                'type'          => 'int',
                'constraint'     => 11,
                'null' => true,
                'after' => 'img'
            ]

        ];
        $this->forge->addColumn('jsf_kategori', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_kategori', ['short']);
    }
}
