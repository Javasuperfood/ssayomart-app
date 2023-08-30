<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\CartProdukModel;

class Cart extends BaseController
{
    public function cart(): string
    {
        $cartModel = new CartModel();

        $cartProdModel = new CartProdukModel();
        $cekCart = $cartModel->where(['id_user' => user_id()])->first();

        // $cekCartProduk = $cartProdModel->select('*')
        //     ->join('jsf_cart_produk', 'jsf_cart_produk.id_produk = jsf_produk.id_produk', 'inner')->where(['id_cart' => $cekCart['id_cart']])->findAll();
        $data = [
            'title'     => 'Keranjang',
            'nama'      => 'Javasuperfood',
            'telp'      => '+62 123456789',
            'label'     => 'Kantor',
            'alamat'    => 'Ruko Cyber Park Jalan Gajah Mada Jalan Boulevard Jendral Sudirman No.2159/2161/2165, RT.001/RW.009, Panunggangan Bar., Kec. Cibodas, Kota Tangerang, Banten 15139',
            'catatan'   => 'Rumah saya ada anjing nya. Awas di gigit. Anjing saya rabies.'
        ];
        // dd($cekCartProduk);
        return view('user/home/cart/cart', $data);
    }
}
