<?php

namespace App\Controllers;

use App\Models\KategoriModel;

use App\Controllers\BaseController;
use App\Models\BannerModel;
use App\Models\CartModel;
use App\Models\PromoModel;
use App\Models\WishlistModel;

class KategoriController extends BaseController
{
    public function index(): string
    {
        if (auth()->loggedIn()) {
            // Do something.
            $init1 = $this->session->get('cart');
            $init2 = $this->session->get('wishlist');
            if (!$init1 || !$init2) {
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
            }
        }
        $now = date('Y-m-d H:i:s');
        $promoModel = new PromoModel();
        $kategoriModel = new KategoriModel();
        $bannerModel = new BannerModel();
        $data = [
            'title' => 'Ssayomart',
            'promo' => $promoModel->getPromo($now),
            'kategori' => $kategoriModel->findAll(),
            'banner' => $bannerModel->find()
        ];
        // dd($data);
        return view('user/home/Kategori', $data);
    }
}
