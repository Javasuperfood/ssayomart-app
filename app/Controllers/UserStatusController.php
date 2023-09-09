<?php

namespace App\Controllers;

use App\Models\CheckoutModel;
use App\Models\AlamatUserModel;
use App\Models\CheckoutProdukModel;
use App\Models\StatusPesanModel;
use App\Models\UsersModel;

class UserStatusController extends BaseController
{
    public function status($slug)
    {
        $statusModel = new StatusPesanModel();
        $userModel = new UsersModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $userSatus = $userModel->getStatus($slug);

        $status = $statusModel->findAll();
        $checkoutProdModel = new CheckoutProdukModel();
        $cekProduk = $userModel->getTransaksi($slug);


        $data = [
            'title'                     => 'Status Pesanan',
            'getstatus'                 => $status,
            'status' => $userSatus[0],
            'produk' => $cekProduk

        ];
        // dd($data);
        return view('user/produk/status', $data);
    }
}
