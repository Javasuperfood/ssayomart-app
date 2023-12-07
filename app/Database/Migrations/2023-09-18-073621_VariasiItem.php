<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

use function PHPSTORM_META\type;

class VariasiItem extends Migration
{
    public function up()
    {
        // Tabel "Opsi_Variasi" (Variation_Options):
        // ID_Opsi (Primary Key)
        // ID_Variasi (Foreign Key ke Tabel "Variasi_Produk")
        // Nama_Opsi (misalnya, "S", "M", "L" untuk Ukuran)
        // Harga (harga tambahan atau harga yang berbeda untuk opsi tertentu, bisa berupa nilai numerik)

        $this->forge->addField([
            'id_variasi_item' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_variasi' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'id_produk' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'value_item' => [
                'type' => 'varchar',
                'constraint' => 225,
            ],
            'berat' => [
                'type'           => 'varchar',
                'constraint'     => 225,
            ],
            'harga_item' => [
                'type' => 'varchar',
                'constraint' => 200
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
        $this->forge->addKey('id_variasi_item', true);
        $this->forge->addForeignKey('id_variasi', 'jsf_variasi', 'id_variasi', true, 'CASCADE');
        $this->forge->addForeignKey('id_produk', 'jsf_produk', 'id_produk', true, 'CASCADE');
        $this->forge->createTable('jsf_variasi_item');
    }

    public function down()
    {
        $this->forge->dropTable('jsf_variasi_item');
    }
}
