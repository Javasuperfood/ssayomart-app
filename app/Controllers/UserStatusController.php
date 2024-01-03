<?php

namespace App\Controllers;

use App\Models\CheckoutModel;
use App\Models\StatusPesanModel;
use App\Models\UsersModel;
use App\Models\KategoriModel;
use Midtrans\Config as MidtransConfig;
use App\Models\PromoBatchModel;


class UserStatusController extends BaseController
{
    public function status()
    {

        $midtransConfig = new \Config\Midtrans();

        // Set the Midtrans API credentials
        MidtransConfig::$serverKey = $midtransConfig->serverKey;
        MidtransConfig::$clientKey = $midtransConfig->clientKey;
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        MidtransConfig::$isProduction = $midtransConfig->isProduction;
        // Set sanitization on (default)
        MidtransConfig::$isSanitized = $midtransConfig->isSanitized;
        // Set 3DS transaction for credit card to true
        MidtransConfig::$is3ds = $midtransConfig->is3ds;
        $statusModel = new StatusPesanModel();
        $userModel = new UsersModel();
        $checkoutModel = new CheckoutModel();
        $kategori = new KategoriModel();
        $promoBatchModel = new PromoBatchModel();
        $order_id = $this->request->getGet('order_id');
        $status_code = $this->request->getGet('status_code');
        $transaction_status = $this->request->getGet('transaction_status');
        $userSatus = $userModel->getStatus($order_id);
        $status_transaction = false;
        $id_status_pesan = $this->request->getVar('id_status_pesan');
        if ($userSatus->gosend == 1 && $userSatus->id_status_pesan != '1') {
            $gosendStatus = $this->getStatusGosend($order_id);
            if ($gosendStatus) {
                return redirect()->to(base_url('status/ordering/?order_id=' . $order_id . '&status_code=' . $status_code . '&transaction_status=' . $transaction_status));
            }
        }
        $status = $statusModel->findAll();
        $cekProduk = $userModel->getTransaksi($order_id);

        foreach ($cekProduk as $key => $product) {
            $promoDetails = $promoBatchModel->getPromoDetailsByIdProduk($product->id_produk);
            if (count($promoDetails) > 0 && $product->qty >= $promoDetails[0]['min']) {
                $cekProduk[$key]->promo = $promoDetails[0];
            }
        }

        $data = [
            'inv' => $order_id,
            'title'                     => 'Status Pesanan',
            'getstatus'                 => $status,
            'id_status_pesan' => $id_status_pesan,
            'status_transaction' => $status_transaction,
            'status' => $userSatus,
            'produk' => $cekProduk,
            'key' => $midtransConfig->clientKey,
            'urlMidtrans' => $midtransConfig->urlMidtrans,
            'order_id' => $order_id,
            'kategori' => $kategori->findAll(),
            'back' => 'history'

        ];
        // dd($data);
        // ==================================================================
        if ($userSatus->id_status_pesan != '1') {
            try {
                /**
                 * @var object $paymentStatus
                 */
                $paymentStatus = \Midtrans\Transaction::status($order_id);
                if ($paymentStatus->transaction_status == "settlement" && $userSatus->id_status_pesan == '1') {
                    $checkoutModel->save([
                        'id_checkout' => $userSatus->id_checkout,
                        'id_status_pesan' => 2
                    ]);
                }
                $data['paymentStatus'] = $paymentStatus;
            } catch (\Exception $e) {
                // echo "An error occurred: " . $e->getMessage();
            }
        }
        // ===============================================================

        // dd($data);
        return view('user/produk/status', $data);
    }

    public function updateStatus($id)
    {
        $checkoutModel = new CheckoutModel();
        $statusModel = new StatusPesanModel();
        $status = $statusModel->findAll();
        $id_checkout = $checkoutModel->where('invoice', $id)->first()['id_checkout'];
        $status_transaction = true;
        $id_status_pesan = $this->request->getVar('id_status_pesan');

        $data = [
            'id_checkout' => $id_checkout,
            'status_transaction' => 1,
            'id_status_pesan' => 4,
        ];
        // dd($data);

        if ($checkoutModel->update($id_checkout, $data)) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Berhasil mengupdate status'
            ];
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Gagal',
                'message' => 'Gagal mengupdate status'
            ];
        }

        session()->setFlashdata('alert', $alert);
        return redirect()->to(base_url('status/?order_id=' . $id))->withInput();
    }

    function getStatusGosend($id)
    {
        $webhookConfig = new \Config\WebHook();
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
