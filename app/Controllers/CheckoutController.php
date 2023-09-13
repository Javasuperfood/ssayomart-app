<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\AlamatUserModel;
use App\Models\CartModel;
use App\Models\CartProdukModel;
use App\Models\CheckoutModel;
use App\Models\CheckoutProdukModel;
use App\Models\KuponModel;
use Midtrans\Config as MidtransConfig;

class CheckoutController extends BaseController
{
    public function storeData()
    {
        $cartModel = new CartModel();

        $cartProdModel = new CartProdukModel();
        $cekCart = $cartModel->where(['id_user' => user_id()])->first();

        $cekCartProduk = $cartProdModel
            ->select('*')
            ->join('jsf_produk', 'jsf_produk.id_produk = jsf_cart_produk.id_produk', 'inner')
            ->where('id_cart', $cekCart['id_cart'])
            ->findAll();

        $totalAkhir = 0;

        foreach ($cekCartProduk as $produk) {
            $rowTotal = $produk['qty'] * $produk['harga'];
            $totalAkhir += $rowTotal;
        }

        $checkoutModel = new CheckoutModel();
        $checkoutProdukModel = new CheckoutProdukModel();
        $userId = user_id();
        $dbStore = [
            'id_user' => $userId,
            'kupon' => '',
            'id_status_pesan' => 1,
            'id_status_kirim' => 1,
            'invoice' => 'INV-' . date('Ymd') . '-' . mt_rand(10, 99) . time(),
            'total_1' => $totalAkhir,
            'total_2' => $totalAkhir,
        ];
        $chechkoutId = $checkoutModel->insert($dbStore);

        foreach ($cekCartProduk as $item) {
            $checkoutItemData = [
                'id_checkout' => $chechkoutId,
                'id_produk' => $item['id_produk'],
                'qty' => $item['qty'],
                'harga' => $item['harga'],
            ];
            $checkoutProdukModel->insert($checkoutItemData);
            $cartProdModel->delete($item['id_cart_produk']); //delete from cart
        }
        return redirect()->to(base_url() . 'checkout/' . $chechkoutId);
    }
    public function checkout($id)
    {
        $kategori = new KategoriModel();
        $checkoutModel = new CheckoutModel();
        $alamatModel = new AlamatUserModel();
        $kuponModel = new KuponModel();

        $cekUser = $checkoutModel->where('id_checkout', $id)->first();

        if ($cekUser['id_user'] != user_id()) {
            return redirect()->to(base_url());
        }
        if ($cekUser['snap_token'] != null) {
            return redirect()->to(base_url('bayar/' . $cekUser['invoice']));
        }
        if ($cekUser['id_status_pesan'] != 1) {
            return redirect()->to(base_url('status/' . $cekUser['invoice']));
        }
        $checkoutProdModel = new CheckoutProdukModel();
        $cekProduk = $checkoutProdModel
            ->select('*')
            ->join('jsf_produk', 'jsf_produk.id_produk = jsf_checkout_produk.id_produk', 'inner')
            ->where('id_checkout', $id)
            ->findAll();


        $totalAkhir = 0;

        foreach ($cekProduk as $produk) {
            $rowTotal = $produk['qty'] * $produk['harga'];
            $totalAkhir += $rowTotal;
        }
        $alamat_list = $alamatModel->where('id_user', user_id())->findAll();

        $kuponList = $kuponModel->findAll();

        $data = [
            'title' => 'Checkout',
            'alamat_list' => $alamat_list,
            'produk' => $cekProduk,
            'id' => $id,
            'total' => $totalAkhir,
            'kupon' => $kuponList,
            'kategori' => $kategori->findAll()
        ];
        // dd($data);

        return view('user/home/checkout/checkout', $data);
    }
    public function bayar($id)
    {
        // dd($this->request->getVar());
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

        $checkoutProdModel = new CheckoutProdukModel();
        $checkoutModel = new CheckoutModel();
        $checkout = $checkoutModel->where('id_checkout', $id)->first();

        $cekProduk = $checkoutProdModel
            ->select('jsf_produk.id_produk as id, jsf_produk.harga as price, jsf_checkout_produk.qty as quantity, jsf_produk.nama as name')
            ->join('jsf_produk', 'jsf_produk.id_produk = jsf_checkout_produk.id_produk', 'inner')
            ->where('id_checkout', $id)
            ->findAll();


        $biayaAplikasi = 1000;
        $service = $this->request->getVar('service');
        $servicetext = $this->request->getVar('serviceText');
        $kode = $this->request->getVar('kupon');
        $total_1 = $checkout['total_1'];
        $total_2 = $total_1;
        $kupon = [
            'discount' => '',
            'kupon' => ''
        ];

        if ($kode != '') {
            $kuponModel = new KuponModel();
            $cekKupon = $kuponModel->getKupon($kode);
            $total_2 = floatval($total_1);
            $discount = floatval($cekKupon['discount']);
            $total_2 = $total_2 - ($total_2 * $discount);
            $getDiscount = floatval($total_1) - $total_2;
            $total_2 = $service + $total_2 + $biayaAplikasi;
            $kupon = [
                'discount' => $cekKupon['discount'],
                'kupon' => $cekKupon['kode']
            ];
            $cekProduk[] = [
                'id' => 'Diskon',
                'price' => -$getDiscount,
                'quantity' => 1,
                'name' => 'Diskon',
            ];
        }
        $cekProduk[] = [
            'id' => 'Service',
            'price' => $service,
            'quantity' => 1,
            'name' => $servicetext,
        ];
        $cekProduk[] = [
            'id' => 'Biaya Apliaksi',
            'price' => $biayaAplikasi,
            'quantity' => 1,
            'name' => 'Biaya Admin',
        ];
        $alamatUserModel = new AlamatUserModel();
        $checkoutModel = new CheckoutModel();

        $inv = $checkoutModel->find($id);
        $id_alamat = $this->request->getVar('alamat_list');
        $alamat = $alamatUserModel->find($id_alamat);
        $kirim = 'Penerima : ' . $alamat['penerima'] . '<br>' . $alamat['alamat_1'] . ', ' . $alamat['city'] . ', '  . $alamat['province'] . '<br>' . $alamat['zip_code'] . '<br>' . 'Telp : ' . $alamat['telp'];



        $params = [
            'transaction_details' => [
                'order_id' => $checkout['invoice'],
                'gross_amount' => $total_2,
            ],
            "payment_amounts" => [
                [
                    "amount" =>  $total_2,
                ]
            ],
            'customer_details' => [
                'first_name' => $alamat['penerima'],
                'last_name' => '',
                'email' => 'budi.pra@example.com',
                'phone' => $alamat['telp'],
            ],
            "billing_address" => [
                "first_name" => $alamat['penerima'],
                "last_name" => "",
                "email" => "budisusanto@example.com",
                "phone" => $alamat['telp'],
                "address" =>  $alamat['alamat_1'],
                "city" => $alamat['city'],
                "postal_code" => $alamat['zip_code'],
                "country_code" => "IDN"
            ],
            "shipping_address" => [
                "first_name" => $alamat['penerima'],
                "last_name" => "",
                "email" => "budisusanto@example.com",
                "phone" => $alamat['telp'],
                "address" =>   $alamat['alamat_1'],
                "city" => $alamat['city'],
                "postal_code" => $alamat['zip_code'],
                "country_code" => "IDN"
            ],
            "item_details" => $cekProduk,
        ];
        // dd($params);
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $data = [
            'id_checkout' => $id,
            'total_1' => $total_1,
            'total_2' => $total_2,
            'service' => $service,
            'harga_service' => $servicetext,
            'kurir' => strtoupper($this->request->getVar('kurir')),
            'kirim' => $kirim,
            'city' => $alamat['city'],
            'zip_code' => $alamat['zip_code'],
            'telp' => $alamat['telp'],
            'discount' => $kupon['discount'],
            'kupon' => $kupon['kupon'],
            'snap_token' => $snapToken
        ];
        // return dd($data);
        if (!$checkoutModel->save($data)) {
            return redirect()->to(base_url('checkout/' . $id))->with('failed', 'Tarnsaksi Gagal');
        }
        return redirect()->to(base_url('bayar/' . $inv['invoice']));
        // dd($data);
    }
    public function bayarINV($inv)
    {
        $midtransConfig = config('Midtrans');
        $clientKey =  $midtransConfig->clientKey;
        $checkoutModel = new CheckoutModel();
        $cek = $checkoutModel->where('invoice', $inv)->first();
        $data = [
            'title' => 'Bayar',
            'item' => $cek,
            'key' => $clientKey,
            'back' => 'history'
        ];
        // dd($data);
        return view('user/home/checkout/midtrans', $data);
    }
    public function ajaxBayar()
    {
        //
    }
}
