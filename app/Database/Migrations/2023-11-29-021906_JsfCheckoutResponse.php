<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfCheckoutResponse extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_checkout_response' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_checkout' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'response' => [
                'type'       => 'json',
            ],
            'created_at' => [
                'type'        => 'timestamp',
                'null'        => true,
            ],
            'updated_at' => [
                'type'   => 'timestamp',
                'null'   => true
            ],
        ]);
        $this->forge->addKey('id_checkout_response', true);
        $this->forge->createTable('jsf_checkout_response');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_checkout_response');
    }
}
