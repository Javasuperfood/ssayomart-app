<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Status extends Seeder
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
        $data2 = [
            [
                'status' => 'Diproses',
                'deskripsi'    => 'Barang sedang diproses',
            ],
            [
                'status' => 'Dikirim',
                'deskripsi'    => 'Barang sedang dikirm',
            ],
            [
                'status' => 'Sampai',
                'deskripsi'    => 'Barang sampai ditujuan',
            ],
        ];

        $this->db->table('jsf_status_kirim')->insertBatch($data2);
    }
}
