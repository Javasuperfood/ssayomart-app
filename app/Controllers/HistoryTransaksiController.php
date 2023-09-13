<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\CheckoutProdukModel;

class HistoryTransaksiController extends BaseController
{

    public function index(): string
    {
        $checkoutProdModel = new CheckoutProdukModel();
        $kategori = new KategoriModel();
        $cekTransaksi = $checkoutProdModel->getHistoryTransaksi(user_id());
        $data = [
            'title' => 'History',
            'name' => 'Kiki',
            'transaksi' =>  $cekTransaksi,
            'kategori' => $kategori->findAll(),
        ];
        // dd($data);
        return view('user/home/history/history', $data);
    }
}
