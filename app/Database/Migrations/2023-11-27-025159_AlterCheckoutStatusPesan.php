<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterCheckoutStatusPesan extends Migration
{
    public function up()
    {
        $fields = [
            'status_transaction' => [
                'type' => 'boolean',
                'null' => false,
                'after' => 'id_checkout',
                'default' => false
            ]
        ];
        $this->forge->addColumn('jsf_checkout', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_checkout', ['status_transaction']);
    }
}
