<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    // test role 
    public function admin(): string
    {
        if (! auth()->user()->can('admin.access')) {
            return 'You do not have permissions to access that page.';
        }
        return "admin";
    }
}
