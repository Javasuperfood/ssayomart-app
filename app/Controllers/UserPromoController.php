<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\PromoModel;
use App\Models\PromoProduk;

class UserPromoController extends BaseController
{
    // public function index($slug)
    // {
    //     $kategori = new KategoriModel();
    //     $promoItemModel = new PromoItemModel();
    //     $promoModel = new PromoModel();
    //     $now = date('Y-m-d H:i:s');
    //     $promo = $promoModel->getPromo($now);

    //     $promoItem = $promoItemModel->getPromo($slug);
    //     if ($promoItem) {
    //         $filteredPromoItems = [];

    //         foreach ($promoItem as $item) {
    //             $idPromoProduk = $item['id_promo'];

    //             $idPromoKategoriCocok = false;
    //             foreach ($promo as $kategoriItem) {
    //                 if ($kategoriItem['id_promo'] === $idPromoProduk) {
    //                     $idPromoKategoriCocok = true;
    //                     break;
    //                 }
    //             }
    //             if ($idPromoKategoriCocok) {
    //                 $filteredPromoItems[] = $item;
    //             }
    //         }
    //         $promoItem = $filteredPromoItems;
    //     }
    //     // dd($promoItem);

    //     $title = (!$promoItem) ? 'Promo' : $promoItem[0]['title'];

    //     $data = [
    //         'title' => $title,
    //         'produk' => $promoItem,
    //         'kategori_promo' => $promo,
    //         'kategori' => $kategori->findAll(),
    //         'back' => ''
    //     ];
    //     // dd($data);
    //     return view('user/promo/promo', $data);
    // }

    public function index($slug)
    {
        $kategori = new KategoriModel();
        $promoProduk = new PromoProduk();
        $promoModel = new PromoModel();
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
}
