<?php

namespace App\Controllers;

use App\Models\CheckoutModel;
use App\Models\CheckoutProdukModel;

class ReportController extends BaseController
{
    public function index()
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $perPage = 10;

        $getCheckoutWithProduct = $checkoutModel->getCheckoutWithProduct($perPage);
        foreach ($getCheckoutWithProduct as $key => $c) {
            $getCheckoutWithProduct[$key]['produk'] = $checkoutProdModel->getProdukByIdCheckout($c['id_checkout']);
        }
        $currentPage = $this->request->getVar('page_checkout') ? $this->request->getVar('page_checkout') : 1;

        $data = [
            'getCheckoutWithProduct' => $getCheckoutWithProduct,
            'pager' => $checkoutModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1,
        ];
        // dd($data);
        return view('dashboard/report/report', $data);
    }

    public function print($id)
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();

        $perPage = 10;
        $getCheckoutWithProduct = $checkoutModel->getCheckoutWithProduct($perPage);

        $getCheckoutWithProduct = $checkoutModel->getCheckoutWithProduct($perPage);
        foreach ($getCheckoutWithProduct as $key => $c) {
            $getCheckoutWithProduct[$key]['produk'] = $checkoutProdModel->getProdukByIdCheckout($c['id_checkout']);
        }
        $currentPage = $this->request->getVar('page_checkout') ? $this->request->getVar('page_checkout') : 1;

        $data = [
            'getCheckoutWithProduct' => $getCheckoutWithProduct,
            'pager' => $checkoutModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1,
        ];
        // dd($data);

        return view('dashboard/report/printData', $data);
    }
}
