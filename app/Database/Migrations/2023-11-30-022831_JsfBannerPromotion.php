<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfBannerPromotion extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_banner_promotion' => [
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
        $this->forge->addKey('id_banner_promotion', true);
        $this->forge->createTable('jsf_banner_promotion');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_banner_promotion');
    }
}
