<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfKategori extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kategori' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_sub_kategori' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'nama_kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => '225',
            ],
            'deskripsi_kategori' => [
                'type'          => 'varchar',
                'constraint'    => '200'
            ],
            'slug' => [
                'type'          => 'varchar',
                'constraint'    => '225'
            ],
            'created_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ], 'updated_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ],
        ]);
        $this->forge->addKey('id_kategori', true);
        $this->forge->addForeignKey('id_sub_kategori', 'jsf_sub_kategori', 'id_sub_kategori');
        $this->forge->createTable('jsf_kategori');
    }

    public function down()
    {
        $this->forge->dropForeignKey('jsf_kategori', 'id_sub_kategori');

        $this->forge->dropTable('jsf_kategori');
    }
}
