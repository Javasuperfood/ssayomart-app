<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterPromo extends Migration
{
    public function up()
    {
        $fields = [
            'img_2' => [
                'type'          => 'varchar',
                'constraint'    => '225',
                'after'         => 'img',
            ],
        ];
        $this->forge->addColumn('jsf_promo', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf_promo', 'img_2');
    }
}
