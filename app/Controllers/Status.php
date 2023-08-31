<?php

namespace App\Controllers;

class Status extends BaseController
{
    public function status(): string
    {
        $data = [
            'title'                     => 'Status Pesanan',
            'nama'                      => 'Javasuperfood',
            'telp'                      => '+62 123456789',
            'label'                     => 'Kantor',
            'alamat'                    => 'Ruko Cyber Park Jalan Gajah Mada Jalan Boulevard Jendral Sudirman No.2159/2161/2165, RT.001/RW.009, Panunggangan Bar., Kec. Cibodas, Kota Tangerang, Banten 15139',
            'catatan'                   => 'Rumah saya ada anjing nya. Awas di gigit. Anjing saya rabies.',
            'keterangan'                => [
                'diterima'              => ['pesan' => 'Paket Diterima', 'tanggal' => '21 Agustus 2023'],
                'diproses'              => ['pesan' => 'Paket Diproses', 'tanggal' => '23 Agustus 2023'],
                'dikirim'               => ['pesan' => 'Paket Dikirim', 'tanggal'  => '24 Agustus 2023'],
                'terkirim'              => ['pesan' => 'Paket Terkirim', 'tanggal' => '25 Agustus 2023'],
            ],
        ];
        return view('user/produk/status', $data);
    }
}
