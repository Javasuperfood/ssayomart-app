<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CheckoutModel;
use App\Models\CheckoutProdukModel;
use App\Models\UsersModel;
use App\Models\KategoriModel;
use App\Models\SubKategoriModel;
use App\Models\ProdukModel;
use App\Models\VariasiItemModel;

class SuperAdminDashboard extends BaseController
{
    // REPORT PENJUALAN PER-CABANG SSAYOMART
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

    // REPORT PENJUALAN PER-KATEGORI->SUB KATEGORI->PRODUK
    public function categoryReport()
    {
        $kategoriModel = new KategoriModel();
        $data['categories'] = $kategoriModel->findAll();

        return view('dashboard/superadmin/categoryReport', $data);
    }
    public function subCategoryReport($categoryId)
    {
        $subKategoriModel = new SubKategoriModel();
        $data['subcategories'] = $subKategoriModel->getSubcategoriesByCategoryId($categoryId);

        return view('dashboard/superadmin/subCategoryReport', $data);
    }

    public function filterReport($subcategoryId)
    {
        $produkModel = new ProdukModel();
        $checkoutProdukModel = new CheckoutProdukModel();

        $data['products'] = $produkModel->getProductsBySubcategoryId($subcategoryId);

        foreach ($data['products'] as &$product) {
            $product['terjual'] = $checkoutProdukModel->getTotalQtyTerjualByIdProduk($product['id_produk']);
            $product['harga'] = $checkoutProdukModel->getHargaByIdProduk($product['id_produk']);
        }

        return view('dashboard/superadmin/filterReport', $data);
    }



    // REPORT PENJUALAN PER-DAERAH (KECAMATAN ATAU KABUAPTEN)
    public function regionReport()
    {
        $kategoriModel = new KategoriModel();
        $data['categories'] = $kategoriModel->findAll();

        return view('dashboard/superadmin/regionReport', $data);
    }
}
