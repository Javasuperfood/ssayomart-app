<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfBlog extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_blog' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'judul_blog' => [
                'type' => 'varchar',
                'constraint' => 225,
            ],
            'tanggal_dibuat' => [
                'type' => 'timestamp',
                'null'     => true
            ],
            'img_thumbnail' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'default'       => 'default.png'
            ],
            'img_1' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'default'       => 'default.png'
            ],
            'img_2' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'default'       => 'default.png',
                'null'          => true
            ],
            'img_3' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
                'default'       => 'default.png',
                'null'          => true
            ],
            'slug' => [
                'type'          => 'varchar',
                'constraint'    => '225'
            ],
            'created_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ],
            'updated_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ]
        ]);
        $this->forge->addKey('id_blog', true);

        $this->forge->createTable('jsf_blog');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_blog');
    }
}
