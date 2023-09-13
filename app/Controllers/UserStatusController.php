<?php

namespace App\Controllers;

use App\Models\StatusPesanModel;
use App\Models\UsersModel;
use Midtrans\Config as MidtransConfig;


class UserStatusController extends BaseController
{
    public function status()
    {
        $midtransConfig = config('Midtrans');

        // Set the Midtrans API credentials
        MidtransConfig::$serverKey = $midtransConfig->serverKey;
        MidtransConfig::$clientKey = $midtransConfig->clientKey;
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        MidtransConfig::$isProduction = $midtransConfig->isProduction;
        // Set sanitization on (default)
        MidtransConfig::$isSanitized = $midtransConfig->isSanitized;
        // Set 3DS transaction for credit card to true
        MidtransConfig::$is3ds = $midtransConfig->is3ds;
        $statusModel = new StatusPesanModel();
        $userModel = new UsersModel();
        $order_id = $this->request->getGet('order_id');
        $status_code = $this->request->getGet('status_code');
        $transaction_status = $this->request->getGet('transaction_status');
        $userSatus = $userModel->getStatus($order_id);

        $status = $statusModel->findAll();
        $cekProduk = $userModel->getTransaksi($order_id);
        $paymentStatus = \Midtrans\Transaction::status($order_id);

        $data = [
            'title'                     => 'Status Pesanan',
            'getstatus'                 => $status,
            'status' => $userSatus[0],
            'paymentStatus' => $paymentStatus,
            'produk' => $cekProduk,
            'jasa' => 1000,
            'back' => 'history'

        ];
        // dd($data);
        return view('user/produk/status', $data);
    }
}
