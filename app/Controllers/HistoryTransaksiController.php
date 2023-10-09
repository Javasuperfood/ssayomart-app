<?php

namespace App\Controllers;

use App\Models\CheckoutModel;
use Midtrans\Config as MidtransConfig;
use App\Models\KategoriModel;
use App\Models\CheckoutProdukModel;

class HistoryTransaksiController extends BaseController
{

    public function index(): string
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

        $checkoutProdModel = new CheckoutProdukModel();
        $checkoutModel = new CheckoutModel();
        $kategori = new KategoriModel();
        $cekTransaksi = $checkoutProdModel->getHistoryTransaksi(user_id());

        $data = [
            'title' => lang('Text.title_history'),
            'transaksi' =>  $cekTransaksi,
            'back' => '',
            'kategori' => $kategori->findAll(),
        ];
        foreach ($cekTransaksi as $t) {
            try {
                // /**
                //  * @var object $paymentStatus
                //  */
                // $paymentStatus = \Midtrans\Transaction::status("$t->invoice");
                // if ($paymentStatus->order_id == $t->invoice) {
                //     if ($paymentStatus->transaction_status == "expire" && $t->id_status_pesan == '1') {
                //         $checkoutModel->save([
                //             'id_checkout' => $t->id_checkout,
                //             'id_status_pesan' => 5
                //         ]);
                //     }
                //     if ($paymentStatus->transaction_status == "settlement" && $t->id_status_pesan == '1') {
                //         $checkoutModel->save([
                //             'id_checkout' => $t->id_checkout,
                //             'id_status_pesan' => 2
                //         ]);
                //     }
                // }
                // $data['status'][$t->invoice] = $paymentStatus;
                $data['status'][$t->invoice] = new \stdClass();
                $data['status'][$t->invoice]->order_id = null;
            } catch (\Exception $e) {
                // echo "An error occurred: " . $e->getMessage();
                $currentTimestamp = time(); // Get the current timestamp
                $twentyFourHoursAgo = $currentTimestamp - (24 * 60 * 60);
                $lastUpdateTimestamp = strtotime($t->last_update);
                if ($lastUpdateTimestamp <= $twentyFourHoursAgo && $t->id_status_pesan == '1') {
                    $checkoutModel->save([
                        'id_checkout' => $t->id_checkout,
                        'id_status_pesan' => 5
                    ]);
                }
                $data['status'][$t->invoice] = new \stdClass();
                $data['status'][$t->invoice]->order_id = null;
            }
        }
        // dd($data);
        return view('user/home/history/history', $data);
    }
}
