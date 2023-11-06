<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StatusProses extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_status_pesan'            => 1,
                'status'        => 'Menunggu Pembayaran',
                'deskripsi'     => 'Proses tertunda karena pembeli belum melakukan transaksi',
            ],
            [
                'id_status_pesan'            => 2,
                'status'        => 'Paket Diproses',
                'deskripsi'     => 'Paket sudah diproses oleh cabang terdekat',
            ],
            [
                'id_status_pesan'            => 3,
                'status'        => 'Paket Dikirim',
                'deskripsi'     => 'Paket sudah dalam proses pengiriman',
            ],
            [
                'id_status_pesan'            => 4,
                'status'        => 'Paket Terkirim',
                'deskripsi'     => 'Paket sudah diterima oleh pembeli',
            ],
            [
                'id_status_pesan'            => 5,
                'status'        => 'Gagal',
                'deskripsi'     => 'Transaksi pemabayaran gagal',
            ],
            // [
            // 'id_status_pesan'            => 6,
            //     'status'        => 'Dibatalkan',
            //     'deskripsi'     => 'Pesanan Dibatalkan',
            // ],
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
