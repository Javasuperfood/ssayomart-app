<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
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
