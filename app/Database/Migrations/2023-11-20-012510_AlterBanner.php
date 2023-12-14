<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterBanner extends Migration
{
    public function up()
    {
        $fields = [
            'img_konten' => [
                'type'          => 'VARCHAR',
                'constraint'    => '225',
                'default'       => 'default.png'
            ],
            'deskripsi' => [
                'type'        => 'varchar',
                'constraint' => '225',
            ]
        ];
        $this->forge->addColumn('jsf_banner', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_banner', ['img_konten', 'deskripsi']);
    }
}
