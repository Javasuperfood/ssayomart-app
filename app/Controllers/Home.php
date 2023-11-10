<?php

namespace App\Controllers;

use App\Models\StockModel;
use App\Models\CheckoutModel;
use Dompdf\Dompdf;

class Home extends BaseController
{
    // test role 
    public function dashboard()
    {
        $stockModel = new StockModel();
        $getStockWithToko = $stockModel->getStockWithProduct();

        return view('dashboard/home', ['getStockWithToko' => $getStockWithToko]);
    }

    public function admin(): string
    {
        return "admin";
    }

    public function show()
    {
        $checkoutModel = new CheckoutModel();
        $getCheckoutWithProduct = $checkoutModel->getCheckoutWithProduct();

        $data = ['getCheckoutWithProduct' => $getCheckoutWithProduct];
        // dd($data);
        return view('dashboard/report', $data);
    }

    public function print()
    {
        $checkoutModel = new CheckoutModel();
        $getCheckoutWithProduct = $checkoutModel->getCheckoutWithProduct();

        $data = ['getCheckoutWithProduct' => $getCheckoutWithProduct];

        return view('dashboard/printData', $data);
    }
}
