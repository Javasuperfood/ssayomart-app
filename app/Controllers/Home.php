<?php

namespace App\Controllers;

use App\Models\CheckoutModel;

class Home extends BaseController
{
    // test role 
    public function dashboard()
    {
        $checkoutModel = new CheckoutModel();
        $checkoutWithProduk = $checkoutModel->getCheckoutWithProduk();

        return view('dashboard/home', ['checkoutWithProduk' => $checkoutWithProduk]);
    }

    public function admin(): string
    {
        return "admin";
    }
}
