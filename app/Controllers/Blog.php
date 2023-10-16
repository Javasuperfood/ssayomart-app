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

        // Ambil semua data artikel dari database
        $allBlogs = $blogModel->getAllBlog();

        // Acak urutan artikel
        shuffle($allBlogs);

        // Ambil artikel detail yang dipilih
        $blog_detail = $blogModel->getBlogDetail($id);
        $user_info = $userModel->getUserInfo($blog_detail['created_by']);

        $data = [
            'title' => 'Artikel',
            'kategori' => $kategori->findAll(),
            'blog_detail' => $blog_detail,
            'user_info' => $user_info,
            'randomBlogs' => $allBlogs // Tambahkan data artikel yang diacak
        ];

        return view('user/home/blog/blog', $data);
    }
}
