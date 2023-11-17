<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminTokoModel;
use App\Models\CheckoutModel;
use App\Models\CheckoutProdukModel;
use App\Models\StatusPesanModel;
use App\Models\StockModel;
use App\Models\TokoModel;
use App\Models\UsersModel;
use Midtrans\Config as MidtransConfig;
use TCPDF;


class AdminPesananController extends BaseController
{
    // =============================================== Route Get =================================================

    public function index2()
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $statusPesanModel = new StatusPesanModel();
        $adminTokoModel = new AdminTokoModel();
        $tokoModel = new TokoModel();

        $toko = $adminTokoModel->where('id_user', user_id())->findAll();

        $currentPage = $this->request->getVar('page_order') ? $this->request->getVar('page_order') : 1;
        $shipment = $this->request->getVar('shipment') ? $this->request->getVar('shipment') : 'all';
        $kurir = ($shipment == 'GoSend') ? 1 : (($shipment == 'non-GoSend') ? 0 : 'all');

        $perPage = 10;

        if (!empty($toko)) {
            $checkout = $checkoutModel->getOrder($perPage, $toko[0]['id_toko'], null, $kurir);
        } else {
            return view('dashboard/pesanan/index2');
        }

        foreach ($checkout as $key => $c) {
            $checkout[$key]['produk'] = $checkoutProdModel->getProdukByIdCheckout($c['id_checkout']);
        }

        $data = [
            'pages' => '',
            'checkout' => $checkout,
            'pager' => $checkoutModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1,
            'statusPesan' => $statusPesanModel->findAll(),
            'shipment' => $shipment,
        ];

        foreach ($toko as $key => $t) {
            $data['toko'][$key] = $tokoModel->find($t['id_toko'])['lable'];
        }

