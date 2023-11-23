<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlamatUserModel;
use App\Models\CheckoutModel;
use App\Models\CheckoutProdukModel;
use App\Models\TokoModel;

class GoSendController extends BaseController
{
    public function index()
    {
        //
    }

    public function gosendUpdate($id)
    {
        $checkoutProdModel = new CheckoutProdukModel();
        $order = $checkoutProdModel->getTransaksi($id);
        $GoSendStatus = $this->getStatusGosend($id);
        $data = [
            'inv' => $id,
            'orders' => $order,
            'order' => $order[0],
            'gosendStatus' => $GoSendStatus
        ];
        if ($order[0]['id_destination']) {
            $alamatUserModel = new AlamatUserModel();
            $data['destination'] = $alamatUserModel->find($order[0]['id_destination']);
        }
        // dd($data);
        return view('dashboard/pesanan/GoSend/GoSendUpdate', $data);
    }

    public function pickUp($id)
    {
        if ($id != $this->request->getVar('inv')) {
            return redirect()->back();
        }
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $tokoModel = new TokoModel();
        $alamatUserModel = new AlamatUserModel();
        $t = $checkoutModel->where('gosend', 1)->like('id_checkout', $id)->orLike('invoice', $id)->orderBy('id_checkout')->first();
        $req = $this->request->getVar('req');
        if ($req == 'pickup' || $req == 'send') {
            $ida = 3;
        } elseif ($req == 'cancel') {
            $ida = 5;
        } else {
            $ida = 2;
        }
        $data = [
            'id_checkout' => $t['id_checkout'],
            'id_status_pesan' => $ida
        ];
        $checkoutModel->save($data);
        $produk = $checkoutProdModel->getAllProdukByIdCheckout($t['id_checkout']);
        $origin = $tokoModel->find($t['id_toko']);
        $destination = $alamatUserModel->find($t['id_destination']);


        foreach ($produk as $key => $p) {
            $insuranceDetails[$key] = [
                "applied" => "false",
                "fee" => "0",
                "product_description" => $p['nama'] . ' (' . $p['value_item'] . ')',
                "product_price" => $p['harga'],
            ];
        }
        $item = "";
        foreach ($insuranceDetails as $key => $detail) {
            $item .= $detail["product_description"];
            if ($key !== array_key_last($insuranceDetails)) {
                $item .= ", ";
            }
        }
        $insuranceDetails[0]['product_description'] = $item;
        $insuranceDetails[0]['product_price'] = $t['total_1'];

        $body = [
            "paymentType" => 3,
            "collection_location" => $req,
            "shipment_method" => $t['service'],
            "routes" =>
            [[
                "originName" => 'Ssayomart ' . $origin['lable'],
                "originNote" => $this->request->getVar('note'),
                "originContactName" => 'Ssayomart ' . $origin['lable'],
                "originContactPhone" => $this->formatTelp($origin['telp']),
                "originLatLong" => $origin['latitude'] . ',' . $origin['longitude'],
                "originAddress" => $origin['alamat_1'],
                "destinationName" => $destination['penerima'],
                "destinationNote" => "Tolong Hati-Hati",
                "destinationContactName" => $destination['penerima'],
                "destinationContactPhone" => $this->formatTelp($destination['telp']),
                "destinationLatLong" => $destination['latitude'] . ',' . $destination['longitude'],
                "destinationAddress" => $destination['alamat_1'],
                "item" => $item,
                "storeOrderId" => $id,
                "insuranceDetails" => $insuranceDetails[0]
            ]]
        ];
        $response = [
            'status' => 200,
            'success' => 'PickUp Button',
            'type' => 'For PickUp development stage',
            'message' => 'For Ssayomart Team : please add callback for curl request',
            'bodypayload' => $body,
            'response' => $this->bookingAPI($body)

        ];
        return response()->setJSON($response, 200);
    }
    function formatTelp($nomor)
    {
        // Menghapus karakter selain angka dari nomor telepon
        $nomor = preg_replace('/[^0-9]/', '', $nomor);

        // Memeriksa apakah nomor telepon diawali dengan 0
        if (substr($nomor, 0, 1) === '0') {
            // Mengganti awalan 0 dengan 62
            $nomor = '62' . substr($nomor, 1);
        }

        return $nomor;
    }
    function bookingAPI($body = [])
    {
        $webhookConfig = config('WebHook');
        $baseUrl = $webhookConfig->base_url;
        $clientId = $webhookConfig->client_id;
        $pasKey = $webhookConfig->pas_key;

        $endpoint = $baseUrl . '/gokilat/v10/booking';

        // Request headers
        $headers = array(
            'Accept: application/json',
            'Client-ID: ' . $clientId,
            'Pass-Key: ' . $pasKey
        );

        // Request body payload
        $data = $body;

        // Convert the data array to JSON format
        $jsonData = json_encode($data);

        // Initialize cURL session
        $ch = curl_init($endpoint);

        // Set cURL options
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Execute cURL session and get the response
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            echo 'Curl error: ' . curl_error($ch);
        }

        // Close cURL session
        curl_close($ch);

        // Print the response
        return $response;
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
