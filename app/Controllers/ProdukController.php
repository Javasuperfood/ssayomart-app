<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\SubKategoriModel;
use App\Models\ProdukModel;
use App\Models\StockModel;
use App\Models\UsersModel;
use App\Models\VariasiItemModel;
use App\Models\PromoItemModel;
use App\Models\PromoModel;

class ProdukController extends BaseController
{
    public function index()
    {
        $kategori = new KategoriModel();
        $data = [
            'title' => 'Ssayomart',
            'kategori' => $kategori->findAll()
        ];

        return view('user/produk/index', $data);
    }



    public function getProduk($slug1, $slug2)
    {
        $kategoriModel = new KategoriModel();
        $produkModel = new ProdukModel();
        $katSub = $kategoriModel->getKategori($slug1);

        $promoItemModel = new PromoItemModel();
        $promoModel = new PromoModel();

        $subKategori = new SubKategoriModel();
        $subResult = $subKategori->getSubKategoriByKategoriId($katSub['id_kategori']);
        $subSlug = $subKategori->getSubKategori($slug2);
        $kategori = $kategoriModel->findAll();
        $now = date('Y-m-d H:i:s');
        $promo = $promoModel->getPromo($now);
        $promoItem = $promoItemModel->getPromo($slug1);
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


        $produkModel = new ProdukModel();
        if ($this->request->isAJAX()) {
            $page = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
            if (!$slug2) {
                $getProduk = $produkModel->getProductWithRange($katSub['id_kategori'], false, false, $page);
            }
            if ($slug1 && $slug2) {
                $getProduk = $produkModel->getProductWithRange($katSub['id_kategori'], $subSlug['id_sub_kategori'], false, $page);
            }

            // Kirim data dalam format JSON
            return $this->response->setJSON($getProduk);
        } else {

            if (!$slug2) {
                $getProduk = $produkModel->getProductWithRange($katSub['id_kategori'], false, false);
                // if ($getProduk[0]['id_kategori']==)
                // return redirect()->to(base_url('produk/kategori/' . $slug1 . '/' . ''));
            }
            if ($slug1 && $slug2) {
                $getProduk = $produkModel->getProductWithRange($katSub['id_kategori'], $subSlug['id_sub_kategori'], false);
            }

            $data = [
                'title' => $katSub['nama_kategori'],
                'kategori' => $kategori,
                'kategori_single' => $kategori,
                'produk' => $getProduk,
                'subKategori' => $subResult,
                'sk' => $slug2,
                'kategori_promo' => $promo,
                'back' => '/' . '#ktr',
                'featuredProducts' => $produkModel->getFeaturedProductsByCategory($slug1, $slug2)
            ];
            if ($this->request->getUserAgent()->isMobile()) {
                $data['back'] = 'all-category';
            }
            // dd($data);
            return view('user/produk/index', $data);
        }
    }

    public function produkShowSingle($slug)
    {
        $kategoriModel = new KategoriModel();
        $subKategori = new SubKategoriModel();
        $produkModel = new ProdukModel();
        $varianModel = new VariasiItemModel();
        $varianModel = new VariasiItemModel();
        $userModel = new UsersModel();
        $stokModel = new StockModel();

        $produk = $produkModel->getProduk($slug);
        $varianItem = $varianModel->getByIdProduk($produk['id_produk']);

        $randomProducts = $produkModel->getRandomProducts();
        // Mengambil kategori berdasarkan id_produk
        $kategoriProduk = $kategoriModel->getKategoriByProdukId($produk['id_produk']);
        $subKategoriProduk = $subKategori->getSubKategoriByProdukId($produk['id_produk']);

        $data = [
            'title' => $produk['nama'],
            'img_meta' => base_url() . 'assets/img/produk/main/' . $produk['img'],
            'description_meta' => $produk['deskripsi'],
            'kategori' => $kategoriModel->findAll(),
            'produk' => $produk,
            'varian' => $varianItem,
            'varianItem' => count($varianItem),
            'randomProducts' => $randomProducts,
            'kategoriProduk' => $kategoriProduk, // Menambahkan kategori produk
            'subKategoriProduk' => $subKategoriProduk, // Menambahkan kategori produk
            'useStock' => false
        ];
        // dd($data);

        if (auth()->loggedIn()) {
            $marketSelected = $userModel->find(user_id())['market_selected'];
            $stok = $stokModel->getStock($produk['id_produk'], $marketSelected);
            $data['stok'] = $stok;
            $data['useStock'] = (count($stok) < 1);
        }

        // if (auth()->loggedIn()) {
        //     $marketSelected = $userModel->find(user_id())['market_selected'];
        //     $stok = $stokModel->getStock($produk['id_produk'], $marketSelected);
        //     $data['isStockAvailable'] = (isset($stok[0]['stok']) && $stok[0]['stok'] >= 50);
        //     $data['showCartAndBuyButtons'] = (isset($stok[0]['stok']) && $stok[0]['stok'] > 50);

        //     if (isset($stok[0]['stok'])) {
        //         $data['stok'] = $stok;
        //         $data['useStock'] = (count($stok) < 1);
        //     }
        // }

        return view('user/produk/produk', $data);
    }

    public function search()
    {
        if ($this->request->isAJAX()) {
            $page = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
            $keyword = $this->request->getVar('produk');

            $produkModel = new ProdukModel();
            $getProduk = $produkModel->getProductWithRange(false, false, $keyword, $page);

            // Kirim data dalam format JSON
            return $this->response->setJSON($getProduk);
        } else {
            $keyword = $this->request->getVar('produk');

            $kategori = new KategoriModel();
            $produkModel = new ProdukModel();
            $getProduk = $produkModel->getProductWithRange(false, false, $keyword);

            $data = [
                'title' => 'Hasil Pencarian',
                'produk' => $getProduk,
                'kategori' => $kategori->findAll(),
                'back' => '',
                'featuredProducts' => $produkModel->getProductWithRange(false, false, $keyword)
            ];

            return view('user/produk/search', $data);
        }
    }
}
