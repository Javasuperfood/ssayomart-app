<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlamatUserModel;
use App\Models\CartModel;
use App\Models\CartProdukModel;
use App\Models\CheckoutModel;
use App\Models\CheckoutProdukModel;
use App\Models\CheckoutResponseModel;
use App\Models\KategoriModel;
use App\Models\KuponModel;
use App\Models\ProdukModel;
use App\Models\PromoProduk;
use App\Models\TokoModel;
use App\Models\UsersModel;
use App\Models\VariasiItemModel;
use Midtrans\Config as MidtransConfig;


class TransactionCoreUIController extends BaseController
{
    protected $key;

    public function __construct()
    {
        $this->key = '15139';
    }
    public function checkout()
    {
        /**
         * Checkout function for processing the checkout process.
         * *
         * Paramenter untuk checkout Beli Langsung : base_url('checkout2?slug={SLUG}&varian={ID_VARIASI_ITEM}&qty={QTY}')
         * 
         * Parameter untul checkout Cart : base_url('checkout2?cart=true&check%5B%5D={ID_CART_Produk}&check%5B%5D={ID_CART_Produk}')
         * 
         * QQ
         */

        // dd($this->request->getVar('cart') == 'true');
        $kuponModel = new KuponModel();
        $alamatModel = new AlamatUserModel();
        $kategoriModel = new KategoriModel();
        $cartProdukModel = new CartProdukModel();
        $userModel = new UsersModel();
        $tokoModel = new TokoModel();
        $promoProduk = new PromoProduk();
        $produkModel = new ProdukModel();
        $variasiItemModel = new VariasiItemModel();

        $alamat_list = $alamatModel->where('id_user', user_id())->findAll();

        $kuponList = $kuponModel->where('available_kupon >', 0)->where('is_active', 1)->findAll();
        $idPromoProduk = $this->request->getVar('id_promo_produk');

        $data = [
            'title' => 'Checkout',
            'alamat_list' => $alamat_list,
            'kupon' => $kuponList,
            'kategori' => $kategoriModel->findAll(),
            'promoProduk' => $promoProduk->findAll(),
            'market_list' => $tokoModel->findAll(),
            'marketSelected' => $userModel->find(user_id())['market_selected'],
            'addressSelected' => $userModel->find(user_id())['address_selected'],
            'back' => 'cart'
            // 'market' => $market,
        ];

        $checkoutFormCart = $this->request->getVar('cart');
        if ($checkoutFormCart == 'true') {
            $checkedId = $this->request->getVar('check');
            if (!$checkedId) {
                return redirect()->to(base_url('cart2'));
            }
            foreach ($checkedId as $key => $id) {
                $data['produk'][$key] = $cartProdukModel->select('*')
                    ->join('jsf_produk', 'jsf_produk.id_produk = jsf_cart_produk.id_produk', 'inner')
                    ->join('jsf_variasi_item', 'jsf_variasi_item.id_variasi_item = jsf_cart_produk.id_variasi_item', 'inner')
                    ->find($id);
            }
        } else {
            // Not buy from cart
            $data['produk'][0] = $variasiItemModel->select('jsf_variasi_item.*, jsf_produk.*')
                ->join('jsf_produk', 'jsf_produk.id_produk = jsf_variasi_item.id_produk', 'inner')
                ->where('jsf_variasi_item.id_variasi_item', $this->request->getVar('varian'))
                ->where('jsf_produk.slug', $this->request->getVar('slug'))->first();
            $data['produk'][0]['qty'] = $this->request->getVar('qty');
        }

        // Checkout Promo
        $data['promoProduk'] = $promoProduk
            ->select('jsf_promo_produk.*, jsf_promo.*, jsf_variasi_item.*, jsf_produk.*')
            ->join('jsf_promo', 'jsf_promo.id_promo = jsf_promo_produk.id_promo', 'inner')
            ->join('jsf_produk', 'jsf_promo_produk.id_produk = jsf_produk.id_produk', 'inner')
            ->join('jsf_variasi_item', 'jsf_variasi_item.id_produk = jsf_promo_produk.id_produk', 'inner')
            ->where('jsf_promo_produk.id', $idPromoProduk)
            ->first();
        // dd($data['promoProduk']);

        $totalAkhir = 0;
        $beratTotal = 0;
        $totalDiscount = 0;
        if (!empty($data['produk'])) {
            foreach ($data['produk'] as $key => $produk) {
                $rowTotal = $produk['qty'] * $produk['harga_item'];
                $totalAkhir += $rowTotal;
                $rowBerat = $produk['berat'] * $produk['qty'];
                $beratTotal += $rowBerat;
                // $promoDetails = $promoProduk->getPromoDetailsByIdProduk($produk['id_produk']);
                // if (count($promoDetails) > 0 && $produk['qty'] >= $promoDetails[0]['min']) {
                //     $data['produk'][$key]['promo'] = $promoDetails[0];
                //     $data['produk'][$key]['promo']['total'] = $rowTotal * $promoDetails[0]['discount'];
                //     $totalDiscount += $data['produk'][$key]['promo']['total'];
                // }
            }
        }

        // Checkout Promo
        $qty = 1;
        foreach ($data['promoProduk'] as $key => &$produk) {
            $produk['qty'] = $qty;
            // dd($produk);
            if ($produk['required_quantity'] > 0) {
                $rowTotal = $produk['qty'] * $produk['harga_item'] * $produk['required_quantity'];
            } else {
                $rowTotal = $produk['qty'] * $produk['harga_item'];
            }
            $totalAkhir += $rowTotal;
            $rowBerat = $produk['berat'] * $produk['qty'];
            $beratTotal += $rowBerat;
        }

        $data['total'] = $totalAkhir;
        $data['beratTotal'] = $beratTotal;
        $data['totalDiscount'] = $totalDiscount;
        // dd($data['promoProduk']);
        return view('transaction/midtarnsCoreUI/checkout', $data);
    }


