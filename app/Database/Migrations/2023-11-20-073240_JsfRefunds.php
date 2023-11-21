<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfRefunds extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_refund' => [
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
            'order_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'refund_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',

            ],
            'refund_status' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'refund_note' => [
                'type'       => 'TEXT',
            ],
            'refund_amount' => [
                'type'       => 'decimal',
                'constraint' => '10,2',
            ],
            'created_by' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'updated_by' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'created_at' => [
                'type'       => 'timestamp',
                'null' => true
            ],
            'updated_at' => [
                'type'       => 'timestamp',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id_refund', true);
        $this->forge->addForeignKey('id_checkout', 'jsf_checkout', 'id_checkout');
        $this->forge->createTable('jsf_refunds');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_refunds');
    }
}
