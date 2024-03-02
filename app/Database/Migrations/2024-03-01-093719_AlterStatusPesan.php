<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterStatusPesan extends Migration
{
    public function up()
    {
        $fields = [
            'status_en' => [
                'type'           => 'varchar',
                'constraint'     => 255,
                'after'          => 'status'
            ],
            'status_kr' => [
                'type'           => 'varchar',
                'constraint'     => 255,
                'after'          => 'status_en'
            ],
        ];
        $this->forge->addColumn('jsf_status_pesan', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('jsf__pesan', ['status_en', 'status_kr']);
    }
}
