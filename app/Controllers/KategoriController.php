<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\BannerModel;
use App\Models\CartModel;
use App\Models\PromoModel;
use App\Models\WishlistModel;
use App\Models\ProdukModel;

class KategoriController extends BaseController
{
    public function index()
    {

        $now = date('Y-m-d H:i:s');
        $promoModel = new PromoModel();
        $kategoriModel = new KategoriModel();
        $bannerModel = new BannerModel();
        $produkModel = new ProdukModel();

        $randomProducts = $produkModel->getRandomProducts();

        $data = [
            'title' => 'Ssayomart',
            'promo' => $promoModel->getPromo($now),
            'kategori' => $kategoriModel->findAll(),
            'banner' => $bannerModel->find(),
            'randomProducts' => $randomProducts, // Kirim produk-produk acak ke view.
        ];
        // dd($data);
        return view('user/home/Kategori', $data);
    }
}
