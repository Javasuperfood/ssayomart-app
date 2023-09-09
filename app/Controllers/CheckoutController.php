<?php

namespace App\Controllers;

use App\Models\AlamatUserModel;
use App\Models\CartModel;
use App\Models\CartProdukModel;
use App\Models\CheckoutModel;
use App\Models\CheckoutProdukModel;
use App\Models\KuponModel;

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
            'invoice' => 'INV-' . date('Ymd') . '-' . mt_rand(100000, 999999),
            'catatan' => 'dear user',
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
        $checkoutModel = new CheckoutModel();
        $alamatModel = new AlamatUserModel();
        $kuponModel = new KuponModel();

        $cekUser = $checkoutModel->where('id_checkout', $id)->first();

        if ($cekUser['id_user'] != user_id()) {
            return redirect()->to(base_url());
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
            'kupon' => $kuponList
        ];
        // dd($data);

        return view('user/home/checkout/checkout', $data);
    }
    public function bayar($id)
    {
        $kode = $this->request->getVar('kupon');
        $total_1 = $this->request->getVar('total');
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
            $kupon = [
                'discount' => $cekKupon['discount'],
                'kupon' => $cekKupon['kode']
            ];
        }

        $alamatUserModel = new AlamatUserModel();
        $checkoutModel = new CheckoutModel();

        $inv = $checkoutModel->find($id);
        $id_alamat = $this->request->getVar('alamat_list');
        $alamat = $alamatUserModel->find($id_alamat);
        $kirim = 'Penerima : ' . $alamat['penerima'] . '<br>' . $alamat['alamat_1'] . ', ' . $alamat['city'] . ', '  . $alamat['province'] . '<br>' . $alamat['zip_code'] . '<br>' . 'Telp : ' . $alamat['telp'];


        $data = [
            'id_checkout' => $id,
            'id_status_pesan' => 2,
            'total_1' => $total_1,
            'total_2' => $total_2,
            'service' => $this->request->getVar('serviceText'),
            'harga_service' => $this->request->getVar('service'),
            'kurir' => strtoupper($this->request->getVar('kurir')),
            'kirim' => $kirim,
            'discount' => $kupon['discount'],
            'kupon' => $kupon['kupon'],
        ];
        // return dd($data);
        if (!$checkoutModel->save($data)) {
            return redirect()->to(base_url('checkout/' . $id))->with('failed', 'Tarnsaksi Gagal');
        }
        return redirect()->to(base_url('status/' . $inv['invoice']));
        // dd($data);
    }
}
