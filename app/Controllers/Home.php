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

        $currentPage = $this->request->getVar('page_stock') ? $this->request->getVar('page_stock') : 1;

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

    public function testConfigMidtarns()
    {
        //
        $config = new \Config\Midtrans();
        dd($config->serverKey);
        return 'a';
    }

     public function panduanAplikasi()
    {
        $data = [
            'title' => 'Panduan Aplikasi',
        ];
        return view('dashboard/panduan/panduanAplikasi', $data);
    }

}
