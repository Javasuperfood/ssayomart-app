<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfSubKategori extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_sub_kategori' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_kategori' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'nama_kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => '225',
            ],
            'slug' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],

            'deskripsi' => [
                'type'          => 'varchar',
                'constraint'    => '200'
            ],
            'img' => [
                'type'          => 'VARCHAR',
                'constraint'    => '225',
                'default'       => 'default.png'
            ],
            'created_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ], 'updated_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ],
        ]);
        $this->forge->addKey('id_sub_kategori', true);
        $this->forge->addForeignKey('id_kategori', 'jsf_kategori', 'id_kategori');
        $this->forge->createTable('jsf_sub_kategori');
    }

    public function down()
    {
        $this->forge->dropForeignKey('jsf_sub_kategori', 'id_kategori');

        $this->forge->dropTable('jsf_sub_kategori');
    }
}
