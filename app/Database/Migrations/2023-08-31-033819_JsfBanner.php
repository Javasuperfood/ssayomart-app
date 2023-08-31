<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfBanner extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_banner' => [
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
            'update_at' => [
                'type'   => 'timestamp',
                'null'   => true
            ],
        ]);
        $this->forge->addKey('id_banner', true);
        $this->forge->createTable('jsf_banner');
    }

    public function down()
    {

        $this->forge->dropTable('jsf_banner');
    }
}
