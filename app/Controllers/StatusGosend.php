<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;



class StatusGosend extends BaseController
{
    public function statusGosend()
    {
        $kategori = new KategoriModel();
        $data = [
            'title' => 'status Gosend',
            'kategori' => $kategori->findAll(),
        ];

        return view('user/home/statusGosend/statusGosend', $data);
    }
}
