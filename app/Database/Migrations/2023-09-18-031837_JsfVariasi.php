<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;


class JsfVariasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_variasi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_varian' => [
                'type' => 'varchar',
                'constraint' => 225,
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
        $this->forge->addKey('id_variasi', true);
        $this->forge->createTable('jsf_variasi');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_variasi');
    }
}
