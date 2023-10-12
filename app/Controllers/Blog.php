<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\BlogModel;
use App\Models\UsersModel;

class Blog extends BaseController
{
    public function index($id)
    {
        $kategori = new KategoriModel();
        $blogModel = new BlogModel();
        $userModel = new UsersModel();
        $blog_detail = $blogModel->getBlogDetail($id);
        $user_info = $userModel->getUserInfo($blog_detail['created_by']);

        $data = [
            'title' => 'Artikel',
            'kategori' => $kategori->findAll(),
            'blog_detail' => $blog_detail,
            'user_info' => $user_info // Tambahkan data user_info
        ];
        return view('user/home/blog/blog', $data);
    }
}
