<?php

namespace App\Controllers;

use App\Models\StockModel;

class Home extends BaseController
{
    public function dashboard()
    {
        $stockModel = new StockModel();
        $getStockWithToko = $stockModel->getStockWithProduct();

        $perPage = 5;
        $currentPage = $this->request->getVar('page_dashboard') ? $this->request->getVar('dashboard') : 1;

        $stockList = $stockModel->paginate($perPage, 'page_dashboard');

        $data = [
            'getStockWithToko' => $getStockWithToko,
            'stock' => $stockList,
            'pager' => $stockModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1,
        ];

        return view('dashboard/home', $data);
    }

    public function admin(): string
    {
        return "admin";
    }
}
