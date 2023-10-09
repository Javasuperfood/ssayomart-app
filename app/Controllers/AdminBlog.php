<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminBlog extends BaseController
{
    public function blog()
    {
        // Load view blog.php
        return view('dashboard/blog/blog');
    }

    public function tambahKonten()
    {
        // Load view tambahKonten
        return view('dashboard/blog/tambahKonten');
    }
}
