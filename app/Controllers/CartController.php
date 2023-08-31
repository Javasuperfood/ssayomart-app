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
    public function cart(): string
    {
        $cartModel = new CartModel();

        $cartProdModel = new CartProdukModel();
        $cekCart = $cartModel->where(['id_user' => user_id()])->first();

        $cekCartProduk = $cartProdModel
            ->select('*')
            ->join('jsf_produk', 'jsf_produk.id_produk = jsf_cart_produk.id_produk', 'inner')
            ->where('id_cart', $cekCart['id_cart'])
            ->findAll();

        // Inisialisasi variabel untuk menyimpan total akhir
        $totalAkhir = 0;

        // Menghitung total dan menyimpannya dalam variabel
        foreach ($cekCartProduk as $produk) {
            $rowTotal = $produk['qty'] * $produk['harga'];
            $totalAkhir += $rowTotal;
            // Jika ingin menampilkan row total untuk masing-masing produk
            // echo "Row Total: $rowTotal<br>";
        }
        $data = [
            'title'     => 'Keranjang',
            'produk' => $cekCartProduk,
            'total' => $totalAkhir
        ];
        return view('user/home/cart/cart', $data);
    }
    public function deleteProduk($id)
    {
        $cartProdModel = new CartProdukModel();
        if (!$cartProdModel->delete($id)) {
            return redirect()->to(base_url() . 'cart')->with('failed', 'Gagal menghapus produk.');
        }
        return redirect()->to(base_url() . 'cart')->with('success', 'Berhasil Mengapus produk dalam cart.');
    }
}
