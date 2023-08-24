<?php

namespace App\Controllers;

class Wishlist extends BaseController
{
    public function wishlist(): string
    {
        $data = [
            'title' => 'Wishlist'
        ];
        return view('user/home/wishlist/wishlist', $data);
    }
}
