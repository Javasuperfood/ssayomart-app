<?php

namespace App\Controllers;

use App\Models\StatusPesanModel;
use App\Models\UsersModel;

class UserStatusController extends BaseController
{
    public function status()
    {
        $statusModel = new StatusPesanModel();
        $userModel = new UsersModel();
        $order_id = $this->request->getGet('order_id');
        $status_code = $this->request->getGet('status_code');
        $transaction_status = $this->request->getGet('transaction_status');
        $userSatus = $userModel->getStatus($order_id);

        $status = $statusModel->findAll();
        $cekProduk = $userModel->getTransaksi($order_id);


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
