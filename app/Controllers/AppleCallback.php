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

class AppleCallback extends BaseController
{
    public function appleSignInCallback()
    {
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

        $randomProducts = $produkModel->getRandomProducts();
        $bannerList = $bannerModel->findAll();

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
        ];
        // dd($data);

        // return view('user/home/Kategori', $data);
        return view('user/home/Kategori2', $data);
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