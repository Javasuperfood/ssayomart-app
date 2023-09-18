<?php

namespace App\Controllers;

use App\Models\CheckoutModel;
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
        $checkoutModel = new CheckoutModel();
        $order_id = $this->request->getGet('order_id');
        $status_code = $this->request->getGet('status_code');
        $transaction_status = $this->request->getGet('transaction_status');
        $userSatus = $userModel->getStatus($order_id);

        $status = $statusModel->findAll();
        $cekProduk = $userModel->getTransaksi($order_id);

        $data = [
            'title'                     => 'Status Pesanan',
            'getstatus'                 => $status,
            'status' => $userSatus,
            'produk' => $cekProduk,
            'jasa' => 1000,
            'key' => $midtransConfig->clientKey,
            'back' => 'history'

        ];
        // ==================================================================
        if ($userSatus->id_status_pesan != '1') {
            try {
                /**
                 * @var object $paymentStatus
                 */
                $paymentStatus = \Midtrans\Transaction::status($order_id);
                if ($paymentStatus->transaction_status == "settlement" && $userSatus->id_status_pesan == '1') {
                    $checkoutModel->save([
                        'id_checkout' => $userSatus->id_checkout,
                        'id_status_pesan' => 2
                    ]);
                }
                $data['paymentStatus'] = $paymentStatus;
            } catch (\Exception $e) {
                // echo "An error occurred: " . $e->getMessage();
            }
        }
        // ===============================================================

        // dd($data);
        return view('user/produk/status', $data);
    }
}
