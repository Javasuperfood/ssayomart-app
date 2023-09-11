<?php

namespace App\Controllers;

use App\Models\StatusPesanModel;
use App\Models\UsersModel;

class UserStatusController extends BaseController
{
    public function status($slug)
    {
        $statusModel = new StatusPesanModel();
        $userModel = new UsersModel();
        $userSatus = $userModel->getStatus($slug);

        $status = $statusModel->findAll();
        $cekProduk = $userModel->getTransaksi($slug);


        $data = [
            'title'                     => 'Status Pesanan',
            'getstatus'                 => $status,
            'status' => $userSatus[0],
            'produk' => $cekProduk,
            'back' => 'history'

        ];
        // dd($data);
        return view('user/produk/status', $data);
    }
}
