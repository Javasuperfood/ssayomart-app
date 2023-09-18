<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CheckoutProdukModel;

class AdminPesananController extends BaseController
{

    public function index()
    {
        $checkoutProdModel = new CheckoutProdukModel();

        $currentPage = $this->request->getVar('page_order') ? $this->request->getVar('page_order') : 1;

        $perPage = 10;
        $checkoutProdModel->paginate($perPage, 'order');
        $allOrder = $checkoutProdModel->getAllTransaksi($perPage, $currentPage);
        $data = [
            'order' => $allOrder,
            'pager' => $checkoutProdModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1
        ];
        // dd($data);
        return view('dashboard/pesanan/index', $data);
    }
    public function detail($inv)
    {
        $checkoutProdModel = new CheckoutProdukModel();
        $order = $checkoutProdModel->getTransaksi($inv);
        $data = [
            'inv' => $inv,
            'orders' => $order,
            'order' => $order[0]
        ];
        // dd($data);
        return view('dashboard/pesanan/detail', $data);
    }
}
