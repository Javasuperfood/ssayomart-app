<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PromoModel;
use App\Models\ProdukModel;
use App\Models\VariasiItemModel;
use App\Models\PromoProduk;
use App\Models\ProdukBundleModel;

class AdminPromoController extends BaseController
{
    // Promo
    public function index()
    {
        $promoModel = new PromoModel();
        $promoList = $promoModel->findAll();
        $data = [
            'promo' => $promoList
        ];
        return view('dashboard/promo/promo', $data);
    }

    // Tambah Promo
    public function tambahPromo()
    {
        $promoModel = new PromoModel();
        $produkModel = new ProdukModel();
        $variasiItemModel = new VariasiItemModel();

        $promoList = $promoModel->findAll();
        $variasiList = $variasiItemModel->findAll();

        $keywords = $this->request->getVar('search_product');
        if ($keywords) {
            $produkSearch = $produkModel->orderBy('id_produk', 'DESC')->adminProdukSearch2($keywords);
        } else {
            $produkSearch = $produkModel->orderBy('id_produk', 'DESC')->limit(10)->find();
        }

        $data = [
            'promo' => $promoList,
            'produkSearch' => $produkSearch,
            'variasi' => $variasiList
        ];
        // dd($data);
        return view('dashboard/promo/tambahPromo', $data);
    }

    // Save Promo
    public function savePromo()
    {
        // ambil gambar
        $promoModel = new PromoModel();
        $fotoPromo = $this->request->getFile('img');
        $fotoPromo2 = $this->request->getFile('img_2');
        $namaPromo2 = null;

        if ($fotoPromo->getError() == 4) {
            $namaPromo = 'default.png';
        } else {
            $namaPromo = $fotoPromo->getRandomName();
            $fotoPromo->move('assets/img/promo/', $namaPromo);
        }

        if ($fotoPromo2->getError() !== UPLOAD_ERR_NO_FILE) {
            // A file has been uploaded
            $namaPromo2 = $fotoPromo2->getRandomName();
            $fotoPromo2->move('assets/img/promo/', $namaPromo2);
        }

        $slug = url_title($this->request->getVar('title'), '-', true);
        $data = [
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'img' => $namaPromo,
            'img_2' => $namaPromo2,
            'start_at' => $this->request->getVar('started'),
            'end_at' => $this->request->getVar('ended'),
            'deskripsi' => $this->request->getVar('deskripsi')
        ];
        // dd($data);

        if ($promoModel->save($data)) {
            session()->setFlashdata('success', 'Promosi terbaru berhasil disimpan.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Promosi terbaru berhasil disimpan.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/promo')->withInput();
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/promo/tambah-promo')->withInput();
        }
    }

