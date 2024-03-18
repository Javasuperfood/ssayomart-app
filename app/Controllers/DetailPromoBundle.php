<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;



class DetailPromoBundle extends BaseController
{
    // ===================================================================
    // ------------------------ Detail Promo Bundle ------------------------------
    // ===================================================================
    public function detailPromoBundle()
    {
        $kategori = new KategoriModel();
        $data = [
            'title' => 'Nama Promo',
            'kategori' => $kategori->findAll(),
        ];
        // dd($data);
        return view('user/home/allpromo/detailPromoBundle', $data);
    }
}
