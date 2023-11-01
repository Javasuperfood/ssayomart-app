<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use App\Models\SubKategoriModel;
use App\Models\ProdukModel;
use App\Models\StockModel;
use App\Models\UsersModel;
use App\Models\VariasiItemModel;

class ProdukController extends BaseController
{
    public function index()
    {
        $kategori = new KategoriModel();
        $data = [
            'title' => 'Ssayomart',
            'kategori' => $kategori->findAll()
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

        $produkModel = new ProdukModel();
        if ($this->request->isAJAX()) {
            $page = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
            if (!$slug2) {
                $getProduk = $produkModel->getProductWithRange($katSub['id_kategori'], false, false, $page);
            }
            if ($slug1 && $slug2) {
                $getProduk = $produkModel->getProductWithRange($katSub['id_kategori'], $subSlug['id_sub_kategori'], false, $page);
            }

            // Kirim data dalam format JSON
            return $this->response->setJSON($getProduk);
        } else {

            if (!$slug2) {
                $getProduk = $produkModel->getProductWithRange($katSub['id_kategori'], false, false);
                // if ($getProduk[0]['id_kategori']==)
                // return redirect()->to(base_url('produk/kategori/' . $slug1 . '/' . ''));
            }
            if ($slug1 && $slug2) {
                $getProduk = $produkModel->getProductWithRange($katSub['id_kategori'], $subSlug['id_sub_kategori'], false);
            }

            $data = [
                'title' => $katSub['nama_kategori'],
                'kategori' => $kategori->findAll(),
                'kategori_single' => $kategori->findAll(),
                'produk' => $getProduk,
                'subKategori' => $subResult,
                'sk' => $slug2,
                'back' => '/' . '#ktr'
            ];
            // dd($data);
            return view('user/produk/index', $data);
        }
    }

    public function produkShowSingle($slug)
    {
        $kategoriModel = new KategoriModel();
        $subKategori = new SubKategoriModel();
        $produkModel = new ProdukModel();
        $varianModel = new VariasiItemModel();
        $varianModel = new VariasiItemModel();
        $userModel = new UsersModel();
        $stokModel = new StockModel();

        $produk = $produkModel->getProduk($slug);
        $varianItem = $varianModel->getByIdProduk($produk['id_produk']);
        if (auth()->loggedIn()) {
            $marketSelected = $userModel->find(user_id())['market_selected'];
            $stok = $stokModel->getStock($produk['id_produk'], $marketSelected);
            $data['stok'] = $stok;
        }

        $randomProducts = $produkModel->getRandomProducts();
        // Mengambil kategori berdasarkan id_produk
        $kategoriProduk = $kategoriModel->getKategoriByProdukId($produk['id_produk']);
        $subKategoriProduk = $subKategori->getSubKategoriByProdukId($produk['id_produk']);

        $data = [
            'title' => $produk['nama'],
            'kategori' => $kategoriModel->findAll(),
            'produk' => $produk,
            'varian' => $varianItem,
            'varianItem' => count($varianItem),
            'randomProducts' => $randomProducts,
            'kategoriProduk' => $kategoriProduk, // Menambahkan kategori produk
            'subKategoriProduk' => $subKategoriProduk, // Menambahkan kategori produk
        ];
        // dd($data);
        return view('user/produk/produk', $data);
    }



    public function search()
    {
        if ($this->request->isAJAX()) {
            $page = $this->request->getVar('page') ? $this->request->getVar('page') : 1;
            $keyword = $this->request->getVar('produk');

            $produkModel = new ProdukModel();
            $getProduk = $produkModel->getProductWithRange(false, false, $keyword, $page);

            // Kirim data dalam format JSON
            return $this->response->setJSON($getProduk);
        } else {
            $keyword = $this->request->getVar('produk');

            $kategori = new KategoriModel();
            $produkModel = new ProdukModel();
            $getProduk = $produkModel->getProductWithRange(false, false, $keyword);

            $data = [
                'title' => 'Hasil Pencarian',
                'produk' => $getProduk,
                'kategori' => $kategori->findAll(),
                'back' => ''
            ];

            return view('user/produk/search', $data);
        }
    }
}
