<?php

namespace App\Controllers;

class Cart extends BaseController
{
    public function cart(): string
    {
        $data = [
            'title' => 'Cart'
        ];
        return view('user/home/cart/cart', $data);
    }
}
