<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterCheckoutAlamatUser extends Migration
{
    public function up()
    {
        $fields = [
            'id_destination' => [
                'type' => 'int',
                'constraint' => 11,
                'null' => true,
                'after' => 'id_user'
            ]
        ];
        $this->forge->addColumn('jsf_checkout', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_checkout', ['id_destination']);
    }
}
