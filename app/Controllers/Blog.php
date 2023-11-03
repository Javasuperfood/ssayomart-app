<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\BlogModel;
use App\Models\UsersModel;
use App\Models\ProdukModel;

use App\Helpers\YoutubeHelper;

class Blog extends BaseController
{
    // ===================================================================
    // ------------------------ KONTEN BANNER ------------------------------
    // ===================================================================
    public function contenBanner()
    {

        $data = [
            'title' => 'conten Banner',
        ];
        // dd($data);
        return view('user/home/contenBanner/contenBanner', $data);
    }

    // ===================================================================
    // ------------------------ END KONTEN BANNER ----------------------------
    // ===================================================================

    public function index($id)
    {
        // Memuat helper YouTube
        helper('youtube');

        $kategori = new KategoriModel();
        $blogModel = new BlogModel();
        $userModel = new UsersModel();
        $produkModel = new ProdukModel();

        // Ambil semua data artikel dari database
        $allBlogs = $blogModel->getAllBlog();
        $blog_detail = $blogModel->getBlogDetail($id);

        // Acak urutan artikel
        shuffle($allBlogs);

        // Menggunakan fungsi dari helper untuk menanamkan video
        $videoEmbedCode = YoutubeHelper::embedYouTubeVideo($blog_detail['link_video']);


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
            'randomBlogs' => $allBlogs,
            'videoEmbedCode' => $videoEmbedCode
        ];

        return view('user/home/blog/blog', $data);
    }
}
