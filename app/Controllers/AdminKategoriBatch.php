<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\ProdukModel;
use App\Models\ProdukKategoriBatchModel;
use App\Models\VariasiModel;
use App\Models\KategoriModel;
use App\Models\SubKategoriModel;
use App\Models\VariasiItemModel;

class AdminKategoriBatch extends BaseController
{
    public function produkBatch()
    {
        $produkModel = new ProdukModel();
        $kategoriModel = new KategoriModel();
        $subKategoriModel = new SubKategoriModel();
        $variasiModel = new VariasiModel();
        $variasiItemModel = new VariasiItemModel();

        $variasList = $variasiModel->findAll();
        $variasiItemList = $variasiItemModel->getVariasiItem();
        $produk_list = $produkModel->findAll();
        $kategori_list = $kategoriModel->findAll();
        $sub_kategori_list = $subKategoriModel->findAll();
        $data = [
            'produk_Model' => $produk_list,
            'kategori' => $kategori_list,
            'subKategori' => $sub_kategori_list,
            'variasi' => $variasList,
            'variasiItem' => $variasiItemList,
            'vali' => $produkModel->errors()
        ];
        // dd($data);
        return view('dashboard/produk/kategoriProdukBatch', $data);
    }
    // save produk-kategori batch
    public function save()
    {
        $produkModel = new ProdukModel();
        $variasItemiModel = new VariasiItemModel();

        // Dapatkan kategori dan subkategori yang dipilih sebagai array
        $selectedCategories = $this->request->getVar('kategori_id');
        $selectedSubcategories = $this->request->getVar('sub_kategori_id');

        // Proses gambar produk
        $fotoProduk = $this->request->getFile('img');
        if ($fotoProduk->isValid() && !$fotoProduk->hasMoved()) {
            $namaProduk = $fotoProduk->getRandomName();
            $fotoProduk->move('assets/img/produk/main/', $namaProduk);
        } else {
            $namaProduk = 'default.png';
        }

        $slug = url_title($this->request->getVar('nama'), '-', true);
        $cekSlug = $produkModel->where('slug', $slug)->first();
        if ($cekSlug != null) {
            $slug = $slug . '-' . time();
        }

        // Simpan data produk
        $data = [
            'slug' => $slug,
            'nama' => $this->request->getVar('nama'),
            'sku' => $this->request->getVar('sku'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'img' => $namaProduk
        ];

        // dd($data);

        // Masukkan data produk
        $produkId = $produkModel->insert($data);

        // Simpan asosiasi kategori
        if (!empty($selectedCategories)) {
            foreach ($selectedCategories as $categoryId) {
                $produkModel->insertCategoryAssociation($produkId, $categoryId);
            }
        }

        // Simpan asosiasi subkategori
        if (!empty($selectedSubcategories)) {
            foreach ($selectedSubcategories as $subcategoryId) {
                $produkModel->insertSubcategoryAssociation($produkId, $subcategoryId);
            }
        }

        // Simpan data variasi item
        $id_varian = $this->request->getVar('selectVariant');
        if ($id_varian != '') {
            $id_varian = $id_varian;
        } else {
            $id_varian = null;
        }
        $data2 = [
            'id_variasi' => $id_varian,
            'value_item' => $this->request->getVar('valueItem'),
            'harga_item' => $this->request->getVar('harga'),
            'berat' => $this->request->getVar('berat'),
        ];

        // dd($data2);

        $ruleData = [
            'nama' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama produk wajib diisi.',
                ],
            ],
            'deskripsi'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Deskripsi wajib diisi.',
                ],
            ]
        ];
        if (!$this->validateData($data, $ruleData) || !$this->validateData($data2, $variasItemiModel->validationRules)) {
            return redirect()->to('dashboard/produk/produk-batch')->withInput();
        }

        $produk = $produkModel->insert($data);
        // if validate success replace data2
        $data2 = [
            'id_variasi' => $id_varian,
            'id_produk' => $produk,
            'value_item' => $this->request->getVar('valueItem'),
            'harga_item' => $this->request->getVar('harga'),
            'berat' => $this->request->getVar('berat'),
        ];

        $varian = $variasItemiModel->insert($data2);

        // swet alert
        if ($produk && $varian) {
            session()->setFlashdata('success', 'Produk berhasil disimpan.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Produk berhasil disimpan.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/produk');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/produk/produk-batch')->withInput();
        }
    }
}
