<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\CartProdukModel;
use App\Models\ProdukModel;

class CartController extends BaseController
{
    public function addToCart($slug)
    {

        $cartModel = new CartModel();
        $cartProdModel = new CartProdukModel();
        $qty = $this->request->getVar('qty');
        $harga = $this->request->getVar('harga');
        $id_produk = $this->request->getVar('id_produk');
        $total = $harga * $qty;
        $cekCart = $cartModel->where(['id_user' => user_id()])->first();
        $cekCartProduk = $cartProdModel->where(['id_cart' => $cekCart['id_cart']])->where(['id_produk' => $id_produk])->first();

        $dbCart = [
            'id_cart' => $cekCart['id_cart'],
            'id_user' => user_id(),
            'total' => $total
        ];
        $cartModel->save($dbCart);
        if (!$cekCartProduk) {
            $dbCartProd = [
                'id_cart' => $cekCart['id_cart'],
                'id_produk' => $id_produk,
                'qty' => $qty,
            ];
        } elseif ($cekCartProduk['id_cart'] == $cekCart['id_cart'] && $cekCartProduk['id_produk'] == $id_produk) {
            $dbCartProd = [
                'id_cart_produk' => $cekCartProduk['id_cart_produk'],
                'id_cart' => $cekCart['id_cart'],
                'id_produk' => $id_produk,
                'qty' => $qty,
            ];
        }
        $cartProdModel->save($dbCartProd);
        $produk = new ProdukModel();
        $single = $produk->getProduk($slug);
        $data = [
            'title' => $single['nama'],
            'produk' => $single
        ];
        // dd($data);
        return view('user/produk/produk', $data);
    }
}
