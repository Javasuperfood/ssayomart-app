<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterUser extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'fullname VARCHAR(200)',
            'telp VARCHAR(16)'
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'fullname', 'telp');
    }
}