    // Delete
    public function deletePromo($id)
    {
        $promoModel = new PromoModel();
        $promoProdukModel = new PromoProduk();

        $promo = $promoModel->find($id);

        if ($promo['img'] != 'default.png') {
            $gambarLamaPath = 'assets/img/promo/' . $promo['img'];
            if (file_exists($gambarLamaPath)) {
                unlink($gambarLamaPath);
            }
        }

        if ($promo['img_2'] != 'default.png') {
            $gambarLamaPath = 'assets/img/promo/' . $promo['img_2'];
            if (is_file($gambarLamaPath) && file_exists($gambarLamaPath)) {
                unlink($gambarLamaPath);
            }
        }

        $promoProdukModel->where('id_promo', $id)->delete();

        $deleted = $promoModel->delete($id);
        if ($deleted) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data promo berhasil di hapus.'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/promo');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada penghapusan promo'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/promo')->withInput();
        }
    }

    // Update
    public function updatePromo($id)
    {
        $promoModel = new PromoModel();

        $promo = $promoModel->find($id);
        $data = [
            'title' => 'Edit Banner',
            'promo' => $promo,
            'back'  => 'dashboard/promo/tambah-promo'
        ];
        return view('dashboard/promo/updatePromo', $data);
    }

    // Update Action
    public function editPromo($id)
    {
        $promoModel = new PromoModel();
        $image = $this->request->getFile('img');
        $image2 = $this->request->getFile('img_2');
        $namaPromoImage2 = null;

        if ($image->getError() == 4) {
            $namaPromoImage = $this->request->getVar('imageLama');
        } else {
            $produk = $promoModel->find($id);

            if ($produk['img'] == 'default.jpg') {
                $namaPromoImage = $image->getRandomName();
                $image->move('assets/img/promo', $namaPromoImage);
            } else {
                $namaPromoImage = $image->getRandomName();
                $image->move('assets/img/promo', $namaPromoImage);
                $gambarLamaPath = 'assets/img/promo/' . $this->request->getVar('imageLama');
                if (file_exists($gambarLamaPath)) {
                    unlink($gambarLamaPath);
                }
            }
        }

        if ($image2->getError() !== UPLOAD_ERR_NO_FILE) {
            // A new file has been uploaded
            $namaPromoImage2 = $image2->getRandomName();
            $image2->move('assets/img/promo', $namaPromoImage2);

            // Remove the old file
            $gambarLamaPath = 'assets/img/promo/' . $this->request->getVar('imageLama2');
            if (is_file($gambarLamaPath)) { // Check if it's a file before unlinking
                unlink($gambarLamaPath);
            }
        } else {
            // No new file uploaded, keep the existing value
            $namaPromoImage2 = null;
        }

        $slug = url_title($this->request->getVar('title'), '-', true);
        $cekSlug = $promoModel->where('slug', $slug)->first();
        if ($cekSlug != null) {
            $slug = $slug;
        }

        $data = [
            'id_promo' => $id,
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'img' => $namaPromoImage,
            'img_2' => $namaPromoImage2,
            'start_at' => $this->request->getVar('started'),
            'end_at' => $this->request->getVar('ended'),
            'deskripsi' => $this->request->getVar('deskripsi')
        ];

        // dd($data);

        if ($promoModel->save($data)) {
            session()->setFlashdata('success', 'Gambar banner berhasil diubah.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data Promo berhasil diubah.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/promo')->withInput();
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/promo/update-promo/' . $id)->withInput();
        }
    }

    // ======================================================
    //             PROMO PRODUK & PROMO BUNDLE
    // ======================================================

    // Bundle Promo
    public function show($id)
    {
        $produkModel = new ProdukModel();
        $variasiItemModel = new VariasiItemModel();
        $promoProdukModel = new PromoProduk();
        $produkBundle = new ProdukBundleModel();

        $variasiList = $variasiItemModel->findAll();
        $promoProduk = $promoProdukModel->promoProduk($id);
        $produkBundleList = $produkBundle->getProdukBundle();

        $keyword = $this->request->getVar('search');
        if ($keyword) {
            $produk = $produkModel->orderBy('id_produk', 'DESC')->adminProdukSearch($keyword);
        } else {
            $produk = $produkModel->orderBy('id_produk', 'DESC')->limit(10)->find();
        }

        $data = [
            'produk' => $produk,
            'promoProduk' => $promoProduk,
            'produkBundle' => $produkBundleList,
            'variasi' => $variasiList
        ];
        // dd($data);
        return view('dashboard/promo/bundlePromo', $data);
    }

    public function getproductjson()
    {
        $produkModel = new ProdukModel();
        $data = $this->request->getVar();
        $keyword = $this->request->getVar('search');
        if ($keyword) {
            $produk = $produkModel->orderBy('id_produk', 'DESC')->where('deleted_at', null)->like('nama', '%' . $keyword . '%')->orLike('sku', '%' . $keyword . '%')->findAll();
        } else {
            $produk = $produkModel->orderBy('id_produk', 'DESC')->limit(10)->find();
        }
        return $this->response->setJSON([
            'request' => $data,
            'response' => $produk,

        ]);
    }

    // Save Promo Produk
    public function save()
    {
        $promoProdukModel = new PromoProduk();
        $selectedPromo = $this->request->getVar('id_promo');
        $selectedProduct = $this->request->getVar('id_produk');

        $data = [
            'id_promo' => $selectedPromo,
            'id_produk' => $selectedProduct
        ];
        // dd($data);

        if ($promoProdukModel->save($data)) {
            session()->setFlashdata('success', 'Promosi terbaru berhasil disimpan.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Promosi terbaru berhasil disimpan.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/promo/bundle-promo/' . $this->request->getVar('id_promo'))->withInput();
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/promo/tambah-promo')->withInput();
        }
    }

    // Save Produk Bundle
    public function saveProdukBundle()
    {
        $produkBundle = new ProdukBundleModel();
        $promoProdukId = $this->request->getVar('id_promo_produk');
        $produkId = $this->request->getVar('id_produk');
        $selectedProducts = $this->request->getVar('produk_id');
        $promoId = $this->request->getVar('id_promo');

        $batchData = [];

        foreach ($selectedProducts as $productId) {
            // Check if the record already exists
            $existingRecord = $produkBundle
                ->where('id_promo_produk', $promoProdukId)
                ->where('id_main_produk', $produkId)
                ->where('id_produk_bundle', $productId)
                ->first();

            if (!$existingRecord) {
                // Record doesn't exist, insert it
                $batchData[] = [
                    'id_promo_produk' => $promoProdukId,
                    'id_main_produk' => $produkId,
                    'id_produk_bundle' => $productId
                ];
            }
        }

        // Insert all the data at once
        if (!empty($batchData)) {
            $produkBundle->insertBatch($batchData);
        }
        // dd($batchData);

        session()->setFlashdata('success', 'Promosi terbaru berhasil disimpan.');
        $alert = [
            'type' => 'success',
            'title' => 'Berhasil',
            'message' => 'Promosi terbaru berhasil disimpan.'
        ];
        session()->setFlashdata('alert', $alert);

        return redirect()->to('dashboard/promo/bundle-promo/' . $promoId);
    }

    // Delete Promo Produk
    public function deletePromoProduk($id)
    {
        // dd($this->request->getVar());
        $promoProdukModel = new PromoProduk();
        $deleted = $promoProdukModel->delete($id);

        if ($deleted) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data promo berhasil di hapus.'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/promo/tambah-promo');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada penghapusan promo'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/promo/tambah-promo')->withInput();
        }
    }
}
