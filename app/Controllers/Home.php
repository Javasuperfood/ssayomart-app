<?php

namespace App\Controllers;

use App\Models\StockModel;

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
}
