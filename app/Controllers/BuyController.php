<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlamatUserModel;
use App\Models\CheckoutModel;
use App\Models\CheckoutProdukModel;
use App\Models\CheckoutResponseModel;
use App\Models\KategoriModel;
use App\Models\KuponModel;
use App\Models\ProdukModel;
use App\Models\PromoBatchModel;
use App\Models\TokoModel;
use App\Models\UsersModel;
use App\Models\WishlistModel;
use App\Models\WishlistProdukModel;
use App\Models\PromoModel;
use Midtrans\Config as MidtransConfig;


class BuyController extends BaseController
{
    private $key;
    public function __construct()
    {
        $this->key = "15139";;
    }



    public function index($slug)
    {
        $kategori = new KategoriModel();
        $alamatModel = new AlamatUserModel();
        $kuponModel = new KuponModel();
        $produkModel = new ProdukModel();
        $tokoModel = new TokoModel();
        $userModel = new UsersModel();
        $promoBatchModel = new PromoBatchModel();

        $id_varian = $this->request->getVar('varian');
        $qty = $this->request->getVar('qty');
        $produk = $produkModel->getProdukWithVarianBySlug($slug, $id_varian);
        // dd($produk);
        $totalAkhir = $produk['harga_item'] * $qty;
        $alamat_list = $alamatModel->where('id_user', user_id())->findAll();
        $kuponList = $kuponModel->where('available_kupon >', 0)->where('is_active', 1)->findAll();
        $beratTotal = $produk['berat'] * $qty;
        // dd($produk);

        $promoDetails = $promoBatchModel->getPromoDetailsByIdProduk($produk['id_produk']);
        if (count($promoDetails) > 0 && $qty >= $promoDetails[0]['min']) {
            $produk['promo'] = $promoDetails[0];
        }
        // dd($promoDetails);

        // if ($userModel->find(user_id())['market_selected']) {
        //     $market =  $tokoModel->find($userModel->find(user_id())['market_selected'])['id_city'];
        // } else {
        //     $market =  $tokoModel->first()['id_city'];
        // }
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
            'addressSelected' => $userModel->find(user_id())['address_selected'],
            // 'market' => $market,
            'beratTotal' => $beratTotal,
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
        $midtransConfig = new \Config\Midtrans();
        $alamatUserModel = new AlamatUserModel();
        $userModel = new UsersModel();
        $wishlistModel = new WishlistModel();
        $wishlistProdModel = new WishlistProdukModel();
        $promoBatchModel = new PromoBatchModel();
        // $kuponModel = new KuponModel();
        // $kuponList = $kuponModel->find($id);

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
        $discount = '';
        $wishlist = $wishlistModel->where('id_user', user_id())->first();
        $wishlistItem = $wishlistProdModel->where('id_wishlist', $wishlist['id_wishlist'])->where('id_produk', $produk['id_produk'])->first();
        $id_alamat = $this->request->getVar('alamatD');
        $alamat = $alamatUserModel->find($id_alamat);
        $service = $this->request->getVar('service');
        $service = $this->decryptValue($service, $this->key);
        if (!$service) {
            return redirect()->back();
        }
        $servicetext = $this->request->getVar('serviceText');
        $kurir = $this->request->getVar('kurir');
        $GoSend = null;
        if ($kurir == 'GoSend') {
            $GoSend = 1;
        }

        $kode = $this->request->getVar('kupon');
        $qty =  intval($this->request->getVar('qty'));

        $total_1 = floatval($produk['harga_item']) * $qty;
        $total_2 = $total_1 + $service;

        $promoDetails = $promoBatchModel->getPromoDetailsByIdProduk($produk['id_produk']);
        if (count($promoDetails) > 0 && $qty >= $promoDetails[0]['min']) {
            $produk['promo'] = $promoDetails[0];
            $diskonPromo = (float)($total_1 * ($promoDetails[0]['discount']));
            $total_2 = floatval($total_1);
            $total_2 = $total_2 - $diskonPromo;
            $total_2 = $service + $total_2;
            $cekProduk[] = [
                'id' => 'diskonPromo',
                'price' => -$diskonPromo,
                'quantity' => 1,
                'name' => 'Diskon Promo',
            ];
            $discount = $promoDetails[0]['discount'];
        }
        // dd($diskonPromo);
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
            $idKupon = $kuponModel->getKuponId($kode);
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
            $discount = $cekKupon['discount'];
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
            'id_destination' => $id_alamat,
            'id_status_pesan' => 1,
            'id_status_kirim' => 1,
            'invoice' => $inv,
            'total_1' => $total_1,
            'total_2' => $total_2,
            'service' => $servicetext,
            'harga_service' => $service,
            'gosend' => $GoSend,
            'kurir' => $kurir,
            'kirim' => $kirim,
            'city' => $alamat['city'],
            'zip_code' => $alamat['zip_code'],
            'telp' => $alamat['telp'],
            'discount' => $discount,
            'kupon' => $kupon['kupon'],
            'snap_token' => $snapToken
        ];
        // dd($dbStore);
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

