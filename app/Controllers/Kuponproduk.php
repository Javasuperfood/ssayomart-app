<?php

namespace App\Controllers;

class Kuponproduk extends BaseController
{
    public function kupon(): string
    {
        $data = [
            'title' => 'Kuponproduk'
        ];
        return view('/dashboard/kupon', $data);
    }
}
