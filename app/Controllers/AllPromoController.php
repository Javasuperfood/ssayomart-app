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



class AllPromoController extends BaseController
{
    // ===================================================================
    // ------------------------ All PROMO ------------------------------
    // ===================================================================
    public function allPromo()
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

        $user = auth()->loggedIn() ? $userModel->where('id', user_id())->first() : null;

        $randomProducts = $produkModel->getRandomProducts();
        $bannerList = $bannerModel->findAll();

        $marketSelected = null;
        if (auth()->loggedIn() && $user['market_selected']) {
            $getCity = isset($marketModel->find($user['market_selected'])['city']);
            $marketSelected =  ($getCity) ? $marketModel->find($user['market_selected'])['lable'] : lang('Text.pilih_alamat_cabang');
        } else {
            $marketSelected = 'Pilih Lokasi Cabang';
        }
        $addressSelected = null;
        if (auth()->loggedIn() && $user['address_selected']) {
            $getLabel = isset($alamatUserModel->find($user['address_selected'])['city']);
            $addressSelected =  ($getLabel) ?  $alamatUserModel->find($user['address_selected'])['label'] : lang('Text.pilih_alamat');
        } else {
            $addressSelected = 'Pilih Alamat';
        }

        $data = [
            'title' => 'Ssayomart',
            'user' => $user,
            'alamat' => $addressSelected,
            // 'market' => $marketSelected,
            'market' => auth()->loggedIn() ? $marketModel->findAll() : [],
            'marketSelected' => $marketSelected,
            'promo' => $promoModel->getPromo($now),
            'kategori' => $kategoriModel->orderBy('short', SORT_ASC)->findAll(),
            'banner' => $bannerModel->find(),
            'randomProducts' => $randomProducts,
            'blog_detail' => $blog_detail,
            'content' => $bannerList,
            'banner_promotion' => $bannerPromotionModel->find(),
            'banner_pop_up' => $bannerPopupModel->find(),
            // 'produk' => $produkModel->getProdukHome('rekomendasi'),
            // 'latest' => $produkModel->getProdukHome('produk_terbaru'),
        ];
        // dd($data);
        return view('user/home/allpromo/allpromo', $data);
    }
}
