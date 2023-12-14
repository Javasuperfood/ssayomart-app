<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\WishlistModel;
use App\Models\WishlistProdukModel;
use App\Models\KategoriModel;

class WishlistController extends BaseController
{
    public function index(): string
    {
        $wishlistModel = new WishlistModel();
        $kategori = new KategoriModel();

        $wishlistProdModel = new WishlistProdukModel();
        $cekWishlist = $wishlistModel->where(['id_user' => user_id()])->first();

        $cekWishlistProduk = $wishlistProdModel
            ->select('*')
            ->join('jsf_produk', 'jsf_produk.id_produk = jsf_wishlist_produk.id_produk', 'inner')
            ->where('id_wishlist', $cekWishlist['id_wishlist'])
            ->findAll();

        $data = [
            'title'     => 'Wishlist',
            'produk' => $cekWishlistProduk,
            'kategori' => $kategori->findAll(),
            'back' => ''
        ];
        // dd($data);
        return view('user/home/wishlist/wishlist', $data);
    }
    public function deleteProduk($id)
    {
        $wishlistProdModel = new WishlistProdukModel();
        if (!$wishlistProdModel->delete($id)) {
            return redirect()->to(base_url() . 'wishlist')->with('failed', 'Gagal menghapus produk.');
        }
        return redirect()->to(base_url() . 'wishlist')->with('success', 'Berhasil Mengapus produk dalam wishlist.');
    }
    public function ajaxAdd()
    {
        $wishlistModel = new WishlistModel();
        $wishlistProdModel = new WishlistProdukModel();

        $id_produk = $this->request->getVar('id_produk');

        $cekWislist = $wishlistModel->where(['id_user' => user_id()])->first();
        $cekWislistProduk = $wishlistProdModel->where(['id_wishlist' => $cekWislist['id_wishlist']])->where(['id_produk' => $id_produk])->first();

        if (!$cekWislistProduk) {
            $dbWishlistProd = [
                'id_wishlist' => $cekWislist['id_wishlist'],
                'id_produk' => $id_produk,
            ];
        } elseif ($cekWislistProduk['id_wishlist'] == $cekWislist['id_wishlist'] && $cekWislistProduk['id_produk'] == $id_produk) {
            $dbWishlistProd = [
                'id_wishlist_produk' => $cekWislistProduk['id_wishlist_produk'],
                'id_wishlist' => $cekWislist['id_wishlist'],
                'id_produk' => $id_produk,
            ];
        }
        // dd($dbWishlistProd);
        if (!$wishlistProdModel->save($dbWishlistProd)) {
            $response = [
                'success' => false,
                'message' => 'Gagal menambhakan produk dalam wishlist.'
            ];
            return $this->response->setJSON($response);
        }
        $response = [
            'success' => true,
            'message' => 'Berhasil menambhakan produk dalam wishlist.'
        ];

        return $this->response->setJSON($response);
    }
}