        if (!empty($kode)) {
            $idKupon = $kuponModel->getKuponId($kode);
            if ($idKupon) {
                if ($kuponModel->useCoupon($idKupon)) {
                    return redirect()->to(base_url('payment/' . $inv))->with('success', 'Your order has been placed successfully.');
                }
            }
        }

        return redirect()->to(base_url('payment/' . $inv));
    }

    public function getNewPayment()
    {
        // dd($this->request->getVar());
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

        $checkoutModel = new CheckoutModel();
        $checkoutProdukModel = new CheckoutProdukModel();
        $userModel = new UsersModel();
        $produkModel = new ProdukModel();
        $email = $userModel->getEmail(user_id());
        $checkout = $checkoutModel->where('invoice', $this->request->getVar('invoice'))->first();
        $produk = $checkoutProdukModel->where('id_checkout', $checkout['id_checkout'])->findAll();
        foreach ($produk as $key => $value) {
            $item = $produkModel->getProdukWithVarianByID($value['id_produk'], $value['id_variasi_item']);
            $cekProduk[] = [
                'id' => $value['id_produk'],
                'price' => $value['harga'],
                'quantity' => $value['qty'],
                'name' => $item['nama'] . '(' . $item['value_item'] . ')',
            ];
        }
        $newInvoice = $this->generateNewInvoice($checkout['invoice']);
        $penerima = $this->getInfoPenerima($checkout['kirim']);
        $params = [
            'transaction_details' => [
                'order_id' => $newInvoice,
                'gross_amount' => $checkout['total_2'],
            ],
            'customer_details' => [
                'first_name' => $penerima['nama'],
                'last_name' => '',
                'email' => $email,
                'phone' => $checkout['telp'],
                "billing_address" => [
                    "first_name" => $penerima['nama'],
                    "last_name" => "",
                    "email" => $email,
                    "phone" => $penerima['telp'],
                    "address" => $penerima['alamat'],
                    "city" => $checkout['city'],
                    "postal_code" => $checkout['zip_code'],
                    "country_code" => "IDN"
                ],
                "shipping_address" => [
                    "first_name" => $penerima['nama'],
                    "last_name" => "",
                    "email" => $email,
                    "phone" => $penerima['telp'],
                    "address" => $penerima['alamat'],
                    "city" => $checkout['city'],
                    "postal_code" => $checkout['zip_code'],
                    "country_code" => "IDN"
                ],
            ],
            "item_details" => $cekProduk,
        ];
        // dd($params);
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $dbStore = [
            'id_user' => user_id(),
            'id_toko' => $checkout['id_toko'],
            'id_status_pesan' => 1,
            'id_status_kirim' => 1,
            'id_destination' => $checkout['id_destination'],
            'invoice' => $newInvoice,
            'total_1' => $checkout['total_1'],
            'total_2' => $checkout['total_2'],
            'service' => $checkout['service'],
            'gosend' => $checkout['gosend'],
            'harga_service' => $checkout['harga_service'],
            'kurir' => $checkout['kurir'],
            'kirim' => $checkout['kirim'],
            'city' => $checkout['city'],
            'zip_code' => $checkout['zip_code'],
            'telp' => $checkout['telp'],
            'discount' => $checkout['discount'],
            'kupon' => $checkout['kupon'],
            'snap_token' => $snapToken
        ];
        $chechkoutId = $checkoutModel->insert($dbStore);
        foreach ($produk as $key => $value) {
            $checkoutProdukData = [
                'id_checkout' => $chechkoutId,
                'id_produk' => $value['id_produk'],
                'id_variasi_item' => $value['id_variasi_item'],
                'qty' => $value['qty'],
                'harga' => $value['harga'],
            ];
            $checkoutProdukModel->insert($checkoutProdukData);
        }
        $checkoutModel->save([
            'id_checkout' => $checkout['id_checkout'],
            'id_status_pesan' => 5
        ]);
        return redirect()->to(base_url('payment/' . $newInvoice));
        $data = [
            'params' => $params,
            'dbStore' => $dbStore,
            'checkoutProdukData' => $checkoutProdukData,
            'checkout' => $checkout,
            'produk' => $produk
        ];
        // dd($data);
    }

    function generateNewInvoice($inv)
    {
        $string = $inv;
        $pieces = explode("-", $string);
        if (count($pieces) >= 3) {
            $result = $pieces[0] . "-" . $pieces[1];
            return $result . '-' . mt_rand(10, 99) . time();
        } else {
            echo "Tidak ada tanda - ke-2 dalam string.";
        }
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
                'nama' => $nama,
                'alamat' => $alamat,
                'telp' => $telp
            ];
        }
    }

    function encryptValue($value, $key)
    {
        $cipher = "aes-256-cbc";
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $encrypted = openssl_encrypt($value, $cipher, $key, 0, $iv);
        return base64_encode($iv . $encrypted);
    }
    function decryptValue($encryptedValue, $key)
    {
        $cipher = "aes-256-cbc";
        $ivlen = openssl_cipher_iv_length($cipher);
        $data = base64_decode($encryptedValue);
        $iv = substr($data, 0, $ivlen);
        $encrypted = substr($data, $ivlen);
        return openssl_decrypt($encrypted, $cipher, $key, 0, $iv);
    }


    // ========== TEST ===============

    public function index2($slug)
    {
        $kategori = new KategoriModel();
        $alamatModel = new AlamatUserModel();
        $kuponModel = new KuponModel();
        $produkModel = new ProdukModel();
        $tokoModel = new TokoModel();
        $userModel = new UsersModel();
        $promoBatchModel = new PromoBatchModel();

        $id_varian = $this->request->getVar('varian');
        $qty = $this->request->getVar('qty');
        $produk = $produkModel->getProdukWithVarianBySlug($slug, $id_varian);
        // dd($produk);
        $totalAkhir = $produk['harga_item'] * $qty;
        $alamat_list = $alamatModel->where('id_user', user_id())->findAll();
        $kuponList = $kuponModel->where('available_kupon >', 0)->where('is_active', 1)->findAll();
        $beratTotal = $produk['berat'] * $qty;

        $promoDetails = $promoBatchModel->getPromoDetailsByIdProduk($produk['id_produk']);
        if (count($promoDetails) > 0 && $qty >= $promoDetails[0]['min']) {
            $produk['promo'] = $promoDetails[0];
        }

        // if ($userModel->find(user_id())['market_selected']) {
        //     $market =  $tokoModel->find($userModel->find(user_id())['market_selected'])['id_city'];
        // } else {
        //     $market =  $tokoModel->first()['id_city'];
        // }
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
            'addressSelected' => $userModel->find(user_id())['address_selected'],
            // 'market' => $market,
            'beratTotal' => $beratTotal,
        ];
        // dd($data);
        return view('user/home/checkout/buyProduk2', $data);
    }
    public function storeData2($slug)
    {
        // dd($this->request->getVar());
        $metode_pemabayaran = $this->request->getVar('paymentType');

        if (!$metode_pemabayaran) {
            return redirect()->back();
        }
        $produkModel = new ProdukModel();
        $checkoutModel = new CheckoutModel();
        $checkoutProdukModel = new CheckoutProdukModel();
        $midtransConfig = new \Config\Midtrans();
        $alamatUserModel = new AlamatUserModel();
        $userModel = new UsersModel();
        $wishlistModel = new WishlistModel();
        $wishlistProdModel = new WishlistProdukModel();
        $checkoutResponseModel = new CheckoutResponseModel();

        // $kuponModel = new KuponModel();
        // $kuponList = $kuponModel->find($id);

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
        $id_alamat = $this->request->getVar('alamatD');
        $alamat = $alamatUserModel->find($id_alamat);
        $service = $this->request->getVar('service');
        $service = $this->decryptValue($service, $this->key);
        if (!$service) {
            return redirect()->back();
        }
        $servicetext = $this->request->getVar('serviceText');
        $kurir = $this->request->getVar('kurir');
        $GoSend = null;
        if ($kurir == 'GoSend') {
            $GoSend = 1;
        }

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
            $idKupon = $kuponModel->getKuponId($kode);
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
        switch ($metode_pemabayaran) {
            case 'cc':
                $params['payment_type'] = "credit_card";
                $params["credit_card"] = [
                    "token_id" => "<token_id from Get Card Token Step>",
                    "authentication" => true,
                ];
                break;

            case 'bca_va':
                $params['payment_type'] = "bank_transfer";
                $params["bank_transfer"] = [
                    "bank" => "bca"
                ];
                break;

            case 'mandiri_va':
                $params['payment_type'] = "echannel";
                $params["echannel"] = [
                    "bill_info1" => "Payment:",
                    "bill_info2" => "Online purchase"
                ];
                break;
            case 'bni_va':
                $params['payment_type'] = "bank_transfer";
                $params["bank_transfer"] = [
                    "bank" => "bni"
                ];
                break;
            case 'permata_va':
                $params['payment_type'] = "permata";
                break;
            case 'bri_va':
                $params['payment_type'] = "bank_transfer";
                $params["bank_transfer"] = [
                    "bank" => "bri"
                ];
                break;
            case 'gopay_online':
                $params['payment_type'] = "gopay";
                $params["gopay"] = [
                    "enable_callback" => true,
                    "callback_url" => base_url() . 'status?order_id=' . $inv
                ];
                break;
            case 'qris_online':
                $params['payment_type'] = "qris";
                $params["qris"] = [
                    "acquirer" => "gopay"
                ];
                break;
            case 'shopeepay':
                $params['payment_type'] = "shopeepay";
                $params["shopeepay"] =  [
                    "callback_url" => base_url() . 'status?order_id=' . $inv
                ];
                break;

            default:
                // Jika tidak ada kecocokan dengan nilai yang diharapkan
                // Lakukan sesuatu, misalnya kirim pesan error atau nilai default lainnya.
                break;
        }

        // dd($params);
        // return response()->setJSON($params);
        $response = [];
        $snapToken = null;
        if ($params['payment_type'] == 'bank_transfer' || $params['payment_type'] == 'echannel' || $params['payment_type'] == 'permata') {
            $carger = \Midtrans\CoreApi::charge($params);
            // return response()->setJSON($carger);
            if ($carger->status_code != 201) {
                return redirect()->back();
            }
            $response = [
                'request' => $params,
                'response' => $carger
            ];
        } else {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            $response = [
                'request' => $params,
                'response' => [
                    'snap_token' => $snapToken
                ]
            ];
            // return response()->setJSON($snapToken);
        }

        $dbStore = [
            'id_user' => user_id(),
            'id_toko' => $this->request->getVar('market'),
            'id_destination' => $id_alamat,
            'id_status_pesan' => 1,
            'id_status_kirim' => 1,
            'invoice' => $inv,
            'total_1' => $total_1,
            'total_2' => $total_2,
            'service' => $servicetext,
            'harga_service' => $service,
            'gosend' => $GoSend,
            'kurir' => $kurir,
            'kirim' => $kirim,
            'city' => $alamat['city'],
            'zip_code' => $alamat['zip_code'],
            'telp' => $alamat['telp'],
            'discount' => $kupon['discount'],
            'kupon' => $kupon['kupon'],
            'snap_token' => $snapToken,
        ];
        // dd($dbStore);
        $chechkoutId = $checkoutModel->insert($dbStore);

        $checkoutProdukData = [
            'id_checkout' => $chechkoutId,
            'id_produk' => $produk['id_produk'],
            'id_variasi_item' => $id_varian,
            'qty' => $qty,
            'harga' => $produk['harga_item'],
        ];
        $checkoutProdukModel->insert($checkoutProdukData);
        $checkoutResponseModel->insert([
            'id_checkout' => $chechkoutId,
            'response' => json_encode($response),
        ]);
        if ($wishlistItem) {
            $wishlistProdModel->delete($wishlistItem['id_wishlist_produk']);
        }

        if (!empty($kode)) {
            $idKupon = $kuponModel->getKuponId($kode);
            if ($idKupon) {
                if ($kuponModel->useCoupon($idKupon)) {
                    return redirect()->to(base_url('payment/' . $inv))->with('success', 'Your order has been placed successfully.');
                }
            }
        }

        return redirect()->to(base_url('pay?order_id=' . $inv . '&payment_type=' . $params['payment_type']));
    }

    public function pay()
    {
        $inv = $this->request->getGet('order_id');
        $payment_type = $this->request->getGet('payment_type');
        if (!$inv || !$payment_type) {
            return view('404', [
                'title' => '404'
            ]);
        }
        if ($payment_type == 'qris' || $payment_type == 'shopeepay' || $payment_type == 'gopay') {
            return redirect()->to(base_url('payment/' . $inv . '?payment_type=' . $payment_type));
        }
        $checkoutModel = new CheckoutModel();
        $checkoutResponseModel = new CheckoutResponseModel();
        $kategoriModel = new KategoriModel();
        $alamatUserModel = new AlamatUserModel();
        $tokoModel = new TokoModel();

        $order = $checkoutModel->where('invoice', $inv)->first();


        $paymentResponse = $checkoutResponseModel->where('id_checkout', $order['id_checkout'])->first();
        $paymentResponse['response'] = json_decode($paymentResponse['response'], true);

        $data = [
            'title' => 'Payment',
            'kategori' => $kategoriModel->findAll(),
            'origin' => $tokoModel->find($order['id_toko']),
            'order' => $order,
            'destination' => $alamatUserModel->where('id_alamat_users', $order['id_destination'])->first(),
            'penerima' => $this->getInfoPenerima($order['kirim']),
            'pay' => $paymentResponse['response']
        ];
        // dd($data);
        if ($payment_type == 'bank_transfer' || $payment_type == 'echannel') {
            return $this->bank_transfer($data);
        }
        return response()->setJSON($data);
    }

    function bank_transfer($data = [])
    {
        $data['title'] = 'Payment Bank';
        $midtransConfig = new \Config\Midtrans();
        MidtransConfig::$serverKey = $midtransConfig->serverKey;
        MidtransConfig::$clientKey = $midtransConfig->clientKey;
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        MidtransConfig::$isProduction = $midtransConfig->isProduction;
        // Set sanitization on (default)
        MidtransConfig::$isSanitized = $midtransConfig->isSanitized;
        // Set 3DS transaction for credit card to true
        MidtransConfig::$is3ds = $midtransConfig->is3ds;
        $checkoutModel = new CheckoutModel();

        $statusPesan = $data['order']['id_status_pesan'];
        $id_cehckout = $data['order']['id_checkout'];
        // dd($data);
        try {
            // dd($id_cehckout);
            /**
             * @var object $paymentStatus
             */
            $paymentStatus = \Midtrans\Transaction::status($data['pay']['response']['order_id']);
            if ($paymentStatus->transaction_status == "settlement" && $statusPesan == '1') {
                $checkoutModel->save([
                    'id_checkout' => $id_cehckout,
                    'id_status_pesan' => 2
                ]);
            } else if ($paymentStatus->transaction_status == 'pending') {
                // TODO set payment status in merchant's database to 'Pending'
                $checkoutModel->save([
                    'id_checkout' => $id_cehckout,
                    'id_status_pesan' => 1
                ]);
            } else if ($paymentStatus->transaction_status == 'deny') {
                // TODO set payment status in merchant's database to 'Denied'
                $checkoutModel->save([
                    'id_checkout' => $id_cehckout,
                    'id_status_pesan' => 5
                ]);
            } else if ($paymentStatus->transaction_status == 'expire') {
                // TODO set payment status in merchant's database to 'expire'
                $checkoutModel->save([
                    'id_checkout' => $id_cehckout,
                    'id_status_pesan' => 5
                ]);
            } else if ($paymentStatus->transaction_status == 'cancel') {
                // TODO set payment status in merchant's database to 'Denied'
                $checkoutModel->save([
                    'id_checkout' => $id_cehckout,
                    'id_status_pesan' => 5
                ]);
            }

            $data['paymentStatus'] = $paymentStatus;
            $data['pay']['status'] = $paymentStatus;
            if ($data['pay']['response']['payment_type'] == 'bank_transfer') {
                $data['bank_transfer'] = [
                    'bank' => $data['pay']['response']['va_numbers'][0]['bank'],
                    'company_code' => null,
                    'account_number' => $data['pay']['response']['va_numbers'][0]['va_number']
                ];
            }
            if ($data['pay']['response']['payment_type'] == 'echannel') {
                $data['bank_transfer'] = [
                    'bank' => 'Mandiri',
                    'company_code' => $data['pay']['response']['biller_code'],
                    'account_number' => $data['pay']['response']['bill_key']
                ];
            }
            // dd($data);
            if ($paymentStatus->transaction_status == "settlement" && $statusPesan != '1') {
                return redirect()->to(base_url('status?order_id=' . $paymentStatus->order_id));
            }
            return view('user/home/payment/virtualAccount', $data);
        } catch (\Exception $e) {
            // echo "An error occurred: " . $e->getMessage();
            $currentTimestamp = time(); // Get the current timestamp
            $twentyFourHoursAgo = $currentTimestamp - (24 * 60 * 60);
            $lastUpdateTimestamp = strtotime($data['order']['updated_at']);
            if ($lastUpdateTimestamp <= $twentyFourHoursAgo && $statusPesan == '1') {
                $checkoutModel->save([
                    'id_checkout' => $id_cehckout,
                    'id_status_pesan' => 5
                ]);
            }
            return dd($e);
        }
        // $data['pay']['status'] = $paymentStatus;
        // return redirect()->to(base_url('status?order_id=' . $paymentStatus->order_id));
    }

    function eMoney()
    {
        // TODO implement midtrans emoney
    }

    function credit_card()
    {
        // TODO implement midtrans credit card
    }
}
