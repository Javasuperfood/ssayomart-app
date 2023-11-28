<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlamatUserModel;
use App\Models\CheckoutModel;
use App\Models\CheckoutProdukModel;
use App\Models\StatusPesanModel;
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
        $statusPesananModel = new StatusPesanModel();
        $order = $checkoutProdModel->getTransaksi($id);
        $GoSendStatus = $this->getStatusGosend($id);

        // $id_status_pesan = $this->request->getVar('status');
        $status_transaction = false;

        $data = [
            'inv' => $id,
            'orders' => $order,
            'order' => $order[0],
            'gosendStatus' => $GoSendStatus,
            'statusPesanan' => $statusPesananModel->findAll(),
            'status_transaction' => $status_transaction,
        ];

        if ($order[0]['id_destination']) {
            $alamatUserModel = new AlamatUserModel();
            $data['destination'] = $alamatUserModel->find($order[0]['id_destination']);
        }
        // dd($data);
        return view('dashboard/pesanan/GoSend/GoSendUpdate', $data);
    }

    public function updateStatusOrder($id)
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $statusPesananModel = new StatusPesanModel();
        $order = $checkoutProdModel->getTransaksi($id);
        $GoSendStatus = $this->getStatusGosend($id);

        $id_checkout = $this->request->getVar('id_checkout');
        $id_status_pesan = $this->request->getVar('status');

        $data = [
            'inv' => $id,
            'orders' => $order,
            'order' => $order[0],
            'gosendStatus' => $GoSendStatus,
            'statusPesanan' => $statusPesananModel->findAll(),
        ];

        if ($order[0]['id_destination']) {
            $alamatUserModel = new AlamatUserModel();
            $data['destination'] = $alamatUserModel->find($order[0]['id_destination']);
        }

        if ($checkoutModel->save(['id_checkout' => $id_checkout, 'id_status_pesan' => $id_status_pesan])) {
            session()->setFlashdata('success', 'Status berhasil diubah.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Status berhasil diubah.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->back()->withInput();
        }
    }

    public function orderSucceed($id)
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $order = $checkoutProdModel->getTransaksi($id);
        $GoSendStatus = $this->getStatusGosend($id);

        $id_checkout = $checkoutModel->where('invoice', $id)->first()['id_checkout'];
        $status_transaction = true;

        $data = [
            'inv' => $id,
            'id_checkout' => $id_checkout,
            'orders' => $order,
            'order' => $order[0],
            'gosendStatus' => $GoSendStatus,
            'status_transaction' => $status_transaction,
            'id_status_pesan' => 4,
        ];
        // dd($data);

        if ($order[0]['id_destination']) {
            $alamatUserModel = new AlamatUserModel();
            $data['destination'] = $alamatUserModel->find($order[0]['id_destination']);
        }

        if (!$checkoutModel->update($id_checkout, $data)) {
            $alert = [
                'type' => 'error',
                'title' => 'Gagal',
                'message' => 'Gagal mengupdate status'
            ];
        } else {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Berhasil mengupdate status'
            ];
        }
        session()->setFlashdata('alert', $alert);

        return redirect()->back()->withInput();
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
        // $response = [
        //     'status' => 200,
        //     'success' => 'PickUp Button',
        //     'type' => 'For PickUp development stage',
        //     'message' => 'For Ssayomart Team : please add callback for curl request',
        //     'bodypayload' => $body,
        //     'response' => $this->bookingAPI($body)

        // ];
        // return response()->setJSON($response, 200);

        $storeDataToGoSend = $this->bookingAPI($body);
        if ($storeDataToGoSend['status_code'] === 201) {
            $alert = [
                'type' => 'success',
                'title' => 'Success',
                'message' => 'Booking Berhasil'
            ];
            return redirect()->back()->with('alert', $alert);
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => $storeDataToGoSend['response']
            ];
            return redirect()->back()->with('alert', $alert);
        }
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
        $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        // Close cURL session
        curl_close($ch);

        // Print the response
        return [
            'status_code' => $httpStatusCode,
            'response' => $response
        ];
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

    public function gosendCancel($no)
    {
        $bookingNo = $this->request->getVar('orderNo');
        $webhookConfig = config('WebHook');
        if ($bookingNo != $no) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'No. Booking Tidak Sesuai!'
            ];
            return redirect()->back()->with('alert', $alert);
        }
        $baseUrl = $webhookConfig->base_url;
        $clientId = $webhookConfig->client_id;
        $pasKey = $webhookConfig->pas_key;
        $url = $baseUrl . "/gokilat/v10/booking/cancel";
        $method = "PUT";
        $headers = [
            'Accept: application/json',
            'Client-ID: ' . $clientId,
            'Pass-Key: ' . $pasKey
        ];

        $data = [
            "orderNo" => $bookingNo
        ];
        // dd($data);
        $payload = json_encode($data);

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        // Handle the response
        if ($httpCode == 200) {
            $response = json_decode($response, true);
            $alert = [
                'type' => 'success',
                'title' => 'Success',
                'message' => $response['message']
            ];
            return redirect()->back()->with('alert', $alert);
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Request failed. HTTP Code: ' . $httpCode . ', Response: ' . $response
            ];
            return redirect()->back()->with('alert', $alert);
        }
    }
}
