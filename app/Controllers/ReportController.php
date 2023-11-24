<?php

namespace App\Controllers;

use App\Models\CheckoutModel;

class ReportController extends BaseController
{
    public function index()
    {
        $checkoutModel = new CheckoutModel();
        $getCheckoutWithProduct = $checkoutModel->getCheckoutWithProduct();

        $perPage = 10;

        $currentPage = $this->request->getVar('page_checkout') ? $this->request->getVar('page_checkout') : 1;

        $checkoutList = $checkoutModel->paginate($perPage, 'page_checkout');

        $data = [
            'getCheckoutWithProduct' => $getCheckoutWithProduct,
            'checkout' => $checkoutList,
            'pager' => $checkoutModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1,
        ];
        return view('dashboard/report/report', $data);
    }

    public function print()
    {
        $checkoutModel = new CheckoutModel();
        $getCheckoutWithProduct = $checkoutModel->getCheckoutWithProduct();

        $data = ['getCheckoutWithProduct' => $getCheckoutWithProduct];

        return view('dashboard/report/printData', $data);
    }
}
