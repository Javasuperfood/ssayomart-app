<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfKupon extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kupon' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => '225',
            ],
            'kode' => [
                'type'          => 'varchar',
                'constraint' => '225',

            ],
            'deskripsi' => [
                'type'          => 'varchar',
                'constraint'    => '200'
            ],
            'is_active' => [
                'type'          => 'BOOLEAN',
            ],

            'created_by' => [
                'type'          => 'INT',
                'constraint'    => 11,
                'null'          => true
            ],
            'created_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ], 'updated_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ],
        ]);
        $this->forge->addKey('id_kupon', true);
        $this->forge->createTable('jsf_kupon');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_kupon');
    }
}
