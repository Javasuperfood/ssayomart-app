<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\CartProdukModel;
use App\Models\CheckoutProdukModel;
use App\Models\KategoriModel;
use App\Models\WishlistModel;
use App\Models\WishlistProdukModel;

class CartController extends BaseController
{
    public function cart()
    {
        $cartModel = new CartModel();
        $kategori = new KategoriModel();
        $cartProdModel = new CartProdukModel();
        $cekCart = $cartModel->where(['id_user' => user_id()])->first();

        $cekCartProduk = $cartProdModel
            ->select('*')
            ->join('jsf_produk', 'jsf_produk.id_produk = jsf_cart_produk.id_produk', 'inner')
            ->join('jsf_variasi_item', 'jsf_variasi_item.id_variasi_item = jsf_cart_produk.id_variasi_item', 'inner')
            ->where('id_cart', $cekCart['id_cart'])
            ->findAll();

        // Inisialisasi variabel untuk menyimpan total akhir
        $totalAkhir = 0;
        // Menghitung total dan menyimpannya dalam variabel
        foreach ($cekCartProduk as $produk) {
            $rowTotal = $produk['qty'] * $produk['harga_item'];
            $totalAkhir += $rowTotal;
            // Jika ingin menampilkan row total untuk masing-masing produk
            // echo "Row Total: $rowTotal<br>";
        }
        $data = [
            'title'     => lang('Text.title_cart'),
            'produk' => $cekCartProduk,
            'total' => $totalAkhir,
            'kategori' => $kategori->findAll(),
            'back' => ''
        ];
        // dd($data);
        return view('user/home/cart/cart', $data);
    }
    public function deleteProduk($id)
    {
        $cartProdModel = new CartProdukModel();
        if (!$cartProdModel->delete($id)) {
            return redirect()->to(base_url() . 'cart')->with('failed', 'Gagal menghapus produk.');
        }
        $this->session->set(['countCart' => $this->countCart()]);
        return redirect()->to(base_url() . 'cart')->with('success', 'Berhasil Menghapus produk dalam cart.');
    }
    public function ajaxAdd()
    {
        $cartModel = new CartModel();
        $cartProdModel = new CartProdukModel();
        $wishlistModel = new WishlistModel();
        $wishlistProdModel = new WishlistProdukModel();
        $qty = $this->request->getVar('qty');
        $harga = $this->request->getVar('harga');
        $id_produk = $this->request->getVar('id_produk');
        $id_varian = $this->request->getVar('id_varian');
        $wishlist = $wishlistModel->where('id_user', user_id())->first();
        $wishlistItem = $wishlistProdModel->where('id_wishlist', $wishlist['id_wishlist'])->where('id_produk', $id_produk)->first();

        //=================== nanti ubah 
        $total = $harga * $qty;
        // ======================

        $cekCart = $cartModel->where(['id_user' => user_id()])->first();
        $cekCartProduk = $cartProdModel->where(['id_cart' => $cekCart['id_cart']])->where(['id_produk' => $id_produk])->where(['id_variasi_item' => $id_varian])->first();

        $dbCart = [
            'id_cart' => $cekCart['id_cart'],
            'id_user' => user_id(),
        ];
        $cartModel->save($dbCart);


        if (!$cekCartProduk) {
            $dbCartProd = [
                'id_cart' => $cekCart['id_cart'],
                'id_produk' => $id_produk,
                'id_variasi_item' => $id_varian,
                'qty' => $qty,
            ];
        } elseif ($cekCartProduk['id_cart'] == $cekCart['id_cart'] && $cekCartProduk['id_produk'] == $id_produk && $cekCartProduk['id_variasi_item'] == $id_varian) {
            $dbCartProd = [
                'id_cart_produk' => $cekCartProduk['id_cart_produk'],
                'id_cart' => $cekCart['id_cart'],
                'id_produk' => $id_produk,
                'id_variasi_item' => $id_varian,
                'qty' => $qty,
            ];
        }
        if (!$cartProdModel->save($dbCartProd)) {
            $response = [
                'success' => false,
                'message' => 'Gagal menambahkan produk dalam cart.'
            ];
            return $this->response->setJSON($response);
        }
        $this->session->set(['countCart' => $this->countCart()]);
        if ($wishlistItem) {
            $wishlistProdModel->delete($wishlistItem['id_wishlist_produk']);
        }
        $response = [
            'success' => true,
            'message' => 'Berhasil menambahkan produk dalam cart.'
        ];

        return $this->response->setJSON($response);
    }

    public function ajaxChangeQty()
    {
        $cartProdModel = new CartProdukModel();

        $idCP = $this->request->getVar('idCartProduk');
        $qty = $this->request->getVar('qty');

        if (!$cartProdModel->save(['id_cart_produk' => $idCP, 'qty' => $qty])) {
            $response = [
                'success' => false,
                'message' => 'Gagal update produk dalam cart.'
            ];
            return $this->response->setJSON($response);
        }
        $response = [
            'success' => true,
            'message' => 'Update Qty berhasil'
        ];
        return $this->response->setJSON($response);
    }
    public function cart2()
    {
        $cartModel = new CartModel();
        $kategori = new KategoriModel();
        $cartProdModel = new CartProdukModel();
        $cekCart = $cartModel->where(['id_user' => user_id()])->first();

        $cekCartProduk = $cartProdModel
            ->select('*')
            ->join('jsf_produk', 'jsf_produk.id_produk = jsf_cart_produk.id_produk', 'inner')
            ->join('jsf_variasi_item', 'jsf_variasi_item.id_variasi_item = jsf_cart_produk.id_variasi_item', 'inner')
            ->where('id_cart', $cekCart['id_cart'])
            ->findAll();

        // Inisialisasi variabel untuk menyimpan total akhir
        $totalAkhir = 0;
        // Menghitung total dan menyimpannya dalam variabel
        foreach ($cekCartProduk as $produk) {
            $rowTotal = $produk['qty'] * $produk['harga_item'];
            $totalAkhir += $rowTotal;
            // Jika ingin menampilkan row total untuk masing-masing produk
            // echo "Row Total: $rowTotal<br>";
        }
        $data = [
            'title'     => lang('Text.title_cart'),
            'produk' => $cekCartProduk,
            'total' => $totalAkhir,
            'kategori' => $kategori->findAll(),
            'back' => ''
        ];
        // dd($data);
        return view('user/home/cart/cart2', $data);
    }
}
