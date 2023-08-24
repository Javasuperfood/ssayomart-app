<?php

namespace App\Controllers;

class Wishlist extends BaseController
{
    public function wishlist(): string
    {
        $data = [
            'title' => 'Ssayomart'
        ];
        return view('user/wishlist/wishlist', $data);
    }
}
