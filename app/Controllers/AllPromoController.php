<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\BannerModel;
use App\Models\BannerPopupModel;
use App\Models\BannerPromotionModel;
use App\Models\CartModel;
use App\Models\PromoModel;
use App\Models\ProdukModel;
use App\Models\VariasiItemModel;
use App\Models\UsersModel;
use App\Models\BlogModel;
use App\Models\TokoModel;
use App\Models\PromoProduk;
use App\Models\ProdukBundleModel;

class AllPromoController extends BaseController
{
    // ===================================================================
    // ------------------------ All PROMO ------------------------------
    // ===================================================================
    public function promoBundle()
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
        $marketModel = new TokoModel();

        $user = auth()->loggedIn() ? $userModel->where('id', user_id())->first() : null;

        $randomProducts = $produkModel->getRandomProducts();
        $bannerList = $bannerModel->findAll();

        $data = [
            'title' => 'Promo Bundle',
            'user' => $user,
            'market' => auth()->loggedIn() ? $marketModel->findAll() : [],
            'promo' => $promoModel->getPromo($now),
            'kategori' => $kategoriModel->orderBy('short', SORT_ASC)->findAll(),
            'banner' => $bannerModel->find(),
            'randomProducts' => $randomProducts,
            'blog_detail' => $blog_detail,
            'content' => $bannerList,
            'banner_promotion' => $bannerPromotionModel->find(),
            'banner_pop_up' => $bannerPopupModel->find(),
        ];
        // dd($data);
        return view('user/home/allpromo/promoBundle', $data);
    }

    public function index($slug)
    {
        $kategori = new KategoriModel();
        $promoProduk = new PromoProduk();
        $promoModel = new PromoModel();
        $produkBundle = new ProdukBundleModel();
        $now = date('Y-m-d H:i:s');
        $promo = $promoModel->getPromo($now);

        $bahasa = session()->get('lang');

        $promoItem = $promoProduk->getPromo($slug);
        if ($promoItem) {
            $filteredPromoItems = [];

            foreach ($promoItem as $item) {
                $idPromoProduk = $item['id_promo'];

                $idPromoKategoriCocok = false;
                foreach ($promo as $kategoriItem) {
                    if ($kategoriItem['id_promo'] === $idPromoProduk) {
                        $idPromoKategoriCocok = true;
                        break;
                    }
                }
                if ($idPromoKategoriCocok) {
                    $filteredPromoItems[] = $item;
                }
            }
            $promoItem = $filteredPromoItems;
        }
        // dd($promoItem);

        foreach ($promoItem as $key => $c) {
            $promoItem[$key]['produk'] = $produkBundle->getProdukByIdPromoProduk($c['id_promo_produk']);
        }
        // dd($promoItem);


        if ($bahasa == 'id') {
            $kolomNama = 'nama';
        } else {
            $kolomNama = 'nama_' . $bahasa;
        }

        $title = (!$promoItem) ? 'Promo' : $promoItem[0]['title'];

        $data = [
            'title' => $title,
            'produk' => $promoItem,
            'kategori_promo' => $promo,
            'kategori' => $kategori->findAll(),
            'kolomNama' => $kolomNama,
            'back' => ''
        ];
        // dd($data);
        return view('user/promo/promo', $data);
    }

    public function show($id)
    {
        $kategori = new KategoriModel();
        $promoProduk = new PromoProduk();
        $promoModel = new PromoModel();
        $produkBundle = new ProdukBundleModel();
        $produkModel = new ProdukModel();
        $varianModel = new VariasiItemModel();
        $now = date('Y-m-d H:i:s');
        $promo = $promoModel->getPromo($now);

        $bahasa = session()->get('lang');

        $produk = $produkModel->getSingleProduct();
        $varianItem = $varianModel->getByIdProduk($produk['id_produk']);

        $promoItem = $promoProduk->getDetailProduct($id);
        $promoItem['produk'] = $produkBundle->getProdukByIdPromoProduk($promoItem['id_promo_produk']);
        // dd($promoItem);

        if ($bahasa == 'id') {
            $kolomNama = 'nama';
        } else {
            $kolomNama = 'nama_' . $bahasa;
        }

        $title = (!$promoItem) ? 'Promo' : $promoItem['title'];

        $data = [
            'title' => $title,
            'promoProduk' => $promoItem,
            'kategori_promo' => $promo,
            'kategori' => $kategori->findAll(),
            'varian' => $varianItem,
            'varianItem' => count($varianItem),
            'kolomNama' => $kolomNama,
            'back' => ''
        ];
        // dd($data);
        return view('user/home/allpromo/detailPromoBundle', $data);
    }

    public function promoDiscount()
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
        $marketModel = new TokoModel();

        $user = auth()->loggedIn() ? $userModel->where('id', user_id())->first() : null;

        $randomProducts = $produkModel->getRandomProducts();
        $bannerList = $bannerModel->findAll();

        $data = [
            'title' => 'Promo Potongan Harga',
            'user' => $user,
            'market' => auth()->loggedIn() ? $marketModel->findAll() : [],
            'promo' => $promoModel->getPromo($now),
            'kategori' => $kategoriModel->orderBy('short', SORT_ASC)->findAll(),
            'banner' => $bannerModel->find(),
            'randomProducts' => $randomProducts,
            'blog_detail' => $blog_detail,
            'content' => $bannerList,
            'banner_promotion' => $bannerPromotionModel->find(),
            'banner_pop_up' => $bannerPopupModel->find(),
        ];
        // dd($data);
        return view('user/home/allpromo/promoDiscount', $data);
    }
}
