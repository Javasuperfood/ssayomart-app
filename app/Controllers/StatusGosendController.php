<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlamatUserModel;
use App\Models\CheckoutProdukModel;
use App\Models\KategoriModel;



class StatusGosendController extends BaseController
{
    public function statusGosend()
    {
        $kategori = new KategoriModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $id = $this->request->getVar('order_id');
        $order = $checkoutProdModel->getTransaksi($id);
        $GoSendStatus = $this->getStatusGosend($id);
        if ($order[0]['id_destination']) {
            $alamatUserModel = new AlamatUserModel();
            $data['destination'] = $alamatUserModel->find($order[0]['id_destination']);
        }
        $data = [
            'title' => 'status Gosend',
            'kategori' => $kategori->findAll(),
            'gosendStatus' => $GoSendStatus
        ];
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
}
