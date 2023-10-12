<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class Blog extends BaseController
{
    public function index()
    {
        $kategori = new KategoriModel();

        $data = [
            'title' => 'Artikel',
            'kategori' => $kategori->findAll()
        ];
        return view('user/home/blog/blog', $data);
    }
}
