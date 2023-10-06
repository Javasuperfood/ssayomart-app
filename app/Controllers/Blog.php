<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Blog extends BaseController
{
    public function index()
    {
        // Load view blog.php
        return view('user/home/blog/blog');
    }
}
