<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\AlamatUserModel;
use App\Models\CheckoutModel;
use App\Models\CheckoutProdukModel;
use App\Models\TokoModel;
use App\Models\UsersModel;

class RestfullApiController extends BaseController
{
    use ResponseTrait;
    public function index()
    {

        $response = [
            'status' => 200,
            'success' => 'Home',
            'messages' => 'Home Route'
        ];
        return $this->respond($response, 200);
    }
    public function user($id)
    {

        $userModel = new UsersModel();
        $alamatUserModel = new AlamatUserModel();
        $marketModel = new TokoModel();

        $user = $userModel->find($id);
        if (!$user) {
            $response = [
                'status' => 404,
                'success' => 'User not found',
                'response' => $user
            ];
            return $this->respond($response, 404);
        }
        $market = $marketModel->where('id_toko', $user['market_selected'])->first();
        $destination = $alamatUserModel->where('id_alamat_users', $user['address_selected'])->first();
        $alamat = $alamatUserModel->where('id_user', $id)->findAll();
        $response = [
            'status' => 200,
            'success' => 'User',
            'response' => [
                'user' => $user,
                'origin_selected' => $market,
                'destination_selected' => $destination,
                'address_list' => $alamat,

            ]
        ];
        return $this->respond($response, 200);
    }

    public function originList()
    {
        $tokoModel = new TokoModel();
        $origin = $tokoModel->findAll();
        $response = [
            'status' => 200,
            'success' => 'Origin List',
            'response' => $origin
        ];
        return $this->respond($response, 200);
    }
    public function origin($id)
    {
        $tokoModel = new TokoModel();
        $origin = $tokoModel->find($id);
        if (!$origin) {
            $response = [
                'status' => 404,
                'success' => 'Origin not found',
                'response' => $origin
            ];
            return $this->respond($response, 404);
        }
        $response = [
            'status' => 200,
            'success' => $origin['lable'],
            'response' => $origin
        ];
        return $this->respond($response, 200);
    }
    public function transaction()
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $tokoModel = new TokoModel();
        $alamatUserModel = new AlamatUserModel();
        $transaction = $checkoutModel->findAll();
        foreach ($transaction as $key => $t) {
            $produk = $checkoutProdModel->where('id_checkout', $t['id_checkout'])->findAll();
            if ($t['gosend'] == 1) {
                $transaction[$key]['origin'] = $tokoModel->find($t['id_toko']);
                if ($t['id_destination']) {
                    $transaction[$key]['destination'] = $alamatUserModel->find($t['id_destination']);
                } else {
                    $transaction[$key]['destination'] = [];
                }
            }
            $transaction[$key]['produk'] = $produk;
        }
        $response = [
            'status' => 200,
            'success' => 'Transaction',
            'response' => $transaction
        ];
        return $this->respond($response, 200);
    }
    public function transactionGoSend()
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $tokoModel = new TokoModel();
        $alamatUserModel = new AlamatUserModel();
        $transaction = $checkoutModel->where('gosend', 1)->orderBy('id_checkout')->findAll();
        foreach ($transaction as $key => $t) {
            $produk = $checkoutProdModel->where('id_checkout', $t['id_checkout'])->findAll();
            $transaction[$key]['origin'] = $tokoModel->find($t['id_toko']);
            if ($t['id_destination']) {
                $transaction[$key]['destination'] = $alamatUserModel->find($t['id_destination']);
            } else {
                $transaction[$key]['destination'] = [];
            }
            $transaction[$key]['produk'] = $produk;
        }
        $response = [
            'status' => 200,
            'success' => 'Transaction',
            'response' => $transaction
        ];
        return $this->respond($response, 200);
    }
    public function transactionGoSendId($id)
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $tokoModel = new TokoModel();
        $alamatUserModel = new AlamatUserModel();
        $transaction = $checkoutModel->where('gosend', 1)->like('id_checkout', $id)->orLike('invoice', $id)->orderBy('id_checkout')->findAll();
        foreach ($transaction as $key => $t) {
            $produk = $checkoutProdModel->where('id_checkout', $t['id_checkout'])->findAll();
            $transaction[$key]['origin'] = $tokoModel->find($t['id_toko']);
            if ($t['id_destination']) {
                $transaction[$key]['destination'] = $alamatUserModel->find($t['id_destination']);
            } else {
                $transaction[$key]['destination'] = [];
            }
            $transaction[$key]['produk'] = $produk;
        }
        $response = [
            'status' => 200,
            'success' => 'Transaction',
            'response' => $transaction
        ];
        return $this->respond($response, 200);
    }
    public function updateStatus($id)
    {
        $checkoutModel = new CheckoutModel();
        $transaction = $checkoutModel->like('id_checkout', $id)->orLike('invoice', $id)->first();

        $update = $this->request->getVar('update');
        if ($update == 'pickup' || $update == 'send') {
            $id = 3;
        } elseif ($update == 'cancel') {
            $id = 5;
        } else {
            $id = 2;
        }
        $data = [
            'id_checkout' => $transaction['id_checkout'],
            'id_status_pesan' => $id
        ];
        $checkoutModel->save($data);
        $transaction = $checkoutModel->like('id_checkout', $id)->orLike('invoice', $id)->first();
        $response = [
            'status' => 200,
            'success' => 'Transaction',
            'update' => $data,
            'response' => $transaction
        ];
        return $this->respond($response, 200);
    }
}