        // dd($data);
        return view('dashboard/pesanan/index2', $data);
    }

    public function awaitingPayment()
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $statusPesanModel = new StatusPesanModel();
        $adminTokoModel = new AdminTokoModel();
        $tokoModel = new TokoModel();

        $toko = $adminTokoModel->where('id_user', user_id())->findAll();

        $currentPage = $this->request->getVar('page_order') ? $this->request->getVar('page_order') : 1;
        $shipment = $this->request->getVar('shipment') ? $this->request->getVar('shipment') : 'all';
        $kurir = ($shipment == 'GoSend') ? 1 : (($shipment == 'non-GoSend') ? 0 : 'all');

        $perPage = 10;

        if (!empty($toko)) {
            $checkout = $checkoutModel->getOrder($perPage, $toko[0]['id_toko'], 1, $kurir);
        } else {
            return view('dashboard/pesanan/index2');
        }

        foreach ($checkout as $key => $c) {
            $checkout[$key]['produk'] = $checkoutProdModel->getProdukByIdCheckout($c['id_checkout']);
        }

        $data = [
            'pages' => 'awaiting-payment',
            'checkout' => $checkout,
            'pager' => $checkoutModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1,
            'statusPesan' => $statusPesanModel->findAll(),
            'shipment' => $shipment,
        ];

        foreach ($toko as $key => $t) {
            $data['toko'][$key] = $tokoModel->find($t['id_toko'])['lable'];
        }

        // dd($data);
        return view('dashboard/pesanan/index2', $data);
    }

    public function inProccess()
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $statusPesanModel = new StatusPesanModel();
        $adminTokoModel = new AdminTokoModel();
        $tokoModel = new TokoModel();

        $toko = $adminTokoModel->where('id_user', user_id())->findAll();

        $currentPage = $this->request->getVar('page_order') ? $this->request->getVar('page_order') : 1;
        $shipment = $this->request->getVar('shipment') ? $this->request->getVar('shipment') : 'all';
        $kurir = ($shipment == 'GoSend') ? 1 : (($shipment == 'non-GoSend') ? 0 : 'all');

        $perPage = 10;

        if (!empty($toko)) {
            $checkout = $checkoutModel->getOrder($perPage, $toko[0]['id_toko'], 2, $kurir);
        } else {
            return view('dashboard/pesanan/index2');
        }

        foreach ($checkout as $key => $c) {
            $checkout[$key]['produk'] = $checkoutProdModel->getProdukByIdCheckout($c['id_checkout']);
        }

        $data = [
            'pages' => 'in-proccess',
            'checkout' => $checkout,
            'pager' => $checkoutModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1,
            'statusPesan' => $statusPesanModel->findAll(),
            'shipment' => $shipment,
        ];

        foreach ($toko as $key => $t) {
            $data['toko'][$key] = $tokoModel->find($t['id_toko'])['lable'];
        }

        // dd($data);
        return view('dashboard/pesanan/index2', $data);
    }

    public function beingDelivered()
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $statusPesanModel = new StatusPesanModel();
        $adminTokoModel = new AdminTokoModel();
        $tokoModel = new TokoModel();

        $toko = $adminTokoModel->where('id_user', user_id())->findAll();

        $currentPage = $this->request->getVar('page_order') ? $this->request->getVar('page_order') : 1;

        $shipment = $this->request->getVar('shipment') ? $this->request->getVar('shipment') : 'all';
        $kurir = ($shipment == 'GoSend') ? 1 : (($shipment == 'non-GoSend') ? 0 : 'all');

        $perPage = 10;

        if (!empty($toko)) {
            $checkout = $checkoutModel->getOrder($perPage, $toko[0]['id_toko'], 3, $kurir);
        } else {
            return view('dashboard/pesanan/index2');
        }

        foreach ($checkout as $key => $c) {
            $checkout[$key]['produk'] = $checkoutProdModel->getProdukByIdCheckout($c['id_checkout']);
        }

        $data = [
            'pages' => 'being-delivered',
            'checkout' => $checkout,
            'pager' => $checkoutModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1,
            'statusPesan' => $statusPesanModel->findAll(),
            'shipment' => $shipment,
        ];

        foreach ($toko as $key => $t) {
            $data['toko'][$key] = $tokoModel->find($t['id_toko'])['lable'];
        }

        // dd($data);
        return view('dashboard/pesanan/index2', $data);
    }
    public function delivered()
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $statusPesanModel = new StatusPesanModel();
        $adminTokoModel = new AdminTokoModel();
        $tokoModel = new TokoModel();

        $toko = $adminTokoModel->where('id_user', user_id())->findAll();

        $currentPage = $this->request->getVar('page_order') ? $this->request->getVar('page_order') : 1;
        $shipment = $this->request->getVar('shipment') ? $this->request->getVar('shipment') : 'all';
        $kurir = ($shipment == 'GoSend') ? 1 : (($shipment == 'non-GoSend') ? 0 : 'all');

        $perPage = 10;

        if (!empty($toko)) {
            $checkout = $checkoutModel->getOrder($perPage, $toko[0]['id_toko'], 4, $kurir);
        } else {
            return view('dashboard/pesanan/index2');
        }

        foreach ($checkout as $key => $c) {
            $checkout[$key]['produk'] = $checkoutProdModel->getProdukByIdCheckout($c['id_checkout']);
        }

        $data = [
            'pages' => 'delivered',
            'checkout' => $checkout,
            'pager' => $checkoutModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1,
            'statusPesan' => $statusPesanModel->findAll(),
            'shipment' => $shipment,
        ];

        foreach ($toko as $key => $t) {
            $data['toko'][$key] = $tokoModel->find($t['id_toko'])['lable'];
        }

        // dd($data);
        return view('dashboard/pesanan/index2', $data);
    }

    public function detail($inv)
    {
        $checkoutProdModel = new CheckoutProdukModel();
        $statusPesanModel = new StatusPesanModel();
        $order = $checkoutProdModel->getTransaksi($inv);
        $data = [
            'inv' => $inv,
            'orders' => $order,
            'order' => $order[0],
            'statusPesan' => $statusPesanModel->findAll()
        ];
        // dd($data);
        return view('dashboard/pesanan/detail', $data);
    }

    // =============================================== Store Data =================================================
    public function updateStatus($id)
    {
        $page = '?page_order=' . $this->request->getVar('page');
        $checkoutModel = new CheckoutModel();
        $stokModel = new StockModel();
        $checkoutProdModel = new CheckoutProdukModel();

        $checkout = $checkoutModel->find($id);

        $produk = $checkoutProdModel->getProdukByIdCheckout($id);

        if ($checkout['id_status_pesan'] == 2) {
            $id_toko = $checkout['id_toko'];
            foreach ($produk as $p) {
                $id_variasi_item = $p['id_variasi_item'];
                $id_produk = $p['id_produk'];
                $stok = $stokModel->where('id_toko', $id_toko)->where('id_produk', $id_produk)->where('id_variasi_item', $id_variasi_item)->first();
                if ($stok) {
                    if ($stok['stok'] > $p['qty']) {
                        $stokModel->save([
                            'id_stock' => $stok['id_stock'],
                            'stok' => $stok['stok'] - $p['qty'],
                        ]);
                    } else {
                        return redirect()->to(base_url('dashboard/order/in-proccess?' . $page))->withInput();
                    }
                }
            }
        }
        $url = base_url() . 'dashboard/order/';
        if (!$checkoutModel->save(['id_checkout' => $id, 'id_status_pesan' => $this->request->getVar('status')])) {
            return 'gagal update';
            return redirect()->to(base_url('dashboard/order/in-proccess'))->withInput();
        }
        return redirect()->to($url . $page);
    }
    // =============================================== Store Data Resi =================================================
    public function updateStatusResi($id)
    {
        $page = $this->request->getVar('page');
        $checkoutModel = new CheckoutModel();

        $url = base_url() . 'dashboard/order/';
        if (!$checkoutModel->save([
            'id_checkout' => $id, 'id_status_pesan' => $this->request->getVar('status'),
            'resi' => $this->request->getVar('resi'),
        ])) {
            return 'gagal update';
            return redirect()->to(base_url('dashboard/order/in-proccess'))->withInput();
        }
        return redirect()->to($url . $page);
    }

    // =============================================== Print Data  =================================================

    public function printAllOrder()
    {
        $midtransConfig = config('Midtrans');

        // Set the Midtrans API credentials
        MidtransConfig::$serverKey = $midtransConfig->serverKey;
        MidtransConfig::$clientKey = $midtransConfig->clientKey;
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        MidtransConfig::$isProduction = $midtransConfig->isProduction;
        // Set sanitization on (default)
        MidtransConfig::$isSanitized = $midtransConfig->isSanitized;
        // Set 3DS transaction for credit card to true
        MidtransConfig::$is3ds = $midtransConfig->is3ds;
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $adminTokoModel = new AdminTokoModel();
        $tokoModel = new TokoModel();

        $toko = $adminTokoModel->where('id_user', user_id())->findAll();
        $allOrder = $checkoutProdModel->getAllPrint($toko);
        $data = [
            'layanan' => 1000,
            'checkout' => $allOrder,
        ];
        if ($allOrder[0]['id_status_pesan'] != '1') {
            try {
                /**
                 * @var object $paymentStatus
                 */
                $paymentStatus = \Midtrans\Transaction::status($allOrder[0]['invoice']);
                $data['paymentStatus'] = $paymentStatus;
            } catch (\Exception $e) {
                // echo "An error occurred: " . $e->getMessage();
            }
        }

        $data['toko'] = $tokoModel->find($toko[0]['id_toko']);


        // dd($data);
        return view('dashboard/pesanan/printAllOrder', $data);
    }

    public function printOrder($id)
    {
        $midtransConfig = config('Midtrans');

        // Set the Midtrans API credentials
        MidtransConfig::$serverKey = $midtransConfig->serverKey;
        MidtransConfig::$clientKey = $midtransConfig->clientKey;
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        MidtransConfig::$isProduction = $midtransConfig->isProduction;
        // Set sanitization on (default)
        MidtransConfig::$isSanitized = $midtransConfig->isSanitized;
        // Set 3DS transaction for credit card to true
        MidtransConfig::$is3ds = $midtransConfig->is3ds;
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $statusPesanModel = new StatusPesanModel();
        $tokoModel = new TokoModel();
        $checkout =  $checkoutModel->find($id);

        $toko = $tokoModel->find($checkout['id_toko']);
        $data = [
            'toko' => $toko,
            'checkout' => $checkout,
            'produk' => $checkoutProdModel->getProdukByIdCheckout($id),
        ];
        if ($checkout['id_status_pesan'] != '1') {
            try {
                /**
                 * @var object $paymentStatus
                 */
                $paymentStatus = \Midtrans\Transaction::status($checkout['invoice']);
                $data['paymentStatus'] = $paymentStatus;
            } catch (\Exception $e) {
                // echo "An error occurred: " . $e->getMessage();
            }
        }

        if ($checkout['id_status_pesan'] > 2) {
            $data['status'] = $statusPesanModel->find($checkout['id_status_pesan']);
        }
        // dd($data);
        return view('dashboard/pesanan/printOrder', $data);
    }
}
