<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUsersDefaultMarket extends Migration
{
    public function up()
    {
        $this->forge->modifyColumn('users', [
            'market_selected' => [
                'type' => 'int',
                'constraint' => 11,
                'default' => 1,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->modifyColumn('users', [
            'market_selected' => [
                'type' => 'int',
                'constraint' => 11,
            ],
        ]);
    }
}
