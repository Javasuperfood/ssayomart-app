<?php

namespace App\Controllers;

use App\Models\KategoriModel;

use App\Controllers\BaseController;
use App\Models\BannerModel;

class KategoriController extends BaseController
{
    public function index(): string
    {
        $kategori = new KategoriModel();
        $banner = new BannerModel();
        $data = [
            'title' => 'Ssayomart',
            'kategori' => $kategori->findAll(),
            'banner' => $banner->find()
        ];
        // dd($data);
        return view('user/home/Kategori', $data);
    }
}
