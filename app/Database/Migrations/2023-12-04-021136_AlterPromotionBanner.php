<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterPromotionBanner extends Migration
{
    public function up()
    {
        $fields = [
            'img_promo' => [
                'type'          => 'VARCHAR',
                'constraint'    => '225',
                'default'       => 'default.jpg'
            ],
            'deskripsi' => [
                'type'        => 'varchar',
                'constraint' => '225',
            ]
        ];
        $this->forge->addColumn('jsf_banner_promotion', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_banner_promotion', ['img_promo', 'deskripsi']);
    }
}
