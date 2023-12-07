<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfStatusPesan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_status_pesan' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'status' => [
                'type'          => 'char',
                'constraint'    => '20'
            ],
            'deskripsi' => [
                'type'          => 'varchar',
                'constraint'    => '255'
            ],
            'created_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ], 'updated_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ],
        ]);
        $this->forge->addKey('id_status_pesan', true);

        $this->forge->createTable('jsf_status_pesan');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_status_pesan');
    }
}
