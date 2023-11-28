<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\AlamatUserModel;
use App\Models\CartModel;
use App\Models\CartProdukModel;
use App\Models\CheckoutModel;
use App\Models\CheckoutProdukModel;
use App\Models\KuponModel;
use App\Models\ProdukModel;
use App\Models\TokoModel;
use App\Models\UsersModel;
use Midtrans\Config as MidtransConfig;
use OneSignal\OneSignal;


class CheckoutController extends BaseController
{
    private $key;
    private $APP_ID = '1191e933-e52c-466f-946f-e8cab83009d7';
    private $APP_KEY_TOKEN = 'OTM4N2YxMGYtNjM5NS00ZGZiLWEyNGYtZmNjNGM5ODNiNDVi';
    private $USER_KEY_TOKEN = 'NmNkYTljMGQtY2UwYS00NjQzLTgyMjItYzUyNjYyYzljMzE5';

    public function __construct()
    {
        $this->key = '15139';
    }
    public function storeData()
    {
        $cartModel = new CartModel();

        $cartProdModel = new CartProdukModel();
        $cekCart = $cartModel->where(['id_user' => user_id()])->first();
        $cekCartProduk = $cartProdModel
            ->select('*, jsf_variasi_item.harga_item')
            ->join('jsf_produk', 'jsf_produk.id_produk = jsf_cart_produk.id_produk', 'inner')
            ->join('jsf_variasi_item', 'jsf_variasi_item.id_variasi_item = jsf_cart_produk.id_variasi_item', 'inner')
            ->where('id_cart', $cekCart['id_cart'])
            ->findAll();

        $totalAkhir = 0;

        foreach ($cekCartProduk as $produk) {
            $rowTotal = $produk['qty'] * $produk['harga_item'];
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
        // dd($cekCartProduk);
        $chechkoutId = $checkoutModel->insert($dbStore);

        foreach ($cekCartProduk as $item) {
            $checkoutItemData = [
                'id_checkout' => $chechkoutId,
                'id_produk' => $item['id_produk'],
                'id_variasi_item' => $item['id_variasi_item'],
                'qty' => $item['qty'],
                'harga' => $item['harga_item'],
            ];
            $checkoutProdukModel->insert($checkoutItemData);
            $cartProdModel->delete($item['id_cart_produk']); //delete from cart
        }
        return redirect()->to(base_url() . 'checkout/' . $chechkoutId);
    }
    // public function checkout($id)
    // {
    //     $kategori = new KategoriModel();
    //     $checkoutModel = new CheckoutModel();
    //     $alamatModel = new AlamatUserModel();
    //     $kuponModel = new KuponModel();

    //     $cekUser = $checkoutModel->where('id_checkout', $id)->first();

    //     if ($cekUser['id_user'] != user_id()) {
    //         return redirect()->to(base_url());
    //     }
    //     if ($cekUser['snap_token'] != null) {
    //         if ($cekUser['id_status_pesan'] == 1) {
    //             return redirect()->to(base_url('payment/' . $cekUser['invoice']));
    //         }
    //         return redirect()->to(base_url('payment/' . $cekUser['invoice']));
    //     }
    //     if ($cekUser['id_status_pesan'] != 1) {
    //         return redirect()->to(base_url('status?order_id=' . $cekUser['invoice']));
    //     }
    //     $checkoutProdModel = new CheckoutProdukModel();
    //     $cekProduk = $checkoutProdModel
    //         ->select('*')
    //         ->join('jsf_produk', 'jsf_produk.id_produk = jsf_checkout_produk.id_produk', 'inner')
    //         ->join('jsf_variasi_item', 'jsf_variasi_item.id_variasi_item = jsf_checkout_produk.id_variasi_item', 'inner')
    //         ->where('id_checkout', $id)
    //         ->findAll();

    //     $totalAkhir = 0;

    //     foreach ($cekProduk as $produk) {
    //         $rowTotal = $produk['qty'] * $produk['harga_item'];
    //         $totalAkhir += $rowTotal;
    //     }
    //     $alamat_list = $alamatModel->where('id_user', user_id())->findAll();

    //     $kuponList = $kuponModel->where('available_kupon >', 0)->where('is_active', 1)->findAll();

    //     $data = [
    //         'title' => 'Checkout',
    //         'alamat_list' => $alamat_list,
    //         'produk' => $cekProduk,
    //         'id' => $id,
    //         'total' => $totalAkhir,
    //         'kupon' => $kuponList,
    //         'kategori' => $kategori->findAll()
    //     ];
    //     // dd($data);

    //     return view('user/home/checkout/checkout', $data);
    // }

    public function bayar($id)
    {
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
        $alamatUserModel = new AlamatUserModel();
        $checkoutModel = new CheckoutModel();
        $checkoutProdModel = new CheckoutProdukModel();
        $userModel = new UsersModel();
        $email = $userModel->getEmail(user_id());
        $checkout = $checkoutModel->where('id_checkout', $id)->first();

        $cekProduk = $checkoutProdModel
            ->select('jsf_produk.id_produk as id, jsf_variasi_item.harga_item as price, jsf_checkout_produk.qty as quantity, jsf_produk.nama as name, jsf_variasi_item.value_item')
            ->join('jsf_produk', 'jsf_produk.id_produk = jsf_checkout_produk.id_produk', 'inner')
            ->join('jsf_variasi_item', 'jsf_variasi_item.id_variasi_item = jsf_checkout_produk.id_variasi_item', 'inner')
            ->where('id_checkout', $id)
            ->findAll();

        foreach ($cekProduk as $key => $c) {
            $cekProduk[$key] = [
                'id' => $c['id'],
                'price' => $c['price'],
                'quantity' => $c['quantity'],
                'name' => $c['name'] . '(' . $c['value_item'] . ')',
            ];
        }

        $service = $this->request->getVar('service');
        $servicetext = $this->request->getVar('serviceText');
        $kode = $this->request->getVar('kupon');
        $total_1 = $checkout['total_1'];
        $total_2 = $total_1 + $service;
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

        $inv = $checkoutModel->find($id);
        $id_alamat = $this->request->getVar('alamat_list');
        $alamat = $alamatUserModel->find($id_alamat);
        $kirim = '<p><b>Nama</b> : ' . $alamat['penerima'] . '<br><b>Alamat</b> :<br>' . $alamat['alamat_1'] . ', ' . $alamat['city'] . ', '  . $alamat['province'] . '<br><b>Telp</b> :  ' . $alamat['telp'];


        $params = [
            'transaction_details' => [
                'order_id' => $checkout['invoice'],
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

        $data = [
            'id_checkout' => $id,
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
        // return dd($data);
        if (!$checkoutModel->save($data)) {
            return redirect()->to(base_url('checkout/' . $id))->with('failed', 'Tarnsaksi Gagal');
        }
        return redirect()->to(base_url('payment/' . $inv['invoice']));
        // dd($data);
    }

    public function checkoutCart()
    {
        $kuponModel = new KuponModel();
        $alamatModel = new AlamatUserModel();
        $kategoriModel = new KategoriModel();
        $cartProdukModel = new CartProdukModel();
        $userModel = new UsersModel();
        $tokoModel = new TokoModel();
        $checkedId = $this->request->getVar('check');
        if (!$checkedId) {
            return redirect()->to(base_url('cart2'));
        }

        $alamat_list = $alamatModel->where('id_user', user_id())->findAll();

        $kuponList = $kuponModel->where('available_kupon >', 0)->where('is_active', 1)->findAll();
        // if ($userModel->find(user_id())['market_selected']) {
        //     $market =  $tokoModel->find($userModel->find(user_id())['market_selected'])['id_city'];
        // } else {
        //     $market =  $tokoModel->first()['id_city'];
        // }
        $data = [
            'title' => 'Checkout',
            'alamat_list' => $alamat_list,
            'kupon' => $kuponList,
            'kategori' => $kategoriModel->findAll(),
            'market_list' => $tokoModel->findAll(),
            'marketSelected' => $userModel->find(user_id())['market_selected'],
            'addressSelected' => $userModel->find(user_id())['address_selected'],
            'back' => 'cart'
            // 'market' => $market,
        ];

        foreach ($checkedId as $key => $id) {
            $data['produk'][$key] = $cartProdukModel->select('*, jsf_variasi_item.harga_item')
                ->join('jsf_produk', 'jsf_produk.id_produk = jsf_cart_produk.id_produk', 'inner')
                ->join('jsf_variasi_item', 'jsf_variasi_item.id_variasi_item = jsf_cart_produk.id_variasi_item', 'inner')
                ->find($id);
            $data['cart_id'][$key] = $id;
        }
        $totalAkhir = 0;
        $beratTotal = 0;
        foreach ($data['produk'] as $produk) {
            $rowTotal = $produk['qty'] * $produk['harga_item'];
            $totalAkhir += $rowTotal;
            $rowBerat = $produk['berat'] * $produk['qty'];
            $beratTotal += $rowBerat;
        }
        $data['total'] = $totalAkhir;
        $data['beratTotal'] = $beratTotal;
        // dd($data);
        return view('user/home/checkout/checkout2', $data);
    }

    public function checkoutCartBayar()
    {
        $checkedId = $this->request->getVar('produkCart');
        if (!$checkedId) {
            return redirect()->to(base_url('cart2'));
        }

        $midtransConfig = config('Midtrans');

        // Set the Midtrans API credentials
        MidtransConfig::$serverKey = $midtransConfig->serverKey;
        MidtransConfig::$clientKey = $midtransConfig->clientKey;
        MidtransConfig::$isProduction = $midtransConfig->isProduction;
        MidtransConfig::$isSanitized = $midtransConfig->isSanitized;
        MidtransConfig::$is3ds = $midtransConfig->is3ds;

        $checkoutModel = new CheckoutModel();
        $checkoutProdukModel = new CheckoutProdukModel();
        $cartProdukModel = new CartProdukModel();
        $alamatUserModel = new AlamatUserModel();
        $userModel = new UsersModel();

        $email = $userModel->getEmail(user_id());
        $serviceText = $this->request->getVar('serviceText');
        $service = $this->request->getVar('service');
        $service = $this->decryptValue($service, $this->key);
        $kurir = $this->request->getVar('kurir');
        $GoSend = null;
        if ($kurir == 'GoSend') {
            $GoSend = 1;
        }
        $kode = $this->request->getVar('kupon');
        $alamatId = $this->request->getVar('alamatD');
        $inv = 'INV-' . date('Ymd') . '-' . mt_rand(10, 99) . time();

        $alamat = $alamatUserModel->find($alamatId);
        $kirim = '<p><b>Nama</b> : ' . $alamat['penerima'] . '<br><b>Alamat</b> :<br>' . $alamat['alamat_1'] . ', ' . $alamat['city'] . ', '  . $alamat['province'] . '<br><b>Telp</b> :  ' . $alamat['telp'];

        foreach ($checkedId as $key => $id) {
            $data['produk'][$key] = $cartProdukModel->select('*, jsf_variasi_item.harga_item')
                ->join('jsf_produk', 'jsf_produk.id_produk = jsf_cart_produk.id_produk', 'inner')
                ->join('jsf_variasi_item', 'jsf_variasi_item.id_variasi_item = jsf_cart_produk.id_variasi_item', 'inner')
                ->find($id);
            $data['cart_id'][$key] = $id;
        }
        $totalAkhir = 0;
        $beratTotal = 0;
        foreach ($data['produk'] as $key => $produk) {
            $rowTotal = $produk['qty'] * $produk['harga_item'];
            $totalAkhir += $rowTotal;
            $rowBerat = $produk['qty'] * $produk['berat'];
            $beratTotal += $rowBerat;
            $cekProduk[$key] = [
                'id' => $produk['id_produk'],
                'price' => $produk['harga_item'],
                'quantity' => $produk['qty'],
                'name' => $produk['nama'] . '(' . $produk['value_item'] . ')',
            ];
        }
        $data['total'] = $totalAkhir;
        $data['beratTotal'] = $totalAkhir;

        $kupon = [
            'discount' => '',
            'kupon' => ''
        ];


        $total_2 = floatval($data['total']);
        $total_2 = $service + $total_2;

        if ($kode != '') {
            $kuponModel = new KuponModel();
            $cekKupon = $kuponModel->getKupon($kode);
            $total_2 = floatval($data['total']);
            $discount = floatval($cekKupon['discount']);
            $total_2 = $total_2 - ($total_2 * $discount);
            $getDiscount = floatval($data['total']) - $total_2;
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
            'name' => $serviceText,
        ];
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
            'id_destination' => $alamatId,
            'kupon' => '',
            'id_status_pesan' => 1,
            'id_status_kirim' => 1,
            'invoice' => $inv,
            'total_1' => $totalAkhir,
            'total_2' => $total_2,
            'service' => $serviceText,
            'harga_service' => $service,
            'gosend' => $GoSend,
            'kurir' => $kurir,
            'kirim' => $kirim,
            'city' => $alamat['city'],
            'zip_code' => $alamat['zip_code'],
            'telp' => $alamat['telp'],
            'discount' => $kupon['discount'],
            'kupon' => $kupon['kupon'],
            'snap_token' => $snapToken
        ];
        // dd($dbStore);
        $chechkoutId = $checkoutModel->insert($dbStore);

        foreach ($data['produk'] as $item) {
            $checkoutItemData = [
                'id_checkout' => $chechkoutId,
                'id_produk' => $item['id_produk'],
                'id_variasi_item' => $item['id_variasi_item'],
                'qty' => $item['qty'],
                'harga' => $item['harga_item'],
            ];
            $checkoutProdukModel->insert($checkoutItemData);
            $cartProdukModel->delete($item['id_cart_produk']); //delete from cart
        }

        return redirect()->to(base_url('payment/' . $inv));
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
            if ($cekUser['id_status_pesan'] == 1) {
                return redirect()->to(base_url('payment/' . $cekUser['invoice']));
            }
            return redirect()->to(base_url('payment/' . $cekUser['invoice']));
        }

        if ($cekUser['id_status_pesan'] != 1) {
            return redirect()->to(base_url('status?order_id=' . $cekUser['invoice']));
        }

        $checkoutProdModel = new CheckoutProdukModel();
        $cekProduk = $checkoutProdModel
            ->select('*')
            ->join('jsf_produk', 'jsf_produk.id_produk = jsf_checkout_produk.id_produk', 'inner')
            ->join('jsf_variasi_item', 'jsf_variasi_item.id_variasi_item = jsf_checkout_produk.id_variasi_item', 'inner')
            ->where('id_checkout', $id)
            ->findAll();

        $totalAkhir = 0;

        foreach ($cekProduk as $produk) {
            $rowTotal = $produk['qty'] * $produk['harga_item'];
            $totalAkhir += $rowTotal;
        }

        $alamat_list = $alamatModel->where('id_user', user_id())->findAll();
        $kuponList = $kuponModel->where('available_kupon >', 0)->where('is_active', 1)->findAll();

        $data = [
            'title' => 'Checkout',
            'alamat_list' => $alamat_list,
            'produk' => $cekProduk,
            'id' => $id,
            'total' => $totalAkhir,
            'kupon' => $kuponList,
            'kategori' => $kategori->findAll()
        ];

        // Kirim notifikasi setelah checkout berhasil
        $userId = user_id(); // Sesuaikan dengan metode pengambilan user ID Anda
        $message = 'Pembayaran Anda telah berhasil. Terima kasih atas pembeliannya!';
        $this->sendNotification($userId, $message);

        // Redirect ke halaman pembayaran
        return redirect()->to(base_url('payment/' . $id));
    }
    // Fungsi untuk mengirim notifikasi menggunakan OneSignal
    private function sendNotification($userId, $message)
    {
        // Ambil device token pengguna dari database (sesuaikan dengan struktur tabel Anda)
        $userModel = new UsersModel();
        $deviceToken = $userModel->getDeviceToken($userId); // Sesuaikan dengan metode yang sesuai

        // Konfigurasi OneSignal
        $config = [
            'app_id' => $this->APP_ID,
            'rest_api_key' => $this->APP_KEY_TOKEN,
            'user_auth_key' => $this->USER_KEY_TOKEN,
        ];

        // Inisialisasi OneSignal
        $oneSignal = new OneSignal($config);

        // Kirim notifikasi
        $oneSignal->sendNotificationToUser(
            $message,
            $deviceToken,
            $url = null,
            $data = null,
            $buttons = null,
            $schedule = null
        );
    }
}
