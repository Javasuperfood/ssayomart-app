<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterTokoDropIdUser extends Migration
{
    public function up()
    {
        $this->forge->dropForeignKey('jsf_toko', 'jsf_toko_id_user_foreign');
        $this->forge->dropColumn('jsf_toko', 'id_user');
    }

    public function down()
    {
        $this->forge->addColumn('jsf_toko', [
            'id_user' => [
                'type'        => 'INT',
                'constraint'  => 11,
                'unsigned'    => true,
            ],
        ]);

        $this->forge->addForeignKey('id_user', 'users', 'id');
    }
}
