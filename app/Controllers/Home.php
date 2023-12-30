<?php

namespace App\Controllers;

use App\Models\StockModel;
use App\Models\AdminTokoModel;

class Home extends BaseController
{
    public function dashboard()
    {
        $stockModel = new StockModel();
        $adminTokoModel = new AdminTokoModel();
        $perPage = 10;

        $adminToko = $adminTokoModel->getAdminToko(user_id());
        if (empty($adminToko)) {
            return view('dashboard/adminNotlisted');
        }

        $id_toko = $adminToko[0]['id_toko'];

        $getStockWithProduct = $stockModel->getStockWithProduct($perPage, $id_toko);
        $currentPage = $this->request->getVar('page_stock') ? $this->request->getVar('page_stock') : 1;

        $data = [
            'getStockWithProduct' => $getStockWithProduct,
            'pager' => $stockModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1,
            'market' => $adminToko,
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
