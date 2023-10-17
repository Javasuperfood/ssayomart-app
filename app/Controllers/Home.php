<?php

namespace App\Controllers;

class Home extends BaseController
{
    // test role 
    public function dashboard()
    {
        if (auth()->user()->inGroup('admin')) {
            return redirect()->to(base_url('dashboard/order'));
        }
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
