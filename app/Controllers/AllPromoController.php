<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;



class AllPromoController extends BaseController
{
    // ===================================================================
    // ------------------------ All PROMO ------------------------------
    // ===================================================================
    public function allPromo()
    {
        $kategori = new KategoriModel();
        $data = [
            'title' => 'All Promo',
            'kategori' => $kategori->findAll(),
        ];
        // dd($data);
        return view('user/home/allpromo/allpromo', $data);
    }
}
