<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;



class BahasaApp extends BaseController
{
    // ===================================================================
    // ------------------------ bahasaa ------------------------------
    // ===================================================================
    public function bahasa()
    {
        $kategori = new KategoriModel();
        $data = [
            'title' => 'Pilih Bahasa Anda',
            'kategori' => $kategori->findAll(),
        ];
        // dd($data);
        return view('user/home/bahasa/bahasa', $data);
    }
}
