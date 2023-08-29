<?php

namespace App\Controllers;

class Home extends BaseController
{
    // test role 
    public function dashboard(): string
    {
        $data = [
            'title' => 'Ssayomart'
        ];
        return view('dashboard/home', $data);
    }
    public function admin(): string
    {
        return "admin";
    }
}
