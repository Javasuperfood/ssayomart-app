<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterCheckoutGosend extends Migration
{
    public function up()
    {
        $fields = [
            'gosend' => [
                'type' => 'int',
                'constraint' => 1,
                'default' => null,
                'null' => true,
                'after' => 'telp'
            ]
        ];
        $this->forge->addColumn('jsf_checkout', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_checkout', ['gosend']);
    }
}
