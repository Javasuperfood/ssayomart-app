<?php

namespace App\Controllers;

use App\Models\CheckoutModel;

class ReportController extends BaseController
{
    public function index()
    {
        $checkoutModel = new CheckoutModel();
        $perPage = 10;

        $getCheckoutWithProduct = $checkoutModel->getCheckoutWithProduct($perPage);

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
        $perPage = 10;
        $getCheckoutWithProduct = $checkoutModel->getCheckoutWithProduct($perPage);

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
