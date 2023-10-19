<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\BlogModel;
use App\Models\UsersModel;
use App\Models\ProdukModel;

class Blog extends BaseController
{
    public function index($id)
    {
        $kategori = new KategoriModel();
        $blogModel = new BlogModel();
        $userModel = new UsersModel();
        $produkModel = new ProdukModel();

        // Ambil semua data artikel dari database
        $allBlogs = $blogModel->getAllBlog();

        // Acak urutan artikel
        shuffle($allBlogs);

        // Ambil artikel detail yang dipilih
        $blog_detail = $blogModel->getBlogDetail($id);
        $user_info = $userModel->getUserInfo($blog_detail['created_by']);

        //Ambil data produk random untuk di looping
        $randomProducts = $produkModel->getRandomProducts();

        $data = [
            'title' => '오늘 이 요리 어때요? / SARAN MASAK',
            'kategori' => $kategori->findAll(),
            'blog_detail' => $blog_detail,
            'user_info' => $user_info,
            'randomProducts' => $randomProducts,
            'randomBlogs' => $allBlogs
        ];

        return view('user/home/blog/blog', $data);
    }
}
