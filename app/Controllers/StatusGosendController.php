<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlamatUserModel;
use App\Models\CheckoutProdukModel;
use App\Models\KategoriModel;
use App\Models\UsersModel;
use Midtrans\Config as MidtransConfig;



class StatusGosendController extends BaseController
{
    public function statusGosend()
    {
        $kategori = new KategoriModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $userModel = new UsersModel();
        $id = $this->request->getVar('order_id');
        $order = $checkoutProdModel->getTransaksi($id);
        $GoSendStatus = $this->getStatusGosend($id);
        if ($order[0]['id_destination']) {
            $alamatUserModel = new AlamatUserModel();
            $data['destination'] = $alamatUserModel->find($order[0]['id_destination']);
        }

        $cekProduk = $userModel->getTransaksi($id);


        $data = [
            'title' => 'Status Gosend',
            'kategori' => $kategori->findAll(),
            'gosendStatus' => $GoSendStatus,
            'payment' => $this->getStatusMidtrans($id),
            'produk' => $cekProduk,

        ];
        $status = [];
        // ['Finding Driver', 'Cancelled', 'Completed', 'Enroute Drop', 'Driver not found', 'Enroute Pickup', 'Driver Allocated', 'Item Picked', 'On Hold', 'Rejected'
        if ($GoSendStatus) {
            if (in_array($GoSendStatus['status'], ['Finding Driver'])) {
                $status[] = 'Finding Driver';
            }
            if (in_array($GoSendStatus['status'], ['Enroute Pickup'])) {
                $status[] = 'Finding Driver';
                $status[] = 'Enroute Pickup';
            }
            if (in_array($GoSendStatus['status'], ['Item Picked'])) {
                $status[] = 'Finding Driver';
                $status[] = 'Enroute Pickup';
                $status[] = 'Item Picked';
            }
            if (in_array($GoSendStatus['status'], ['Enroute Drop'])) {
                $status[] = 'Finding Driver';
                $status[] = 'Enroute Pickup';
                $status[] = 'Item Picked';
                $status[] = 'Driver Enroute Drop';
            }
            if (in_array($GoSendStatus['status'], ['Completed'])) {
                $status[] = 'Finding Driver';
                $status[] = 'Enroute Pickup';
                $status[] = 'Item Picked';
                $status[] = 'Enroute Drop Success';
                $status[] = 'Completed';
            }
            if (in_array($GoSendStatus['status'], ['Cancelled'])) {
                $status[] = 'Finding Driver';
                $status[] = 'Cancelled';
            }
            $data['status'] = $status;
        }
        // dd($data);
        return view('user/home/statusGosend/statusGosend', $data);
    }

    function getStatusGosend($id)
    {
        $webhookConfig = config('WebHook');
        $baseUrl = $webhookConfig->base_url;
        $clientId = $webhookConfig->client_id;
        $pasKey = $webhookConfig->pas_key;
        $endpoint = $baseUrl . '/gokilat/v10/booking/storeOrderId';

        $headers = array(
            'Accept: application/json',
            'Client-ID: ' . $clientId,
            'Pass-Key: ' . $pasKey
        );

        $url = "{$endpoint}/{$id}";

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return 'Error: ' . curl_error($ch);
        }
        curl_close($ch);
        return json_decode($response, true);
        return response()->setJSON($response);
    }

    function getStatusMidtrans($id)
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

        $paymentStatus = \Midtrans\Transaction::status($id);

        return (array)$paymentStatus;
    }
}
