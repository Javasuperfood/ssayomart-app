<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfPormo extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_promo' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '225',
            ],
            'slug' => [
                'type'          => 'varchar',
                'constraint'    => '225'
            ],
            'img' => [
                'type'          => 'varchar',
                'constraint'    => '225',
                'default' => 'default.png'
            ],
            'start_at' => [
                'type' => 'timestamp',
            ],
            'end_at' => [
                'type' => 'DATETIME',
            ],
            'deskripsi' => [
                'type' => 'text',
                'null' => true
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
        $this->forge->addKey('id_promo', true);
        $this->forge->createTable('jsf_promo');
    }

    public function down()
    {

        $this->forge->dropTable('jsf_promo');
    }
}
