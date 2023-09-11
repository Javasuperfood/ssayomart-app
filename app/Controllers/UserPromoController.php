<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\PromoItemModel;
use App\Models\PromoModel;

class UserPromoController extends BaseController
{
    public function index($slug)
    {
        $promoItemModel = new PromoItemModel();
        $promoModel = new PromoModel();
        $now = date('Y-m-d H:i:s');
        $promo = $promoModel->getPromo($now);

        $promoItem = $promoItemModel->getPromo($slug);
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

        $title = (!$promoItem) ? 'Promo' : $promoItem[0]['title'];

        $data = [
            'title' => $title,
            'produk' => $promoItem,
            'kategori' => $promo,
            'back' => ''
        ];

        return view('user/promo/promo', $data);
    }
}
