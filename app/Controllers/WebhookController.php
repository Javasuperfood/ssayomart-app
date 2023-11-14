<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\AlamatUserModel;
use App\Models\CheckoutModel;
use App\Models\CheckoutProdukModel;
use App\Models\TokoModel;

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
            'message' => 'For Tim : please add callback for curl request',
            'bodypayload' => $body,
            'response' => 'No response'

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
}
