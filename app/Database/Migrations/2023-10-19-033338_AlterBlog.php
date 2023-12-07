<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterBlog extends Migration
{
    public function up()
    {
        $fields = [
            // 'link_video' => [
            //     'type' => 'varchar',
            //     'constraint' => 225,
            //     'after' => 'isi_blog'
            // ],

            'link_video' => [
                'type' => 'text',
                'after' => 'isi_blog'
            ]

        ];
        $this->forge->addColumn('jsf_blog', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_blog', ['link_video']);
    }
}
