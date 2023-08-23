<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Ssayomart'
        ];
        return view('user/index', $data);
    }
    // test role 
    public function dashboard(): string
    {
        return "dashboard";
    }
    public function admin(): string
    {
        return "admin";
    }
}
