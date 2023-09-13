<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class FetchingKategoriNavbar extends BaseController
{
    public function navbarTop()
    {
        $kategoriModel = new KategoriModel();

        $data['kategori'] = $kategoriModel->findAll();

        return view('user/home/component/navbarTop', $data);
    }
    public function navbarMain()
    {
        $kategoriModel = new KategoriModel();

        $data['kategori'] = $kategoriModel->findAll();

        return view('user/home/component/navbarMain', $data);
    }
}
