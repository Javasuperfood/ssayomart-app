<?php

namespace App\Controllers;

class Input extends BaseController
{
    public function input()
    {
        $data = [
            'title' => 'Input'
        ];
        return view('/dashboard/input', $data);
    }

    public function edit()
    {
        $data = [
            'title' => 'menambahkan data produk'
        ];
        return view('dashboard/edit', $data);
    }

    public function save()
    {
        dd($this->request->getVar());
    }
}
