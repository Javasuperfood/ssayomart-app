<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\AlamatUserModel;
use App\Models\CheckoutModel;
use App\Models\CheckoutProdukModel;
use App\Models\TokoModel;
use Faker\Core\Uuid;

class WebhookController extends BaseController
{
    use ResponseTrait;














    public function getOrder($invoice)
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdukModel = new CheckoutProdukModel();

        $orderData = $checkoutModel->getOrderByInvoice($invoice);

        if ($orderData) {
            $produkDetail = $checkoutProdukModel->getProdukDetailByIdCheckout($orderData['id_checkout']);

            $orderData['produk_detail'] = $produkDetail;

            return $this->response->setJSON($orderData);
        } else {
            return $this->response->setJSON(['error' => 'Data invoice tidak ditemukan']);
        }
    }
    public function pickupItem($id)
    {
        //
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $tokoModel = new TokoModel();
        $alamatUserModel = new AlamatUserModel();
        $t = $checkoutModel->where('gosend', 1)->like('id_checkout', $id)->orLike('invoice', $id)->orderBy('id_checkout')->first();
        $req = $this->request->getVar('req');
        if ($req == 'pickup' || $req == 'send') {
            $id = 3;
        } elseif ($req == 'cancel') {
            $id = 5;
        } else {
            $id = 2;
        }
        $data = [
            'id_checkout' => $t['id_checkout'],
            'id_status_pesan' => $id
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
        foreach ($insuranceDetails as $detail) {
            $item .= $detail["product_description"] . ", ";
        }

        $body = [
            "paymentType" => 3,
            "shipment_method" => "Instant",
            "routes" =>
            [[
                "originName" => 'Ssayomart ' . $origin['lable'],
                "originNote" => "Tunggu Di Lobby",
                "originContactName" => 'Ssayomart ' . $origin['lable'],
                "originContactPhone" => $this->formatTelp($origin['telp']),
                "originLatLong" => $origin['latitude'] . ',' . $origin['longitude'],
                "originAddress" => $origin['alamat_1'],
                "destinationName" => $destination['penerima'],
                "destinationNote" => "Tolong Hati-Hati",
                "destinationContactName" => $destination['alamat_2'],
                "destinationContactPhone" => $this->formatTelp($destination['telp']),
                "destinationLatLong" => $destination['latitude'] . ',' . $destination['longitude'],
                "destinationAddress" => $destination['alamat_1'],
                "item" => $item,
                "storeOrderId" => "Ssayomart" . $id,
                "insuranceDetails" => $insuranceDetails
            ]]
        ];
        $response = [
            'status' => 200,
            'success' => 'PickUp Button',
            'type' => 'For PickUp development stage',
            'message' => 'For Ssayomart Team : please add callback for curl request',
            'bodypayload' => $body,
            'response' => 'No response'

        ];
        return $this->respond($response, 200);
    }

    public function handlerPickupItem($id)
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $tokoModel = new TokoModel();
        $alamatUserModel = new AlamatUserModel();
        $error = $this->request->getVar('error');
        $t = $checkoutModel->where('gosend', 1)->like('invoice', $id)->orderBy('id_checkout')->first();

        if ($error) {
            $checkoutModel->save([
                'id_checkout' => $t['id_checkout'],
                'id_status_pesan' => 2
            ]);
            $response = [
                'status' => 200,
                'success' => 'Handle PickUp',
                'type' => 'Callback',
                'message' => 'error found. update order status kembali menjadi proses / Gagal',
                'response' => [
                    'order_status' => 'process',
                    'error' => $error
                ],
                'comment' => 'For Ssayomart Team : please add callback for curl request',
            ];
            return $this->respond($response, 200);
        }
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
        foreach ($insuranceDetails as $detail) {
            $item .= $detail["product_description"] . ", ";
        }

        $body = [
            "paymentType" => 3,
            "shipment_method" => "Instant",
            "routes" =>
            [[
                "originName" => 'Ssayomart ' . $origin['lable'],
                "originNote" => "Tunggu Di Lobby",
                "originContactName" => 'Ssayomart ' . $origin['lable'],
                "originContactPhone" => $this->formatTelp($origin['telp']),
                "originLatLong" => $origin['latitude'] . ',' . $origin['longitude'],
                "originAddress" => $origin['alamat_1'],
                "destinationName" => $destination['penerima'],
                "destinationNote" => "Tolong Hati-Hati",
                "destinationContactName" => $destination['alamat_2'],
                "destinationContactPhone" => $this->formatTelp($destination['telp']),
                "destinationLatLong" => $destination['latitude'] . ',' . $destination['longitude'],
                "destinationAddress" => $destination['alamat_1'],
                "item" => $item,
                "storeOrderId" => "Ssayomart" . $id,
                "insuranceDetails" => $insuranceDetails
            ]]
        ];
        $response = [
            'status' => 200,
            'success' => 'Handle PickUp',
            'type' => 'Callback',
            'message' => 'For Ssayomart Team : please add callback for curl request',
            'bodypayload' => $body,
            'response' => 'No response'

        ];
        return $this->respond($response, 200);
    }

    public function getSingleOrder()
    {
        $checkoutModel = new CheckoutModel();


        $order_id = $this->request->getVar('order_id') || null;
        $t = $checkoutModel->where('gosend', 1)->like('invoice', $order_id)->orderBy('id_checkout')->first();
        if (!$t) {
            return $this->respond([
                'status' => 404,
                'success' => false,
                'type' => 'Error',
                'comment' => 'For Ssayomart Team : please add callback for curl request',
                'response' => 'No Order Found'

            ], 404);
        }

        return $this->getSingleOrderF($t);
    }

    public function updateSingleOrder()
    {
        $checkoutModel = new CheckoutModel();


        $order_id = $this->request->getVar('order_id') || null;
        $status = $this->request->getVar('order_status');
        $t = $checkoutModel->where('gosend', 1)->like('invoice', $order_id)->orderBy('id_checkout')->first();
        if (!$t) {
            return $this->respond([
                'status' => 404,
                'success' => false,
                'type' => 'Error',
                'comment' => 'For Ssayomart Team : please add callback for curl request',
                'response' => 'No Order Found'

            ], 404);
        }
        if ($status == '2' || $status == '3' || $status == '5') {
            if (!$checkoutModel->save([
                'id_checkout' => $t['id_checkout'],
                'id_status_pesan' => $status
            ])) {
                return $this->respond([
                    'status' => 304,
                    'success' => false,
                    'type' => 'Error',
                    'comment' => 'For Ssayomart Team : please add callback for curl request',
                    'response' => 'Failed to update'
                ], 304);
            }
            return $this->getSingleOrderF($t, $status);
        }
        return $this->respond([
            'status' => 403,
            'success' => false,
            'type' => 'Error',
            'comment' => 'For Ssayomart Team : please add callback for curl request',
            'response' => 'Failed to update Because Status is ' . $status
        ], 403);
    }

    function getSingleOrderF($t = [], $status = null)
    {
        $checkoutProdModel = new CheckoutProdukModel();
        $tokoModel = new TokoModel();
        $alamatUserModel = new AlamatUserModel();
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
        foreach ($insuranceDetails as $detail) {
            $item .= $detail["product_description"] . ", ";
        }
        $item = rtrim($item, ", ");
        $item = rtrim($item, ", ");
        if ($status == 1) {
            $statusOrder = 'Pending';
        }
        if ($status == 2) {
            $statusOrder = 'Porcess';
        }
        if ($status == 3) {
            $statusOrder = 'Sending';
        }
        if ($status == 4) {
            $statusOrder = 'Finish';
        }
        if ($status == 5) {
            $statusOrder = 'Failed';
        }
        $body = [
            "paymentType" => 3,
            "shipment_method" => $t['service'],
            "routes" =>
            [[
                "originName" => 'Ssayomart ' . $origin['lable'],
                "originNote" => "Tunggu Di Lobby",
                "originContactName" => 'Ssayomart ' . $origin['lable'],
                "originContactPhone" => $this->formatTelp($origin['telp']),
                "originLatLong" => $origin['latitude'] . ',' . $origin['longitude'],
                "originAddress" => $origin['alamat_1'],
                "destinationName" => $destination['penerima'],
                "destinationNote" => "Tolong Hati-Hati",
                "destinationContactName" => $destination['alamat_2'],
                "destinationContactPhone" => $this->formatTelp($destination['telp']),
                "destinationLatLong" => $destination['latitude'] . ',' . $destination['longitude'],
                "destinationAddress" => $destination['alamat_1'],
                "item" => $item,
                "storeOrderId" => "Ssayomart" . $t['invoice'],
                "insuranceDetails" => $insuranceDetails
            ]]
        ];
        $response = [
            'status' => 200,
            'success' => true,
            'type' => 'Get Detail Order',
            'order_id' => $t['invoice'],
            "order_status" => $statusOrder,
            "order_time" => $t['created_at'],
            "order_status" => $statusOrder,
            "status_message" => "Success, order is found",
            "Market" => $origin['lable'],
            'routes' => $body,
            'response' => 'No response',
            'comment' => 'For Ssayomart Team : please add callback for curl request',

        ];
        return $this->respond($response, 200);
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

    public function index()
    {
        return $this->respond([
            'status' => 200,
            'success' => true,
            'response' => 'Index of webhook'
        ], 200);
    }
}
