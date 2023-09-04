<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StatusPesan extends Seeder
{
    public function run()
    {
        $data = [
            [
                'status'        => 'Menunggu Pembayaran',
                'deskripsi'     => 'Proses tertunda karena pembeli belum melakukan transaksi',
            ],
            [
                'status'        => 'Paket Diproses',
                'deskripsi'     => 'Paket sudah diproses oleh cabang terdekat',
            ],
            [
                'status'        => 'Paket Dikirim',
                'deskripsi'     => 'Paket sudah dalam proses pengiriman',
            ],
            [
                'status'        => 'Paket Terkirim',
                'deskripsi'     => 'Paket sudah diterima oleh pembeli',
            ],
        ];

        $this->db->table('jsf_status_pesan')->insertBatch($data);
    }
}
