<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

use function PHPSTORM_META\type;

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
            'kirim' => [
                'type' => 'text',
                'null' => true
            ],
            'city' => [
                'type' => 'varchar',
                'constraint' => '225',
                'null' => true
            ],
            'zip_code' => [
                'type' => 'varchar',
                'constraint' => '20',
                'null' => true
            ],
            'telp' => [
                'type' => 'varchar',
                'constraint' => '20',
                'null' => true
            ],
            'kurir' => [
                'type' => 'text',
                'null' => true
            ],
            'service' => [
                'type' => 'text',
                'null' => true
            ],
            'harga_service' => [
                'type' => 'text',
                'null' => true
            ],
            'kupon' => [
                'type'           => 'varchar',
                'constraint'     => '225',
                'null'           => true,
            ],
            'discount' => [
                'type'           => 'varchar',
                'constraint'     => '225',
                'null'           => true,
            ],
            'total_1' => [
                'type'           => 'varchar',
                'constraint'     => '225',
            ],
            'total_2' => [
                'type'           => 'varchar',
                'constraint'     => '225',
            ],
            'snap_token' => [
                'type'           => 'varchar',
                'constraint'     => '225',
                'null'           => true,
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
        $this->forge->addForeignKey('id_status_pesan', 'jsf_status_pesan', 'id_status_pesan');
        $this->forge->addForeignKey('id_status_kirim', 'jsf_status_kirim', 'id_status_kirim');
        $this->forge->createTable('jsf_checkout');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_checkout');
    }
}
