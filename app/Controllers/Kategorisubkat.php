<?php

namespace App\Controllers;

class Kategorisubkat extends BaseController
{
    public function kategorisubkat(): string
    {
        $data = [
            'title' => 'Kategorisubkat'
        ];
        return view('/dashboard/kategorisubkat', $data);
    }
}
