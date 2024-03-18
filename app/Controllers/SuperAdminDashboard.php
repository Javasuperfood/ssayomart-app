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
    private $url;
    private $apiKey;
    private $key;

    public function __construct()
    {
        $this->url = getenv('API_URL_RO');
        $this->apiKey = getenv('API_KEY_RO');
        $this->key = "15139";
    }

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
        $checkoutProdukModel = new CheckoutProdukModel();
        // Define and initialize variables
        $provinceId = 1; // Replace 1 with the actual province ID
        $regionId = 1;   // Replace 1 with the actual region ID
        $date = '2024-03-14'; // Replace '2024-03-14' with the actual date in the format 'YYYY-MM-DD'
        $provinsi = $this->rajaongkir('province');

        $checkoutReport = $checkoutProdukModel->getSalesDataByRegion($provinceId, $regionId, $date);

        $data = [
            'salesData' => $checkoutReport,
            'provinsi' => [],
        ];
        // dd($provinsi);
        if (json_decode($provinsi)->rajaongkir->status->code == 200) {
            $data['provinsi'] = json_decode($provinsi)->rajaongkir->results;
        }
        return view('dashboard/superadmin/regionReport', $data);
    }

    // FETCHING DATA API PROVINSI & KOTA
    public function getCity()
    {
        if ($this->request->isAJAX()) {
            $id_province = $this->request->getGet('id_province');
            $data = $this->rajaongkir('city', $id_province);
            return $this->response->setJSON($data);
        }
    }

    // GET DATA API RAJAONGKIR
    public function getCost()
    {
        if ($this->request->isAJAX()) {
            $origin = $this->request->getGet('origin');
            $destination = $this->request->getGet('destination');
            $weight = $this->request->getGet('weight');
            $courier = $this->request->getGet('courier');
            $data = $this->rejaongkircost($origin, $destination, $weight, $courier);
            return $this->response->setJSON($data);
        }
    }
    private function rejaongkircost($origin, $destination, $weight, $courier)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier . "",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: " . $this->apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        $response = json_decode($response, true);
        foreach ($response['rajaongkir']['results'][0]['costs'] as $key => $value) {
            $response['rajaongkir']['results'][0]['costs'][$key]['cost'][0]['encodeCost'] = $this->encryptValue($value['cost'][0]['value'], $this->key);
        }
        return $response;
    }

    private function rajaongkir($method, $id_province = null)
    {
        $endPoint = $this->url . $method;
        if ($id_province != null) {
            # code...
            $endPoint = $endPoint . "?province=" . $id_province;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: " . $this->apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return $response;
    }
    function encryptValue($value, $key)
    {
        $cipher = "aes-256-cbc";
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $encrypted = openssl_encrypt($value, $cipher, $key, 0, $iv);
        return base64_encode($iv . $encrypted);
    }
}
