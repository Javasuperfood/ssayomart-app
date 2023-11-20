<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\BannerModel;

class BannerContentController extends BaseController
{
    public function contentBanner($id)
    {
        $kategori = new KategoriModel();
        $bannerModel = new BannerModel();
        $bannerList = $bannerModel->find($id);
        $data = [
            'title' => '돌아가기 / Kembali',
            'kategori' => $kategori->findAll(),
            'banner_list' => $bannerList
        ];
        // dd($data);
        return view('user/home/contentBanner/contentBanner', $data);
    }
}
