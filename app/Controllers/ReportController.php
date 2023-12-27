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

        $startDate = $this->request->getVar('startDate');
        $endDate = $this->request->getVar('endDate');

        $getCheckoutWithProduct = $checkoutModel->getCheckoutWithProduct($perPage, $startDate, $endDate);
        foreach ($getCheckoutWithProduct as $key => $c) {
            $getCheckoutWithProduct[$key]['produk'] = $checkoutProdModel->getProdukByIdCheckout($c['id_checkout']);
        }
        $currentPage = $this->request->getVar('page_checkout') ? $this->request->getVar('page_checkout') : 1;

        $data = [
            'getCheckoutWithProduct' => $getCheckoutWithProduct,
            'pager' => $checkoutModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ];
        // dd($data);
        return view('dashboard/report/report', $data);
    }

    public function print()
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();

        $perPage = 10;

        $startDate = $this->request->getVar('start_date');
        $endDate = $this->request->getVar('end_date');

        $getCheckoutWithProduct = $checkoutModel->getCheckoutWithProduct($perPage, $startDate, $endDate);
        foreach ($getCheckoutWithProduct as $key => $c) {
            $getCheckoutWithProduct[$key]['produk'] = $checkoutProdModel->getProdukByIdCheckout($c['id_checkout']);
        }
        $currentPage = $this->request->getVar('page_checkout') ? $this->request->getVar('page_checkout') : 1;

        $data = [
            'getCheckoutWithProduct' => $getCheckoutWithProduct,
            'pager' => $checkoutModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1,
            'startDate' => $startDate, // Include the start date in the data array
            'endDate' => $endDate,
        ];
        // dd($data);

        return view('dashboard/report/printData', $data);
    }
}
