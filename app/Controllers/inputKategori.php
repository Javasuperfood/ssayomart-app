<?php

namespace App\Controllers;

class Kategorisubkat extends BaseController
{
    public function inputKategori(): string
    {
        $data = [
            'title' => 'inputKategori'
        ];
        return view('/dashboard/inputKategori', $data);
    }
    public function save()
    {
        dd($this->request->getVar());
    }
}
