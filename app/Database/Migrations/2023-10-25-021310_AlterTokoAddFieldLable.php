<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTokoAddFieldLable extends Migration
{
    public function up()
    {
        $fields = [
            'lable' => [
                'type' => 'varchar',
                'constraint' => 225,
                'default' => 'Ssayomart',
                'null' => true,
                'after' => 'id_toko'
            ]

        ];
        $this->forge->addColumn('jsf_toko', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_toko', ['lable']);
    }
}
