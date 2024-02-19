<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\BannerModel;
use App\Models\BannerPopupModel;
use App\Models\BannerPromotionModel;
use App\Models\CartModel;
use App\Models\CartProdukModel;
use App\Models\PromoModel;
use App\Models\WishlistModel;
use App\Models\ProdukModel;
use App\Models\UsersModel;
use App\Models\BlogModel;
use App\Models\TokoModel;
use App\Models\AlamatUserModel;

class KategoriController extends BaseController
{
    public function index()
    {
        if (session('magicLogin')) {
            return redirect()->to(base_url('password-reset'));
        }
        // ================ INI PENTING ==================
        $lang = $this->session->get('lang');
        if (!$lang) {
            $this->session->set('lang', 'id');
        }
        if (auth()->loggedIn()) {
            $cart = new CartModel();
            $result1 = $cart->where(['id_user' => user_id()])->first();
            $wishlist = new WishlistModel();
            $result2 = $wishlist->where(['id_user' => user_id()])->first();
            if (!$result1) {
                $dbCart = [
                    'id_user' => user_id(),
                    'total' => 0
                ];
                $cart->save($dbCart);
                $setData = [
                    'cart'  => true,
                ];
                $this->session->set($setData);
            }
            if (!$result2) {
                $dbWishlist = [
                    'id_user' => user_id(),
                ];
                $wishlist->save($dbWishlist);
                $setData = [
                    'wishlist'  => true,
                ];
                $this->session->set($setData);
            }
            $this->session->set(['countCart' => $this->countCart()]);
        }
        // ================================================

        $now = date('Y-m-d H:i:s');
        $promoModel = new PromoModel();
        $kategoriModel = new KategoriModel();
        $bannerModel = new BannerModel();
        $bannerPopupModel = new BannerPopupModel();
        $bannerPromotionModel = new BannerPromotionModel();
        $produkModel = new ProdukModel();
        $blogModel = new BlogModel();
        $userModel = new UsersModel();
        $blog_detail = $blogModel->getAllBlog();
        $alamatUserModel = new AlamatUserModel();
        $marketModel = new TokoModel();
        $user = $userModel->where('id', user_id())->first();

        $randomProducts = $produkModel->getRandomProducts();
        $bannerList = $bannerModel->findAll();

        $marketSelected = null;
        if ($user['market_selected']) {
            $getCity = isset($marketModel->find($user['market_selected'])['city']);
            $marketSelected =  ($getCity) ? $marketModel->find($user['market_selected'])['lable'] : 'Pilih Lokasi Market';
        } else {
            $marketSelected = 'Pilih Lokasi abang';
        }
        $addressSelected = null;
        if ($user['address_selected']) {
            $getLabel = isset($alamatUserModel->find($user['address_selected'])['city']);
            $addressSelected =  ($getLabel) ?  $alamatUserModel->find($user['address_selected'])['label'] : 'Pilih Lokasi Pengataran';
        } else {
            $addressSelected = 'Pilih Alamat';
        }

        $data = [
            'title' => 'Ssayomart',
            'promo' => $promoModel->getPromo($now),
            'kategori' => $kategoriModel->orderBy('short', SORT_ASC)->findAll(),
            'banner' => $bannerModel->find(),
            'banner_pop_up' => $bannerPopupModel->find(),
            'banner_promotion' => $bannerPromotionModel->find(),
            'randomProducts' => $randomProducts,
            'blog_detail' => $blog_detail,
            'content' => $bannerList,
            'produk' => $produkModel->getProdukHome('rekomendasi'),
            'latest' => $produkModel->getProdukHome('produk_terbaru'),
            'alamat' => $addressSelected,
            'market' => $marketModel->findAll(),
            'marketSelected' => $marketSelected,
        ];
        // dd($data);

        // return view('user/home/Kategori', $data);
        return view('user/home/Kategori', $data);
    }

    // ================ All Kategori ==============================

    public function allKategori()
    {
        $kategori = new KategoriModel();
        $data = [
            'title' => 'All Kategori',
            'kategori' => $kategori->findAll(),
            'back' => '/'
        ];
        // dd($data);
        return view('user/home/AllKategori', $data);
    }
}
