<?php

namespace App\Controllers;

use App\Models\CheckoutProdukModel;

class HistoryTransaksiController extends BaseController
{

    public function index(): string
    {
        $checkoutProdModel = new CheckoutProdukModel();


        $cekTransaksi = $checkoutProdModel->getHistoryTransaksi(user_id());
        $data = [
            'title' => 'History',
            'name' => 'Kiki',
            'transaksi' =>  $cekTransaksi
        ];
        // dd($data);
        return view('user/home/history/history', $data);
    }
}
