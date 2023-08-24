<?php

namespace App\Controllers;

class Setting extends BaseController
{
    public function setting(): string
    {
        $data = [
            'title' => 'Setting',
            'name' => 'NamaUser',
            'saldo' => 2000
        ];
        return view('user/home/setting/setting', $data);
    }
    public function detailUser(): string
    {
        $data = [
            'title' => 'Detail User',
        ];
        return view('user/home/setting/detailUser', $data);
    }
    public function pembayaran(): string
    {
        $data = [
            'title' => 'Pembayaran',
        ];
        return view('user/home/setting/pembayaran', $data);
    }
    public function alamatList(): string
    {
        $data = [
            'title' => 'Alamat',
            'nama' => 'Javasuperfood',
            'alamat' => 'Ruko Cyber Park Jalan Gajah Mada Jalan Boulevard Jendral Sudirman No.2159/2161/2165, RT.001/RW.009, Panunggangan Bar., Kec. Cibodas, Kota Tangerang, Banten 15139'
        ];
        return view('user/home/setting/alamatList', $data);
    }
}
