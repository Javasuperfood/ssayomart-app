<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;



class MenuResto extends BaseController
{
    // ===================================================================
    // ------------------------ SAYO RESTO ------------------------------
    // ===================================================================
    public function sayoResto()
    {
        $kategori = new KategoriModel();
        $data = [
            'title' => 'Ssayoresto',
            'kategori' => $kategori->findAll(),
        ];
        // dd($data);
        return view('user/home/menuResto/sayoResto', $data);
    }

    // ===================================================================
    // ------------------------ END SAYO RESTO ----------------------------
    // ===================================================================


    // ===================================================================
    // ------------------------ MENU RESTO ------------------------------
    // ===================================================================
    public function menuResto()
    {
        $kategori = new KategoriModel();
        $data = [
            'title' => 'Menu Ssayoresto',
            'kategori' => $kategori->findAll(),
        ];

        return view('user/home/menuResto/menuResto', $data);
    }
    // ===================================================================
    // ------------------------END MENU RESTO ------------------------------
    // ===================================================================
}
