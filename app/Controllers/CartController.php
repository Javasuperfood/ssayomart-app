<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CartModel;
use App\Models\CartProdukModel;
use App\Models\CheckoutProdukModel;
use App\Models\KategoriModel;
use App\Models\StockModel;
use App\Models\UsersModel;

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

    publc function ajaxDeleteCartProd()
    {
        $cartProdModel = new CartProdukModel();
        $cartModel = new CartModel();

        $cartRecord = $cartModel->where('id_user', user_id())->first();
        $id_cart = $cartRecord['id_cart'];

        $cartProdukId = $this->request->getVar('produk');

        $deleted = $cartProdModel->where('id_cart', $id_cart)->whereIn('id_cart_produk', $cartProdukId)->delete();

        if (!$deleted) {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to delete the product.']);
        }

        $this->session->set(['countCart' => $this->countCart()]);
        return $this->response->setJSON(['success' => true, 'message' => 'Product successfully deleted from the cart.']);
    }
  
    public function ajaxDeleteProduk()
    {
        $cartProdModel = new CartProdukModel();
        $cartModel = new CartModel();
        $id_cart = $cartModel->where('id_user', user_id())->first()['id_cart'];
        $id_cart_produk = $cartProdModel->where('id_cart', $id_cart)->where('id_produk', $this->request->getVar('produk'))->first()['id_cart_produk'];
        if (!$cartProdModel->delete($id_cart_produk)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus produk.']);
        }
        $this->session->set(['countCart' => $this->countCart()]);
        return $this->response->setJSON(['success' => true, 'message' => 'Berhasil Menghapus produk dalam cart.']);
    }
    public function ajaxAdd()
    {
        $cartModel = new CartModel();
        $cartProdModel = new CartProdukModel();
        $qty = $this->request->getVar('qty');
        $harga = $this->request->getVar('harga');
        $id_produk = $this->request->getVar('id_produk');
        $id_varian = $this->request->getVar('id_varian');

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
        $userModel = new UsersModel();
        $kategori = new KategoriModel();
        $cartProdModel = new CartProdukModel();
        $stockModel = new StockModel();
        $cekCart = $cartModel->where(['id_user' => user_id()])->first();
        $marketSelected = $userModel->find(user_id())['market_selected'];

        $cekCartProduk = $cartProdModel->getCartProduk($cekCart['id_cart'], $marketSelected);

        $totalAkhir = 0;
        foreach ($cekCartProduk as $key => $produk) {
            if ($produk['required_quantity'] !== null) {
                $rowTotal = $produk['required_quantity'] * $produk['harga_item'] * $produk['qty'];
            } else {
                $rowTotal = $produk['qty'] * $produk['harga_item'];
            }
            $totalAkhir += $rowTotal;
            $stok = $stockModel->getSingleStockVarian($produk['id_variasi_item'], $marketSelected);
            $cekCartProduk[$key]['stok'] = ($stok) ? $stok['stok'] : 0;
        }

        // Tentukan kolom nama sesuai dengan pilihan bahasa
        $bahasa = session()->get('lang');
        if ($bahasa == 'id') {
            $kolomNama = 'nama';
            $kolomNamaKat = 'nama_kategori';
        } else {
            $kolomNama = 'nama_' . $bahasa;
            $kolomNamaKat = 'nama_kategori_' . $bahasa;
        }

        $data = [
            'title'     => lang('Text.title_cart'),
            'produk' => $cekCartProduk,
            'total' => $totalAkhir,
            'kategori' => $kategori->findAll(),
            'marketSelected' => $marketSelected,
            'back' => '',
            'kolomNama' => $kolomNama,
            'kolomNamaKat' => $kolomNamaKat,
        ];
        // dd($data);
        return view('user/home/cart/cart2', $data);
    }
}
