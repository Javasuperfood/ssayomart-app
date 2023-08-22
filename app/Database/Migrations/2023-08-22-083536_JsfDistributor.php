<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfDistributor extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_distributor' => [
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
            'deskripsi' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'alamat_distributor' => [
                'type'          => 'VARCHAR',
                'constraint'    => '150'
            ],
            'created_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ], 'updated_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ],
        ]);
        $this->forge->addKey('id_distributor', true);
        $this->forge->addForeignKey('id_user', 'users', 'id');
        $this->forge->createTable('jsf_distributor');
    }

    public function down()
    {
        $this->forge->dropForeignKey('jsf__distributor', 'id');
        $this->forge->dropTable('jsf_distributor');
    }
}
