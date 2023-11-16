<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class MapsController extends BaseController
{
    public function maps()
    {
        $kategoriModel = new \App\Models\KategoriModel();
        $data = [
            'title' => 'Maps',
            'kategori' =>  $kategoriModel->findAll(),
        ];
        return view('maps', $data);
    }
}
