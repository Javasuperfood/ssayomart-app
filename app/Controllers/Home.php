<?php

namespace App\Controllers;

use App\Models\StockModel;

class Home extends BaseController
{
    public function dashboard()
    {
        $stockModel = new StockModel();
        $perPage = 10;
        $getStockWithToko = $stockModel->getStockWithProduct($perPage);

        $currentPage = $this->request->getVar('page_dashboard') ? $this->request->getVar('page_dashboard') : 1;

        $data = [
            'getStockWithToko' => $getStockWithToko,
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
