<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AlterAlamatUsers2 extends Migration
{
    public function up()
    {
        // Hapus kolom latitude dan longitude
        $this->forge->dropColumn('jsf_alamat_users', ['latitude', 'longitude']);

        // Tambahkan kolom latitude dan longitude baru
        $fields = [
            'latitude' => [
                'type' => 'decimal(9,7)',
                'null' => true,
                'after' => 'telp2'
            ],
            'longitude' => [
                'type' => 'decimal(10,7)',
                'null' => true,
                'after' => 'latitude'
            ],
        ];
        $this->forge->addColumn('jsf_alamat_users', $fields);
    }

    public function down()
    {
        // Hapus kolom latitude dan longitude
        $this->forge->dropColumn('jsf_alamat_users', ['latitude', 'longitude']);

        // Tambahkan kolom latitude dan longitude kembali dengan definisi lama
        $fields = [
            'latitude' => [
                'type' => 'decimal(9,6)',
                'null' => true,
                'after' => 'telp2'
            ],
            'longitude' => [
                'type' => 'decimal(10,6)',
                'null' => true,
                'after' => 'latitude'
            ],
        ];
        $this->forge->addColumn('jsf_alamat_users', $fields);
    }
}
