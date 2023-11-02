<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfPopUpBanner extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pop_up_banner' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'        => 'varchar',
                'constraint' => '225',
            ],
            'img' => [
                'type'          => 'VARCHAR',
                'constraint'    => '225',
                'default'       => 'default.png'
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
        $this->forge->addKey('id_pop_up_banner', true);
        $this->forge->createTable('jsf_pop_up_banner');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_pop_up_banner');
    }
}
