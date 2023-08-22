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
            'nama_sub_kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => '225',
            ],
            'deskripsi_sub_kategori' => [
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
        $this->forge->addKey('id_sub_kategori', true);

        $this->forge->createTable('jsf_sub_kategori');
    }

    public function down()
    {
        $this->forge->dropForeignKey('jsf_sub_kategori', 'id_kategori');

        $this->forge->dropTable('jsf_sub_kategori');
    }
}
