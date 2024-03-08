<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CheckoutModel;
use App\Models\CheckoutProdukModel;
use App\Models\AdminTokoModel;
use App\Models\UsersModel;

class SuperAdminDashboard extends BaseController
{
    public function index()
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $perPage = 10;

        // Tambahkan fungsi untuk mendapatkan daftar cabang
        $branches = $checkoutModel->getBranches();

        $adminToko = $adminTokoModel->getAdminToko(user_id());

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

        return view('dashboard/superadmin/dashboard', $data);
    }

    public function detailinv($id)
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $userModel = new UsersModel();
        $perPage = 10;

        $startDate = $this->request->getVar('startDate');
        $endDate = $this->request->getVar('endDate');

        $user = $userModel->find($id);

        $getSuperAdminReport = $checkoutModel->getSuperAdminReport($perPage, $startDate, $endDate, $id);

        // Loop untuk setiap transaksi
        foreach ($getSuperAdminReport as $key => $transaction) {
            // Mengambil data produk untuk setiap transaksi
            $getSuperAdminReport[$key]['produk'] = $checkoutProdModel->getProdukDetailByIdCheckout($transaction['id_checkout']);
        }

        $currentPage = $this->request->getVar('page_checkout') ? $this->request->getVar('page_checkout') : 1;

        $data = [
            'getSuperAdminReport' => $getSuperAdminReport,
            'pager' => $checkoutModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'user_id' => $user
        ];

        $data['penjualan'] = $checkoutModel->getSalesReportByBranch(1);
        // dd($data);

        return view('dashboard/superadmin/detailInv', $data);
    }
}
