<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlamatUserModel;
use App\Models\CheckoutModel;
use App\Models\CheckoutProdukModel;
use App\Models\KategoriModel;
use App\Models\KuponModel;
use App\Models\ProdukModel;
use App\Models\TokoModel;
use App\Models\UsersModel;
use App\Models\WishlistModel;
use App\Models\WishlistProdukModel;
use Midtrans\Config as MidtransConfig;


class BuyController extends BaseController
{
    public function index($slug)
    {
        $kategori = new KategoriModel();
        $alamatModel = new AlamatUserModel();
        $kuponModel = new KuponModel();
        $produkModel = new ProdukModel();
        $tokoModel = new TokoModel();
        $userModel = new UsersModel();
        $id_varian = $this->request->getVar('varian');
        $qty = $this->request->getVar('qty');
        $produk = $produkModel->getProdukWithVarianBySlug($slug, $id_varian);
        // dd($produk);
        $totalAkhir = $produk['harga_item'] * $qty;
        $alamat_list = $alamatModel->where('id_user', user_id())->findAll();
        $kuponList = $kuponModel->where('available_kupon >', 0)->where('is_active', 1)->findAll();
        $beratTotal = $produk['berat'] * $qty;
        $data = [
            'title' => 'Buy ' . $produk['nama'],
            'alamat_list' => $alamat_list,
            'produk' => $produk,
            'qty' => $qty,
            'varian' => $id_varian,
            'total' => $totalAkhir,
            'kupon' => $kuponList,
            'kategori' => $kategori->findAll(),
            'market_list' => $tokoModel->findAll(),
            'marketSelected' => $userModel->find(user_id())['market_selected'],
            'market' => $tokoModel->find($userModel->find(user_id())['market_selected'])['id_city'],
            'beratTotal' => $beratTotal
        ];
        // dd($data);
        return view('user/home/checkout/buyProduk', $data);
    }
    public function storeData($slug)
    {
        // dd($this->request->getVar());
        $produkModel = new ProdukModel();
        $checkoutModel = new CheckoutModel();
        $checkoutProdukModel = new CheckoutProdukModel();
        $midtransConfig = config('Midtrans');
        $alamatUserModel = new AlamatUserModel();
        $userModel = new UsersModel();
        $wishlistModel = new WishlistModel();
        $wishlistProdModel = new WishlistProdukModel();

        // Set the Midtrans API credentials
        MidtransConfig::$serverKey = $midtransConfig->serverKey;
        MidtransConfig::$clientKey = $midtransConfig->clientKey;
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        MidtransConfig::$isProduction = $midtransConfig->isProduction;
        // Set sanitization on (default)
        MidtransConfig::$isSanitized = $midtransConfig->isSanitized;
        // Set 3DS transaction for credit card to true
        MidtransConfig::$is3ds = $midtransConfig->is3ds;


        $inv = 'INV-' . date('Ymd') . '-' . mt_rand(10, 99) . time();
        $id_varian = $this->request->getVar('varian');

        $email = $userModel->getEmail(user_id());
        $produk = $produkModel->getProdukWithVarianBySlug($slug, $id_varian);

        $wishlist = $wishlistModel->where('id_user', user_id())->first();
        $wishlistItem = $wishlistProdModel->where('id_wishlist', $wishlist['id_wishlist'])->where('id_produk', $produk['id_produk'])->first();
        $id_alamat = $this->request->getVar('alamat_list');
        $alamat = $alamatUserModel->find($id_alamat);
        $service = $this->request->getVar('service');
        $servicetext = $this->request->getVar('serviceText');
        $kode = $this->request->getVar('kupon');
        $qty =  intval($this->request->getVar('qty'));

        $total_1 = floatval($produk['harga_item']) * $qty;
        $total_2 = $total_1 + $service;
        $kupon = [
            'discount' => '',
            'kupon' => ''
        ];
        $cekProduk[] = [
            'id' => $produk['id_produk'],
            'price' => $produk['harga_item'],
            'quantity' => $qty,
            'name' => $produk['nama'] . '(' . $produk['value_item'] . ')',
        ];
        if ($kode != '') {
            $kuponModel = new KuponModel();
            $cekKupon = $kuponModel->getKupon($kode);
            $total_2 = floatval($total_1);
            $discount = floatval($cekKupon['discount']);
            $total_2 = $total_2 - ($total_2 * $discount);
            $getDiscount = floatval($total_1) - $total_2;
            $total_2 = $service + $total_2;
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
        $kirim = '<p><b>Nama</b> : ' . $alamat['penerima'] . '<br><b>Alamat</b> :<br>' . $alamat['alamat_1'] . ', ' . $alamat['city'] . ', '  . $alamat['province'] . '<br><b>Telp</b> :  ' . $alamat['telp'];


        $params = [
            'transaction_details' => [
                'order_id' => $inv,
                'gross_amount' => $total_2,
            ],
            'customer_details' => [
                'first_name' => $alamat['penerima'],
                'last_name' => '',
                'email' => $email,
                'phone' => $alamat['telp'],
                "billing_address" => [
                    "first_name" => $alamat['penerima'],
                    "last_name" => "",
                    "email" => $email,
                    "phone" => $alamat['telp'],
                    "address" => $alamat['alamat_1'],
                    "city" => $alamat['city'],
                    "postal_code" => $alamat['zip_code'],
                    "country_code" => "IDN"
                ],
                "shipping_address" => [
                    "first_name" => $alamat['penerima'],
                    "last_name" => "",
                    "email" => $email,
                    "phone" => $alamat['telp'],
                    "address" => $alamat['alamat_1'],
                    "city" => $alamat['city'],
                    "postal_code" => $alamat['zip_code'],
                    "country_code" => "IDN"
                ],
            ],
            "item_details" => $cekProduk,
        ];
        // dd($params);
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $dbStore = [
            'id_user' => user_id(),
            'id_toko' => $this->request->getVar('market'),
            'id_status_pesan' => 1,
            'id_status_kirim' => 1,
            'invoice' => $inv,
            'total_1' => $total_1,
            'total_2' => $total_2,
            'service' => $servicetext,
            'harga_service' => $service,
            'kurir' => strtoupper($this->request->getVar('kurir')),
            'kirim' => $kirim,
            'city' => $alamat['city'],
            'zip_code' => $alamat['zip_code'],
            'telp' => $alamat['telp'],
            'discount' => $kupon['discount'],
            'kupon' => $kupon['kupon'],
            'snap_token' => $snapToken
        ];
        $chechkoutId = $checkoutModel->insert($dbStore);

        $checkoutProdukData = [
            'id_checkout' => $chechkoutId,
            'id_produk' => $produk['id_produk'],
            'id_variasi_item' => $id_varian,
            'qty' => $qty,
            'harga' => $produk['harga_item'],
        ];
        $checkoutProdukModel->insert($checkoutProdukData);
        if ($wishlistItem) {
            $wishlistProdModel->delete($wishlistItem['id_wishlist_produk']);
        }
        return redirect()->to(base_url('payment/' . $inv));
    }
}
