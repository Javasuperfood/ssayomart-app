<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'title' => 'Ssayomart'
        ];
        return view('user/home/index', $data);
    }
    public function setting(): string
    {
        $data = [
            'title' => 'setting',
            'name' => 'Kiki',
            'saldo' => 2000
        ];
        return view('user/home/setting', $data);
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
