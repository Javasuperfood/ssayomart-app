<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class FetchingKategoriNavbar extends BaseController
{
    public function index()
    {
        $kategoriModel = new KategoriModel();

        $data['kategori'] = $kategoriModel->findAll();

        return view('user/home/component/navbarTop', $data);
    }
}
