<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CheckoutModel;
use App\Models\CheckoutProdukModel;
use App\Models\StatusPesanModel;
use Midtrans\Config as MidtransConfig;
use TCPDF;

class AdminPesananController extends BaseController
{
    // =============================================== Route Get =================================================

    public function index()
    {
        $checkoutProdModel = new CheckoutProdukModel();

        $currentPage = $this->request->getVar('page_order') ? $this->request->getVar('page_order') : 1;

        $perPage = 10;
        $checkoutProdModel->paginate($perPage, 'order');
        $allOrder = $checkoutProdModel->getAllTransaksi($perPage, $currentPage);
        $data = [
            'order' => $allOrder,
            'pager' => $checkoutProdModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1
        ];
        // dd($data);
        return view('dashboard/pesanan/index', $data);
    }

    public function awaitingPayment()
    {
        $checkoutProdModel = new CheckoutProdukModel();

        $currentPage = $this->request->getVar('page_order') ? $this->request->getVar('page_order') : 1;

        $perPage = 10;
        $checkoutProdModel->paginate($perPage, 'order');
        $allOrder = $checkoutProdModel->getAllTransaksiWithStatus($perPage, $currentPage, 1);
        $data = [
            'order' => $allOrder,
            'pager' => $checkoutProdModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1
        ];
        // dd($data);
        return view('dashboard/pesanan/index', $data);
    }

    public function inProccess()
    {
        $checkoutProdModel = new CheckoutProdukModel();
        $statusPesanModel = new StatusPesanModel();

        $currentPage = $this->request->getVar('page_order') ? $this->request->getVar('page_order') : 1;

        $perPage = 10;
        $checkoutProdModel->paginate($perPage, 'order');
        $allOrder = $checkoutProdModel->getAllTransaksiWithStatus($perPage, $currentPage, 2);
        $data = [
            'pages' => 'in-progress',
            'order' => $allOrder,
            'pager' => $checkoutProdModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1,
            'statusPesan' => $statusPesanModel->findAll()
        ];
        // dd($data);
        return view('dashboard/pesanan/index', $data);
    }

    public function beingDelivered()
    {
        $checkoutProdModel = new CheckoutProdukModel();
        $statusPesanModel = new StatusPesanModel();

        $currentPage = $this->request->getVar('page_order') ? $this->request->getVar('page_order') : 1;

        $perPage = 10;
        $checkoutProdModel->paginate($perPage, 'order');
        $allOrder = $checkoutProdModel->getAllTransaksiWithStatus($perPage, $currentPage, 3);
        $data = [
            'pages' => 'being-delivered',
            'order' => $allOrder,
            'pager' => $checkoutProdModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1,
            'statusPesan' => $statusPesanModel->findAll()
        ];
        // dd($data);
        return view('dashboard/pesanan/index', $data);
    }
    public function delivered()
    {
        $checkoutProdModel = new CheckoutProdukModel();
        $statusPesanModel = new StatusPesanModel();

        $currentPage = $this->request->getVar('page_order') ? $this->request->getVar('page_order') : 1;

        $perPage = 10;
        $checkoutProdModel->paginate($perPage, 'order');
        $allOrder = $checkoutProdModel->getAllTransaksiWithStatus($perPage, $currentPage, 4);
        $data = [
            'pages' => 'being-delivered',
            'order' => $allOrder,
            'pager' => $checkoutProdModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1,
            'statusPesan' => $statusPesanModel->findAll()
        ];
        // dd($data);
        return view('dashboard/pesanan/index', $data);
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
        $page = $this->request->getVar('page');
        $checkoutModel = new CheckoutModel();

        if (!$checkoutModel->save(['id_checkout' => $id, 'id_status_pesan' => $this->request->getVar('status')])) {
            return redirect()->to(base_url('dashboard/order/in-proccess'))->withInput();
        }
        $goBack = base_url() . 'dashboard/order/in-proccess';
        return redirect()->to(($page != 1) ? $goBack : $goBack . '?page_order=' . $page);
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
        $allOrder = $checkoutProdModel->getAllPrint();
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
        $checkout =  $checkoutModel->find($id);
        $data = [
            'layanan' => 1000,
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
