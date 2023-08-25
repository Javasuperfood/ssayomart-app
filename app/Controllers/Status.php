<?php

namespace App\Controllers;

class Status extends BaseController
{
    public function status(): string
    {
        $data = [
            'title' => 'Status'
        ];
        return view('user/produk/status', $data);
    }
}
