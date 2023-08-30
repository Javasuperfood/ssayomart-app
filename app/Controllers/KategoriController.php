<?php

namespace App\Controllers;

use App\Models\KategoriModel;

use App\Controllers\BaseController;

class KategoriController extends BaseController
{
    public function index(): string
    {
        $kategori = new KategoriModel();
        $data = [
            'title' => 'Ssayomart',
            'kategori' => $kategori->findAll()
        ];
        // dd($data);
        return view('user/home/Kategori', $data);
    }

   
}
