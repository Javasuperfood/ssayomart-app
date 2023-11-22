<?php

namespace App\Controllers;

use App\Models\CheckoutModel;

class ReportController extends BaseController
{
    public function index()
    {
        $checkoutModel = new CheckoutModel();
        $getCheckoutWithProduct = $checkoutModel->getCheckoutWithProduct();

        $data = [
            'getCheckoutWithProduct' => $getCheckoutWithProduct,
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
