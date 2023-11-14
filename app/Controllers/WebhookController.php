<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CheckoutModel;
use App\Models\CheckoutProdukModel;

class WebhookController extends BaseController
{
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
}