    public function storeData()
    {
        // dd($this->request->getVar());
        $slug = $this->request->getVar('slug');
        $metode_pemabayaran = $this->request->getVar('paymentType');

        if (!$metode_pemabayaran) {
            return redirect()->back();
        }
        $checkoutModel = new CheckoutModel();
        $checkoutProdukModel = new CheckoutProdukModel();
        $midtransConfig = new \Config\Midtrans();
        $alamatUserModel = new AlamatUserModel();
        $userModel = new UsersModel();
        $checkoutResponseModel = new CheckoutResponseModel();
        $promoProduk = new PromoProduk();
        $kuponModel = new KuponModel();
        $variasiItemModel = new VariasiItemModel();
        $cartModel = new CartModel();
        $cartProdukModel = new CartProdukModel();

        // Set the Midtrans API credentials
        MidtransConfig::$serverKey = $midtransConfig->serverKey;
        MidtransConfig::$clientKey = $midtransConfig->clientKey;
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        MidtransConfig::$isProduction = $midtransConfig->isProduction;
        // Set sanitization on (default)
        MidtransConfig::$isSanitized = $midtransConfig->isSanitized;
        // Set 3DS transaction for credit card to true
        MidtransConfig::$is3ds = $midtransConfig->is3ds;

        $idProduk = $this->request->getVar('idProduk');
        $varianProduk = $this->request->getVar('varianProduk');
        $qtyProduk = $this->request->getVar('qtyProduk');

        if (count($idProduk) != count($varianProduk) || count($idProduk) != count($qtyProduk)) {
            return view('404', ['title' => '404']);
        }
        // start:  jika tidak ada promo atau kupon maka total hanya akan rumus dibawah 
        $total_1 = 0;
        $totalDiscount = 0;

        foreach ($idProduk as $key => $p) {
            $produk[$key] = $variasiItemModel->select('jsf_variasi_item.*, jsf_produk.*')
                ->join('jsf_produk', 'jsf_produk.id_produk = jsf_variasi_item.id_produk', 'inner')
                ->where('jsf_variasi_item.id_variasi_item', $varianProduk[$key])
                ->where('jsf_produk.id_produk', $p)->first();
            $produk[$key]['qty'] = $qtyProduk[$key];
            $requiredQuantity = $promoProduk->getRequiredQuantity($produk[$key]['id_produk']);
            if ($requiredQuantity > 0) {
                // Apply requiredQuantity if available
                $rowTotal = $produk[$key]['qty'] * $produk[$key]['harga_item'] * $requiredQuantity;
                $cekProduk[] = [
                    'id' => $p,
                    'price' => $produk[$key]['harga_item'] * $requiredQuantity,
                    'quantity' => $produk[$key]['qty'] * $requiredQuantity,
                    'name' => $produk[$key]['nama'] . '(' . $produk[$key]['value_item'] . ')',
                ];
            } else {
                $rowTotal = $produk[$key]['qty'] * $produk[$key]['harga_item'];
                $cekProduk[] = [
                    'id' => $p,
                    'price' => $produk[$key]['harga_item'],
                    'quantity' => $produk[$key]['qty'],
                    'name' => $produk[$key]['nama'] . '(' . $produk[$key]['value_item'] . ')',
                ];
            }
            $total_1 += $rowTotal;

            $rowTotal = $produk[$key]['qty'] * $produk[$key]['harga_item'];

            // jika ada ada promo maka total akan rumus dibawah 
            // $promoDetails = $promoProduk->getPromoDetailsByIdProduk($produk[$key]['id_produk']);
            // if (count($promoDetails) > 0 && $produk[$key]['qty'] >= $promoDetails[0]['min']) {
            //     $produk[$key]['promo'] = $promoDetails[0];
            //     $produk[$key]['promo']['total'] = $rowTotal * $promoDetails[0]['discount'];
            //     $totalDiscount += $produk[$key]['promo']['total'];
            // }
        }

        $total_2 = $total_1;
        // dd($total_1, $total_2, $totalDiscount, $cekProduk);

        $inv = 'INV-' . date('Ymd') . '-' . mt_rand(10, 99) . time();

        $email = $userModel->getEmail(user_id());

        $discount = '';
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

        // Create param for Midtrans 
        if ($totalDiscount > 0) {
            $cekProduk[] = [
                'id' => 'diskonPromo',
                'price' => -round($totalDiscount),
                'quantity' => 1,
                'name' => 'Total Diskon Promo',
            ];
        }

        $total_2 = $total_1 - $totalDiscount;

        // dd($total_1, $total_2, $totalDiscount, $cekProduk);

        $kupon = [
            'discount' => '',
            'kupon' => ''
        ];
        // end Promo

        // Start : Promo kupon 
        if ($kode != '') {
            $cekKupon = $kuponModel->getKupon($kode);
            $idKupon = $kuponModel->getKuponId($kode);
            $discount = floatval($cekKupon['discount']);
            $getDiscount = $total_2 * $discount;
            $total_2 = $total_2 - $getDiscount;
            $kupon = [
                'discount' => $cekKupon['discount'],
                'kupon' => $cekKupon['kode']
            ];
            $cekProduk[] = [
                'id' => 'diskonKupon',
                'price' => -round($getDiscount),
                'quantity' => 1,
                'name' => 'Diskon Kupon',
            ];
            $discount = $cekKupon['discount'];
        }
        // dd($total_1, $total_2, $totalDiscount, $getDiscount, $cekProduk);


        // end promo kupon
        $total_2 = $service + $total_2;
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
                'gross_amount' => (int)floor($total_2),
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
            // 'item_details' => $cekProduk,
            'item_details' => [
                [
                    'id' => $produk[0]['id_produk'],
                    'price' => $total_1,
                    'quantity' => $produk[0]['qty'],
                    'name' => $produk[0]['nama'] . ' ' . $produk[0]['value_item'],
                ],
                [
                    'id' => 'Service',
                    'price' => $service,
                    'quantity' => 1,
                    'name' => $servicetext,
                ],
            ],
        ];
        // dd($total_1, $total_2, $totalDiscount, $getDiscount, $cekProduk, $params);
        // dd($total_1, $total_2, $cekProduk, $params);
        switch ($metode_pemabayaran) {
            case 'cc_snap':
                $params['payment_type'] = "cc_snap";
                break;
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
            'total_2' => (int)floor($total_2),
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
            'snap_token' => $snapToken,
        ];
        // dd($dbStore);
        $chechkoutId = $checkoutModel->insert($dbStore);

