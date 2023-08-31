<?php

namespace App\Controllers;

use App\Models\AlamatUserModel;
use App\Models\ProdukModel;
use App\Models\UsersModel;
use App\Models\CheckoutModel;

class Checkout extends BaseController
{

    public function checkout($usersId): string
    {
        $data = [
            'title'     => 'Checkout',
            'nama'      => 'Javasuperfood',
            'telp'      => '+62 123456789',
            'label'     => 'Kantor',
            'alamat'    => 'Ruko Cyber Park Jalan Gajah Mada Jalan Boulevard Jendral Sudirman No.2159/2161/2165, RT.001/RW.009, Panunggangan Bar., Kec. Cibodas, Kota Tangerang, Banten 15139',
            'catatan'   => 'Rumah saya ada anjing nya. Awas di gigit. Anjing saya rabies.'
        ];
        // $usersModel = new UsersModel();
        // $produkModel = new ProdukModel();
        // $alamatUser = new AlamatUserModel();
        // $checkoutModel = new CheckoutModel();

        // $users = $usersModel->find($usersId);
        // $checkout = $checkoutModel
        //     ->select('jsf_detail_pesanan.*')
        //     ->join('jsf_produk', 'jsf_produk.id_produk = jsf_produk.id_produk', 'inner')
        //     ->join('users', 'users.id = users.id', 'inner')
        //     ->join('jsf_alamat_users', 'jsf_alamat_users.id_alamat_users = jsf_alamat_users.id_alamat_users', 'inner')
        //     ->join('jsf_pesan_produk', 'jsf_pesan_produk.id_pesan_produk = jsf_pesan_produk.id_pesan_produk', 'inner')
        //     ->where('users.id', $usersId)
        //     ->findAll();
        // dd($checkout);
        return view('user/home/checkout/checkout', $data);
    }
}
