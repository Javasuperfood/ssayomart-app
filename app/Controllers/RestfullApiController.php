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
        $order = [];
        foreach ($transaction as $key => $t) {
            $order[$key] = [
                'order_id' => $t['invoice'],
                'telp' => $t['telp'],
                'status_payment' => ($t['id_status_pesan'] >= 2) ? 'Paid' : 'Unpaid',
                'Shipment_method' => $t['service'],
                'snap_token' => $t['snap_token'],
            ];
            $produk = $checkoutProdModel->getAllProdukByIdCheckout($t['id_checkout']);
            if ($t['id_status_pesan'] == 1) {
                $order[$key]['status'] = 'Pending';
            }
            if ($t['id_status_pesan'] == 2) {
                $order[$key]['status'] = 'Porcess';
            }
            if ($t['id_status_pesan'] == 3) {
                $order[$key]['status'] = 'Sending';
            }
            if ($t['id_status_pesan'] == 4) {
                $order[$key]['status'] = 'Finish';
            }
            if ($t['id_status_pesan'] == 5) {
                $order[$key]['status'] = 'Failed';
            }

            $origin = $tokoModel->find($t['id_toko']);
            $order[$key]['origin'] = [
                'name' => $origin['lable'],
                'address' => $origin['alamat_1'],
                'address_2' => $origin['alamat_2'],
                'city' => $origin['city'],
                'province' => $origin['province'],
                'zip_code' => $origin['zip_code'],
                'telp' => $origin['telp'],
                'telp_2' => $origin['telp2'],
                'latitude' => $origin['latitude'],
                'longitude' => $origin['longitude'],
            ];

            if ($t['id_destination']) {
                $destination = $alamatUserModel->find($t['id_destination']);
                $order[$key]['destination'] = [
                    'name' => $destination['penerima'],
                    'address' => $destination['alamat_1'],
                    'address_2' => $destination['alamat_2'],
                    'address_3' => $destination['alamat_3'],
                    'city' => $destination['city'],
                    'province' => $destination['province'],
                    'zip_code' => $destination['zip_code'],
                    'telp' => $destination['telp'],
                    'telp_2' => $destination['telp2'],
                    'latitude' => $destination['latitude'],
                    'longitude' => $destination['longitude'],
                ];
            } else {
                $order[$key]['destination'] = $this->getInfoPenerima($t['kirim']);
            }
            foreach ($produk as $p) {
                $order[$key]['item'][] = [
                    'product_id' => $p['id_produk'],
                    'name' => $p['nama'] . ' (' . $p['value_item'] . ')',
                    'qty' => $p['qty'],
                    'price' => $p['harga'],
                ];
            }
        }
        $response = [
            'status' => 200,
            'success' => 'Transaction',
            'response' => $order
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
        $order = [];
        foreach ($transaction as $key => $t) {
            $order[$key] = [
                'order_id' => $t['invoice'],
                'telp' => $t['telp'],
                'status_payment' => ($t['id_status_pesan'] >= 2) ? 'Paid' : 'Unpaid',
                'Shipment_method' => $t['service'],
                'snap_token' => $t['snap_token'],
            ];
            $produk = $checkoutProdModel->getAllProdukByIdCheckout($t['id_checkout']);
            $origin = $tokoModel->find($t['id_toko']);
            $order[$key]['origin'] = [
                'name' => $origin['lable'],
                'address' => $origin['alamat_1'],
                'address_2' => $origin['alamat_2'],
                'city' => $origin['city'],
                'province' => $origin['province'],
                'zip_code' => $origin['zip_code'],
                'telp' => $origin['telp'],
                'telp_2' => $origin['telp2'],
                'latitude' => $origin['latitude'],
                'longitude' => $origin['longitude'],
            ];
            if ($t['id_destination']) {
                $destination = $alamatUserModel->find($t['id_destination']);
                $order[$key]['destination'] = [
                    'name' => $destination['penerima'],
                    'address' => $destination['alamat_1'],
                    'address_2' => $destination['alamat_2'],
                    'address_3' => $destination['alamat_3'],
                    'city' => $destination['city'],
                    'province' => $destination['province'],
                    'zip_code' => $destination['zip_code'],
                    'telp' => $destination['telp'],
                    'telp_2' => $destination['telp2'],
                    'latitude' => $destination['latitude'],
                    'longitude' => $destination['longitude'],
                ];
            } else {
                $order[$key]['destination'] = [];
            }
            foreach ($produk as $p) {
                $order[$key]['item'][] = [
                    'product_id' => $p['id_produk'],
                    'name' => $p['nama'] . ' (' . $p['value_item'] . ')',
                    'qty' => $p['qty'],
                    'price' => $p['harga'],
                ];
            }
        }
        $response = [
            'status' => 200,
            'success' => 'Transaction',
            'response' => $order
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
        // foreach ($transaction as $key => $t) {
        //     $produk = $checkoutProdModel->where('id_checkout', $t['id_checkout'])->findAll();
        //     $transaction[$key]['origin'] = $tokoModel->find($t['id_toko']);
        //     if ($t['id_destination']) {
        //         $transaction[$key]['destination'] = $alamatUserModel->find($t['id_destination']);
        //     } else {
        //         $transaction[$key]['destination'] = [];
        //     }
        //     $transaction[$key]['produk'] = $produk;
        // }
        $order = [];
        foreach ($transaction as $key => $t) {
            $order[$key] = [
                'order_id' => $t['invoice'],
                'telp' => $t['telp'],
                'status_payment' => ($t['id_status_pesan'] >= 2) ? 'Paid' : 'Unpaid',
                'Shipment_method' => $t['service'],
                'snap_token' => $t['snap_token'],
            ];
            $produk = $checkoutProdModel->getAllProdukByIdCheckout($t['id_checkout']);
            $origin = $tokoModel->find($t['id_toko']);
            $order[$key]['origin'] = [
                'name' => $origin['lable'],
                'address' => $origin['alamat_1'],
                'address_2' => $origin['alamat_2'],
                'city' => $origin['city'],
                'province' => $origin['province'],
                'zip_code' => $origin['zip_code'],
                'telp' => $origin['telp'],
                'telp_2' => $origin['telp2'],
                'latitude' => $origin['latitude'],
                'longitude' => $origin['longitude'],
            ];
            if ($t['id_destination']) {
                $destination = $alamatUserModel->find($t['id_destination']);
                $order[$key]['destination'] = [
                    'name' => $destination['penerima'],
                    'address' => $destination['alamat_1'],
                    'address_2' => $destination['alamat_2'],
                    'address_3' => $destination['alamat_3'],
                    'city' => $destination['city'],
                    'province' => $destination['province'],
                    'zip_code' => $destination['zip_code'],
                    'telp' => $destination['telp'],
                    'telp_2' => $destination['telp2'],
                    'latitude' => $destination['latitude'],
                    'longitude' => $destination['longitude'],
                ];
            } else {
                $order[$key]['destination'] = [];
            }
            foreach ($produk as $p) {
                $order[$key]['item'][] = [
                    'product_id' => $p['id_produk'],
                    'name' => $p['nama'] . ' (' . $p['value_item'] . ')',
                    'qty' => $p['qty'],
                    'price' => $p['harga'],
                ];
            }
        }
        $response = [
            'status' => 200,
            'success' => 'Transaction',
            'response' => $order
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
            'success' => 'Transaction ' . $transaction['invoice'],
            'update' => $data,
            'response' => $transaction
        ];
        return $this->respond($response, 200);
    }

    public function transactionWp()
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $tokoModel = new TokoModel();
        $alamatUserModel = new AlamatUserModel();
        $transaction = $checkoutModel->where('id_status_pesan', 1)->findAll();
        $order = [];
        foreach ($transaction as $key => $t) {
            $order[$key] = [
                'order_id' => $t['invoice'],
                'telp' => $t['telp'],
                'status_payment' => ($t['id_status_pesan'] >= 2) ? 'Paid' : 'Unpaid',
                'Shipment_method' => $t['service'],
                'snap_token' => $t['snap_token'],
            ];
            $produk = $checkoutProdModel->getAllProdukByIdCheckout($t['id_checkout']);
            if ($t['id_status_pesan'] == 1) {
                $order[$key]['status'] = 'Pending';
            }
            if ($t['id_status_pesan'] == 2) {
                $order[$key]['status'] = 'Porcess';
            }
            if ($t['id_status_pesan'] == 3) {
                $order[$key]['status'] = 'Sending';
            }
            if ($t['id_status_pesan'] == 4) {
                $order[$key]['status'] = 'Finish';
            }
            if ($t['id_status_pesan'] == 5) {
                $order[$key]['status'] = 'Failed';
            }

            $origin = $tokoModel->find($t['id_toko']);
            $order[$key]['origin'] = [
                'name' => $origin['lable'],
                'address' => $origin['alamat_1'],
                'address_2' => $origin['alamat_2'],
                'city' => $origin['city'],
                'province' => $origin['province'],
                'zip_code' => $origin['zip_code'],
                'telp' => $origin['telp'],
                'telp_2' => $origin['telp2'],
                'latitude' => $origin['latitude'],
                'longitude' => $origin['longitude'],
            ];

            if ($t['id_destination']) {
                $destination = $alamatUserModel->find($t['id_destination']);
                $order[$key]['destination'] = [
                    'name' => $destination['penerima'],
                    'address' => $destination['alamat_1'],
                    'address_2' => $destination['alamat_2'],
                    'address_3' => $destination['alamat_3'],
                    'city' => $destination['city'],
                    'province' => $destination['province'],
                    'zip_code' => $destination['zip_code'],
                    'telp' => $destination['telp'],
                    'telp_2' => $destination['telp2'],
                    'latitude' => $destination['latitude'],
                    'longitude' => $destination['longitude'],
                ];
            } else {
                $order[$key]['destination'] = $this->getInfoPenerima($t['kirim']);
            }
            foreach ($produk as $p) {
                $order[$key]['item'][] = [
                    'product_id' => $p['id_produk'],
                    'name' => $p['nama'] . ' (' . $p['value_item'] . ')',
                    'qty' => $p['qty'],
                    'price' => $p['harga'],
                ];
            }
        }
        $response = [
            'status' => 200,
            'success' => 'Transaction Waiting Process',
            'response' => $order
        ];
        return $this->respond($response, 200);
    }
    public function transactionIp()
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $tokoModel = new TokoModel();
        $alamatUserModel = new AlamatUserModel();
        $transaction = $checkoutModel->where('id_status_pesan', 2)->findAll();
        $order = [];
        foreach ($transaction as $key => $t) {
            $order[$key] = [
                'order_id' => $t['invoice'],
                'telp' => $t['telp'],
                'status_payment' => ($t['id_status_pesan'] >= 2) ? 'Paid' : 'Unpaid',
                'Shipment_method' => $t['service'],
                'snap_token' => $t['snap_token'],
            ];
            $produk = $checkoutProdModel->getAllProdukByIdCheckout($t['id_checkout']);
            if ($t['id_status_pesan'] == 1) {
                $order[$key]['status'] = 'Pending';
            }
            if ($t['id_status_pesan'] == 2) {
                $order[$key]['status'] = 'Porcess';
            }
            if ($t['id_status_pesan'] == 3) {
                $order[$key]['status'] = 'Sending';
            }
            if ($t['id_status_pesan'] == 4) {
                $order[$key]['status'] = 'Finish';
            }
            if ($t['id_status_pesan'] == 5) {
                $order[$key]['status'] = 'Failed';
            }

            $origin = $tokoModel->find($t['id_toko']);
            $order[$key]['origin'] = [
                'name' => $origin['lable'],
                'address' => $origin['alamat_1'],
                'address_2' => $origin['alamat_2'],
                'city' => $origin['city'],
                'province' => $origin['province'],
                'zip_code' => $origin['zip_code'],
                'telp' => $origin['telp'],
                'telp_2' => $origin['telp2'],
                'latitude' => $origin['latitude'],
                'longitude' => $origin['longitude'],
            ];

            if ($t['id_destination']) {
                $destination = $alamatUserModel->find($t['id_destination']);
                $order[$key]['destination'] = [
                    'name' => $destination['penerima'],
                    'address' => $destination['alamat_1'],
                    'address_2' => $destination['alamat_2'],
                    'address_3' => $destination['alamat_3'],
                    'city' => $destination['city'],
                    'province' => $destination['province'],
                    'zip_code' => $destination['zip_code'],
                    'telp' => $destination['telp'],
                    'telp_2' => $destination['telp2'],
                    'latitude' => $destination['latitude'],
                    'longitude' => $destination['longitude'],
                ];
            } else {
                $order[$key]['destination'] = $this->getInfoPenerima($t['kirim']);
            }
            foreach ($produk as $p) {
                $order[$key]['item'][] = [
                    'product_id' => $p['id_produk'],
                    'name' => $p['nama'] . ' (' . $p['value_item'] . ')',
                    'qty' => $p['qty'],
                    'price' => $p['harga'],
                ];
            }
        }
        $response = [
            'status' => 200,
            'success' => 'Transaction In Process',
            'response' => $order
        ];
        return $this->respond($response, 200);
    }
    public function transactionDd()
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $tokoModel = new TokoModel();
        $alamatUserModel = new AlamatUserModel();
        $transaction = $checkoutModel->where('id_status_pesan', 3)->findAll();
        $order = [];
        foreach ($transaction as $key => $t) {
            $order[$key] = [
                'order_id' => $t['invoice'],
                'telp' => $t['telp'],
                'status_payment' => ($t['id_status_pesan'] >= 2) ? 'Paid' : 'Unpaid',
                'Shipment_method' => $t['service'],
                'snap_token' => $t['snap_token'],
            ];
            $produk = $checkoutProdModel->getAllProdukByIdCheckout($t['id_checkout']);
            if ($t['id_status_pesan'] == 1) {
                $order[$key]['status'] = 'Pending';
            }
            if ($t['id_status_pesan'] == 2) {
                $order[$key]['status'] = 'Porcess';
            }
            if ($t['id_status_pesan'] == 3) {
                $order[$key]['status'] = 'Sending';
            }
            if ($t['id_status_pesan'] == 4) {
                $order[$key]['status'] = 'Finish';
            }
            if ($t['id_status_pesan'] == 5) {
                $order[$key]['status'] = 'Failed';
            }

            $origin = $tokoModel->find($t['id_toko']);
            $order[$key]['origin'] = [
                'name' => $origin['lable'],
                'address' => $origin['alamat_1'],
                'address_2' => $origin['alamat_2'],
                'city' => $origin['city'],
                'province' => $origin['province'],
                'zip_code' => $origin['zip_code'],
                'telp' => $origin['telp'],
                'telp_2' => $origin['telp2'],
                'latitude' => $origin['latitude'],
                'longitude' => $origin['longitude'],
            ];

            if ($t['id_destination']) {
                $destination = $alamatUserModel->find($t['id_destination']);
                $order[$key]['destination'] = [
                    'name' => $destination['penerima'],
                    'address' => $destination['alamat_1'],
                    'address_2' => $destination['alamat_2'],
                    'address_3' => $destination['alamat_3'],
                    'city' => $destination['city'],
                    'province' => $destination['province'],
                    'zip_code' => $destination['zip_code'],
                    'telp' => $destination['telp'],
                    'telp_2' => $destination['telp2'],
                    'latitude' => $destination['latitude'],
                    'longitude' => $destination['longitude'],
                ];
            } else {
                $order[$key]['destination'] = $this->getInfoPenerima($t['kirim']);
            }
            foreach ($produk as $p) {
                $order[$key]['item'][] = [
                    'product_id' => $p['id_produk'],
                    'name' => $p['nama'] . ' (' . $p['value_item'] . ')',
                    'qty' => $p['qty'],
                    'price' => $p['harga'],
                ];
            }
        }
        $response = [
            'status' => 200,
            'success' => 'Transaction Sending',
            'response' => $order
        ];
        return $this->respond($response, 200);
    }
    public function transactionFh()
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $tokoModel = new TokoModel();
        $alamatUserModel = new AlamatUserModel();
        $transaction = $checkoutModel->where('id_status_pesan', 4)->findAll();
        $order = [];
        foreach ($transaction as $key => $t) {
            $order[$key] = [
                'order_id' => $t['invoice'],
                'telp' => $t['telp'],
                'status_payment' => ($t['id_status_pesan'] >= 2) ? 'Paid' : 'Unpaid',
                'Shipment_method' => $t['service'],
                'snap_token' => $t['snap_token'],
            ];
            $produk = $checkoutProdModel->getAllProdukByIdCheckout($t['id_checkout']);
            if ($t['id_status_pesan'] == 1) {
                $order[$key]['status'] = 'Pending';
            }
            if ($t['id_status_pesan'] == 2) {
                $order[$key]['status'] = 'Porcess';
            }
            if ($t['id_status_pesan'] == 3) {
                $order[$key]['status'] = 'Sending';
            }
            if ($t['id_status_pesan'] == 4) {
                $order[$key]['status'] = 'Finish';
            }
            if ($t['id_status_pesan'] == 5) {
                $order[$key]['status'] = 'Failed';
            }

            $origin = $tokoModel->find($t['id_toko']);
            $order[$key]['origin'] = [
                'name' => $origin['lable'],
                'address' => $origin['alamat_1'],
                'address_2' => $origin['alamat_2'],
                'city' => $origin['city'],
                'province' => $origin['province'],
                'zip_code' => $origin['zip_code'],
                'telp' => $origin['telp'],
                'telp_2' => $origin['telp2'],
                'latitude' => $origin['latitude'],
                'longitude' => $origin['longitude'],
            ];

            if ($t['id_destination']) {
                $destination = $alamatUserModel->find($t['id_destination']);
                $order[$key]['destination'] = [
                    'name' => $destination['penerima'],
                    'address' => $destination['alamat_1'],
                    'address_2' => $destination['alamat_2'],
                    'address_3' => $destination['alamat_3'],
                    'city' => $destination['city'],
                    'province' => $destination['province'],
                    'zip_code' => $destination['zip_code'],
                    'telp' => $destination['telp'],
                    'telp_2' => $destination['telp2'],
                    'latitude' => $destination['latitude'],
                    'longitude' => $destination['longitude'],
                ];
            } else {
                $order[$key]['destination'] = $this->getInfoPenerima($t['kirim']);
            }
            foreach ($produk as $p) {
                $order[$key]['item'][] = [
                    'product_id' => $p['id_produk'],
                    'name' => $p['nama'] . ' (' . $p['value_item'] . ')',
                    'qty' => $p['qty'],
                    'price' => $p['harga'],
                ];
            }
        }
        $response = [
            'status' => 200,
            'success' => 'Transaction Finished',
            'response' => $order
        ];
        return $this->respond($response, 200);
    }
    public function transactionFail()
    {
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $tokoModel = new TokoModel();
        $alamatUserModel = new AlamatUserModel();
        $transaction = $checkoutModel->where('id_status_pesan', 5)->orderBy('id_checkout')->findAll();
        $order = [];
        foreach ($transaction as $key => $t) {
            $order[$key] = [
                'order_id' => $t['invoice'],
                'telp' => $t['telp'],
                'status_payment' => ($t['id_status_pesan'] >= 2) ? 'Paid' : 'Unpaid',
                'Shipment_method' => $t['service'],
                'snap_token' => $t['snap_token'],
            ];
            $produk = $checkoutProdModel->getAllProdukByIdCheckout($t['id_checkout']);
            if ($t['id_status_pesan'] == 1) {
                $order[$key]['status'] = 'Pending';
            }
            if ($t['id_status_pesan'] == 2) {
                $order[$key]['status'] = 'Porcess';
            }
            if ($t['id_status_pesan'] == 3) {
                $order[$key]['status'] = 'Sending';
            }
            if ($t['id_status_pesan'] == 4) {
                $order[$key]['status'] = 'Finish';
            }
            if ($t['id_status_pesan'] == 5) {
                $order[$key]['status'] = 'Failed';
            }

            $origin = $tokoModel->find($t['id_toko']);
            $order[$key]['origin'] = [
                'name' => $origin['lable'],
                'address' => $origin['alamat_1'],
                'address_2' => $origin['alamat_2'],
                'city' => $origin['city'],
                'province' => $origin['province'],
                'zip_code' => $origin['zip_code'],
                'telp' => $origin['telp'],
                'telp_2' => $origin['telp2'],
                'latitude' => $origin['latitude'],
                'longitude' => $origin['longitude'],
            ];

            if ($t['id_destination']) {
                $destination = $alamatUserModel->find($t['id_destination']);
                $order[$key]['destination'] = [
                    'name' => $destination['penerima'],
                    'address' => $destination['alamat_1'],
                    'address_2' => $destination['alamat_2'],
                    'address_3' => $destination['alamat_3'],
                    'city' => $destination['city'],
                    'province' => $destination['province'],
                    'zip_code' => $destination['zip_code'],
                    'telp' => $destination['telp'],
                    'telp_2' => $destination['telp2'],
                    'latitude' => $destination['latitude'],
                    'longitude' => $destination['longitude'],
                ];
            } else {
                $order[$key]['destination'] = $this->getInfoPenerima($t['kirim']);
            }
            foreach ($produk as $p) {
                $order[$key]['item'][] = [
                    'product_id' => $p['id_produk'],
                    'name' => $p['nama'] . ' (' . $p['value_item'] . ')',
                    'qty' => $p['qty'],
                    'price' => $p['harga'],
                ];
            }
        }
        $response = [
            'status' => 200,
            'success' => 'Transaction Failed',
            'response' => $order
        ];
        return $this->respond($response, 200);
    }
    function getInfoPenerima($txt)
    {
        $text = $txt;

        $pattern = '/<b>Nama<\/b> : (.*?)<br><b>Alamat<\/b> :<br>(.*?)<br><b>Telp<\/b> :  (\d+)/';

        preg_match_all($pattern, $text, $matches1, PREG_SET_ORDER);

        if (!empty($matches1)) {
            $nama = $matches1[0][1];
            $alamat = $matches1[0][2];
            $telp = $matches1[0][3];

            return [
                'name' => $nama,
                'address' => $alamat,
                'telp' => $telp
            ];
        }
    }
}
