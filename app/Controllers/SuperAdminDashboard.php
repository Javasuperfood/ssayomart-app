<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CheckoutModel;
use App\Models\CheckoutProdukModel;
use App\Models\AdminTokoModel;

class SuperAdminDashboard extends BaseController
{
    public function index()
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $perPage = 10;

        // Tambahkan fungsi untuk mendapatkan daftar cabang
        $branches = $checkoutModel->getBranches();
        $adminToko = $checkoutModel->getSuperAdminReport($perPage);

        $getSuperAdminReport = $checkoutModel->getSuperAdminReport($perPage);
        foreach ($getSuperAdminReport as $key => $c) {
            $getSuperAdminReport[$key]['produk'] = $checkoutProdModel->getProdukByIdCheckout($c['id_checkout']);
        }
        $currentPage = $this->request->getVar('page_checkout') ? $this->request->getVar('page_checkout') : 1;

        $data = [
            'getSuperAdminReport' => $getSuperAdminReport,
            'pager' => $checkoutModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1,
            'market' => $adminToko,
            'branches' => $branches, // Sertakan daftar cabang
        ];
        $data['penjualan'] = $checkoutModel->getSalesReportByBranch(1);
        // dd($data);
        return view('dashboard/superadmin/dashboard', $data);
    }


    public function detailinv()
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $adminTokoModel = new AdminTokoModel();
        $perPage = 10;

        $startDate = $this->request->getVar('startDate');
        $endDate = $this->request->getVar('endDate');

        // Tambahkan fungsi untuk mendapatkan daftar cabang
        $branches = $checkoutModel->getBranches();
        $adminToko = $adminTokoModel->getAdminToko(user_id());

        $getSuperAdminReport = $checkoutModel->getSuperAdminReport($perPage, $startDate, $endDate);
        foreach ($getSuperAdminReport as $key => $c) {
            $getSuperAdminReport[$key]['produk'] = $checkoutProdModel->getProdukByIdCheckout($c['id_checkout']);
        }
        $currentPage = $this->request->getVar('page_checkout') ? $this->request->getVar('page_checkout') : 1;

        $data = [
            'getSuperAdminReport' => $getSuperAdminReport,
            'pager' => $checkoutModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'market' => $adminToko,
            'branches' => $branches, // Sertakan daftar cabang
        ];
        $data['penjualan'] = $checkoutModel->getSalesReportByBranch(1);

        return view('dashboard/superadmin/detailInv', $data);
    }
}
