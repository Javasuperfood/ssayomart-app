<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JsfWishlist extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_wishlist' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'created_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ],
            'updated_at' => [
                'type'          => 'timestamp',
                'null'          => true
            ],
        ]);
        $this->forge->addKey('id_wishlist', true);
        $this->forge->addForeignKey('id_user', 'users', 'id');
        $this->forge->createTable('jsf_wishlist');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_wishlist');
    }
}