        $checkoutResponseModel->insert([
            'id_checkout' => $chechkoutId,
            'response' => json_encode($response),
        ]);

        // dd($produk);
        $cartid = $cartModel->where('id_user', user_id())->first();
        foreach ($produk as $key => $p) {
            $checkoutProdukData = [
                'id_checkout' => $chechkoutId,
                'id_produk' => $p['id_produk'],
                'id_variasi_item' => $p['id_variasi_item'],
                'qty' => $p['qty'],
                'harga' => $p['harga_item'],
            ];
            $checkoutProdukModel->insert($checkoutProdukData);
            //delete from cart 
            $cartProdukModel->where('id_cart', $cartid['id_cart'])->where('id_produk', $p['id_produk'])->where('id_variasi_item', $p['id_variasi_item'])->delete();
        }


        if (!empty($kode)) {
            $idKupon = $kuponModel->getKuponId($kode);
            if ($idKupon) {
                $kuponModel->useCoupon($idKupon);
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
        if ($payment_type == 'qris' || $payment_type == 'shopeepay' || $payment_type == 'gopay' || $payment_type == 'cc_snap') {
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
            return view('transaction/midtarnsCoreUI/virtualAccount', $data);
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
            return view('404', ['title' => '404']);
            return dd($e);
        }
        // $data['pay']['status'] = $paymentStatus;
        // return redirect()->to(base_url('status?order_id=' . $paymentStatus->order_id));
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
}
