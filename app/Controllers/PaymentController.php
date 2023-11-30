<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CheckoutModel;
use App\Models\KategoriModel;
use App\Models\StatusPesanModel;
use App\Models\UsersModel;
use Midtrans\Config as MidtransConfig;

class PaymentController extends BaseController
{
    public function index($inv)
    {
        $midtransConfig = new \Config\Midtrans();

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
        $kategori = new KategoriModel();
        $order_id = $inv;
        $status_code = $this->request->getGet('status_code');
        $transaction_status = $this->request->getGet('transaction_status');
        $userSatus = $userModel->getStatus($order_id);

        $status = $statusModel->findAll();
        $cekProduk = $userModel->getTransaksi($order_id);
        // dd($cekProduk);
        $data = [
            'title'                     => 'Status Pesanan',
            'getstatus'                 => $status,
            'status' => $userSatus,
            'produk' => $cekProduk,
            'key' => $midtransConfig->clientKey,
            'urlMidtrans' => $midtransConfig->urlMidtrans,
            'order_id' => $order_id,
            'back' => 'history',
            'kategori' => $kategori->findAll()

        ];
        // dd($data);
        // ==================================================================
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
            } else if ($paymentStatus->transaction_status == 'pending') {
                // TODO set payment status in merchant's database to 'Pending'
                $checkoutModel->save([
                    'id_checkout' => $userSatus->id_checkout,
                    'id_status_pesan' => 1
                ]);
            } else if ($paymentStatus->transaction_status == 'deny') {
                // TODO set payment status in merchant's database to 'Denied'
                $checkoutModel->save([
                    'id_checkout' => $userSatus->id_checkout,
                    'id_status_pesan' => 5
                ]);
            } else if ($paymentStatus->transaction_status == 'expire') {
                // TODO set payment status in merchant's database to 'expire'
                $checkoutModel->save([
                    'id_checkout' => $userSatus->id_checkout,
                    'id_status_pesan' => 5
                ]);
            } else if ($paymentStatus->transaction_status == 'cancel') {
                // TODO set payment status in merchant's database to 'Denied'
                $checkoutModel->save([
                    'id_checkout' => $userSatus->id_checkout,
                    'id_status_pesan' => 5
                ]);
            }

            $data['paymentStatus'] = $paymentStatus;

            return redirect()->to(base_url('status?order_id=' . $order_id));
        } catch (\Exception $e) {
            // echo "An error occurred: " . $e->getMessage();
            $currentTimestamp = time(); // Get the current timestamp
            $twentyFourHoursAgo = $currentTimestamp - (24 * 60 * 60);
            $lastUpdateTimestamp = strtotime($userSatus->last_update);
            if ($lastUpdateTimestamp <= $twentyFourHoursAgo && $userSatus->id_status_pesan == '1') {
                $checkoutModel->save([
                    'id_checkout' => $userSatus->id_checkout,
                    'id_status_pesan' => 5
                ]);
            }
        }
        // ===============================================================
        // dd($data);
        return view('user/produk/status', $data);
    }

    // ================= PENTING =========================
    public function ajaxPay()
    {
        $checkoutModel = new CheckoutModel();

        $result = $this->request->getVar();
        $token = $result['token'];
        $status_code = $result['result']['status_code'];
        $status_message = $result['result']['status_message'];
        $transaction_id = $result['result']['transaction_id'];
        $order_id = $result['result']['order_id'];
        $gross_amount = $result['result']['gross_amount'];
        $payment_type = $result['result']['payment_type'];
        $transaction_time = $result['result']['transaction_time'];
        $transaction_status = $result['result']['transaction_status'];
        $fraud_status = $result['result']['fraud_status'];
        $checkout = $checkoutModel->where('snap_token', $token)->first();
        $data = [
            'id_checkout' => $checkout['id_checkout'],
            'id_status_pesan' => 2,
        ];
        if (!$checkoutModel->save($data)) {
            $response = [
                'success' => false,
                'message' => 'Gagal Update data. Hubungi',
            ];
            return $this->response->setJSON($response);
        }
        $response = [
            'success' => true,
            'message' => 'Transaksi Berhasil. ',
            'result' => $token
        ];
        return $this->response->setJSON($response);
    }
}
