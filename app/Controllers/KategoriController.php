<?php

namespace App\Controllers;

use App\Models\KategoriModel;

use App\Controllers\BaseController;
use App\Models\BannerModel;
use App\Models\CartModel;

class KategoriController extends BaseController
{
    public function index(): string
    {
        if (auth()->loggedIn()) {
            // Do something.
            $init = $this->session->get('cart');
            if (!$init) {
                $cart = new CartModel();
                $result = $cart->where(['id_user' => user_id()])->first();
                if (!$result) {
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
            }
        }

        $kategori = new KategoriModel();
        $banner = new BannerModel();
        $data = [
            'title' => 'Ssayomart',
            'kategori' => $kategori->findAll(),
            'banner' => $banner->find()
        ];
        return view('user/home/Kategori', $data);
    }

   
}
