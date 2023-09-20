<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\SubKategoriModel;
use App\Models\ProdukModel;


class ProdukController extends BaseController
{
    public function index()
    {
        $kategori = new KategoriModel();
        $data = [
            'title' => 'Ssayomart',
            'kategori' => $kategori->findAll(),
            'nama_produk' => 'Nori',
            'deskripsi_produk' => 'Nori adalah makanan khas korea dan jepang yang dikeringkan dan dioleh menjadi makanan yang sangat lezat dan cocok untuk menemani makan ataupun untuk menjadi camilan',
            'harga_produk'  => 'Rp. 25.000'
        ];
        return view('user/produk/index', $data);
    }

    public function getProduk($slug1, $slug2)
    {
        $kategori = new KategoriModel();
        $katSub = $kategori->getKategori($slug1);
        $subKategori = new SubKategoriModel();
        $subResult = $subKategori->select('jsf_kategori.slug as slugK, jsf_sub_kategori.slug as slugS , jsf_sub_kategori.nama_kategori')
            ->join('jsf_kategori', 'jsf_kategori.id_kategori = jsf_sub_kategori.id_kategori', 'inner')
            ->where('jsf_sub_kategori.id_kategori', $katSub['id_kategori'])->findAll();
        $subSlug = $subKategori->getSubKategori($slug2);
        $produk = new ProdukModel();
        if (!$slug2) {
            $getProduk = $produk->where('id_kategori', $katSub['id_kategori'])->findAll();
        }
        if ($slug1 && $slug2) {
            $getProduk = $produk->where('id_kategori', $katSub['id_kategori'])->where('id_sub_kategori', $subSlug['id_sub_kategori'])->findAll();
        }

        $data = [
            'title' => $katSub['nama_kategori'],
            'kategori' => $kategori->findAll(),
            'kategori_single' => $kategori->findAll(),
            'produk' => $getProduk,
            'subKategori' => $subResult,
            'back' => ''
        ];
        // dd($data);
        return view('user/produk/index', $data);
    }

    public function produkShowSingle($slug)
    {
        $kategori = new KategoriModel();
        $produk = new ProdukModel();
        $single = $produk->getProduk($slug);

        $randomProducts = $produk->getRandomProducts();
        $data = [
            'title' => $single['nama'],
            'kategori' => $kategori->findAll(),
            'produk' => $single,
            'randomProducts' => $randomProducts, // Kirim produk-produk acak ke view.
        ];
        // dd($data);
        return view('user/produk/produk', $data);
    }
    public function search()
    {
        $keyword = $this->request->getVar('produk');

        $kategori = new KategoriModel();
        $produk = new ProdukModel();
        $getProduk = $produk->like('nama', $keyword)->findAll();
        $data = [
            'title' => 'Hasil Pencarian',
            'produk' => $getProduk,
            'kategori' => $kategori->findAll(),
            'back' => ''
        ];
        return view('user/produk/search', $data);
    }
}
