<?php

namespace App\Controllers;

use App\Models\CheckoutModel;
use App\Models\CheckoutProdukModel;
use App\Models\AdminTokoModel;

class ReportController extends BaseController
{

    public function index()
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $adminTokoModel = new AdminTokoModel();
        $perPage = 10;

        $startDate = $this->request->getVar('startDate');
        $endDate = $this->request->getVar('endDate');

        $adminToko = $adminTokoModel->getAdminToko(user_id());
        if (empty($adminToko)) {
            return view('dashboard/adminNotlisted');
        }

        $id_toko = $adminToko[0]['id_toko'];

        $getCheckoutWithProduct = $checkoutModel->getCheckoutWithProduct($id_toko, $perPage, $startDate, $endDate);
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
            'market' => $adminToko,
        ];
        // dd($data);
        return view('dashboard/report/report', $data);
    }

    public function print()
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();

        $perPage = 10;

        $startDate = $this->request->getGet('startDate');
        $endDate = $this->request->getGet('endDate');

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

        return view('dashboard/report/printData', $data);
    }
}
