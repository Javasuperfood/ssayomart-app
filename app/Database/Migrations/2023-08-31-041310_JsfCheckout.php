<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfCheckout extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_checkout' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'id_kupon' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'           => true,
            ],
            'id_status_pesan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'id_status_kirim' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'invoice' => [
                'type'           => 'varchar',
                'constraint'     => '225',
            ],
            'catatan' => [
                'type'           => 'varchar',
                'constraint'     => '225',
            ],
            'created_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ],
            'updated_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ],
        ]);
        $this->forge->addKey('id_checkout', true);
        $this->forge->addForeignKey('id_user', 'users', 'id');
        $this->forge->addForeignKey('id_kupon', 'jsf_kupon', 'id_kupon');
        $this->forge->addForeignKey('id_status_pesan', 'jsf_status_pesan', 'id_status_pesan');
        $this->forge->addForeignKey('id_status_kirim', 'jsf_status_kirim', 'id_status_kirim');
        $this->forge->createTable('jsf_checkout');
    }

    public function down()
    {
        $this->forge->dropForeignKey('jsf_checkout', 'id');
        $this->forge->dropForeignKey('jsf_checkout', 'id_kupon');
        $this->forge->dropForeignKey('jsf_checkout', 'id_status_pesan');
        $this->forge->dropForeignKey('jsf_checkout', 'id_status_kirim');

        $this->forge->dropTable('jsf_checkout');
    }
}
