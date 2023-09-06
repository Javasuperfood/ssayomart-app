<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CheckoutProdukModel;

class AdminPesananController extends BaseController
{

    public function index()
    {
        $checkoutProdModel = new CheckoutProdukModel();
        $allOrder = $checkoutProdModel->getAllTransaksi();
        $data = [
            'order' => $allOrder
        ];
        return view('dashboard/pesanan/index', $data);
    }
}
