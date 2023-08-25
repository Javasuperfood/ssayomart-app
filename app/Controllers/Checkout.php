<?php

namespace App\Controllers;

class Checkout extends BaseController
{
    public function checkout(): string
    {
        $data = [
            'title'     => 'Checkout',
            'nama'      => 'Javasuperfood',
            'telp'      => '+62 123456789',
            'label'     => 'Kantor',
            'alamat'    => 'Ruko Cyber Park Jalan Gajah Mada Jalan Boulevard Jendral Sudirman No.2159/2161/2165, RT.001/RW.009, Panunggangan Bar., Kec. Cibodas, Kota Tangerang, Banten 15139',
            'catatan'   => 'Rumah saya ada anjing nya. Awas di gigit. Anjing saya rabies.'
        ];
        return view('user/home/checkout/checkout', $data);
    }
}
