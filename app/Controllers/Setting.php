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
            'label'     => 'Kantor',
            'alamat' => 'Ruko Cyber Park Jalan Gajah Mada Jalan Boulevard Jendral Sudirman No.2159/2161/2165, RT.001/RW.009, Panunggangan Bar., Kec. Cibodas, Kota Tangerang, Banten 15139'
        ];
        return view('user/home/setting/alamatList', $data);
    }

    public function updateAlamat(): string
    {
        $data = [
            'title'     => 'Edit Alamat',
            'nama'      => 'Javasuperfood',
            'telp'      => '+62 123456789',
            'label'     => 'Kantor',
            'alamat'    => 'Ruko Cyber Park Jalan Gajah Mada Jalan Boulevard Jendral Sudirman No.2159/2161/2165, RT.001/RW.009, Panunggangan Bar., Kec. Cibodas, Kota Tangerang, Banten 15139',
            'catatan'   => 'Rumah saya ada anjing nya. Awas di gigit. Anjing saya rabies.'
        ];
        return view('user/home/setting/updateAlamat', $data);
    }

    public function createAlamat(): string
    {
        $data = [
            'title'     => 'Tambah Alamat Baru',
            'nama'      => 'Javasuperfood',
            'telp'      => '+62 123456789',
            'label'     => 'Kantor',
            'alamat'    => 'Ruko Cyber Park Jalan Gajah Mada Jalan Boulevard Jendral Sudirman No.2159/2161/2165, RT.001/RW.009, Panunggangan Bar., Kec. Cibodas, Kota Tangerang, Banten 15139',
            'catatan'   => 'Rumah saya ada anjing nya. Awas di gigit. Anjing saya rabies.'
        ];
        return view('user/home/setting/createAlamat', $data);
    }
}
