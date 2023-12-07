<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AlterStatusProses extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_status_pesan' => 6,
                'status'        => 'Dibatalkan',
                'deskripsi'     => 'Pesanan Dibatalkan',
            ],
        ];

        $this->db->table('jsf_status_pesan')->insertBatch($data);
    }
}
