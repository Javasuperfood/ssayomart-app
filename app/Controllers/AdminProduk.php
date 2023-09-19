<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\VariasiModel;
use App\Models\KategoriModel;
use App\Models\SubKategoriModel;
use App\Controllers\BaseController;
use App\Models\VariasiItemModel;

class AdminProduk extends BaseController
{
    protected $imageModel;
    public function produk($id)
    {
        $produkModel = new ProdukModel();
        $kategoriModel = new KategoriModel();

        // Ambil semua produk
        $produk_list = $produkModel->findAll();

        // Ambil semua kategori (sesuaikan dengan model dan metode yang sesuai)
        $kategori_list = $kategoriModel->findAll();

        // Kirim data produk dan kategori ke tampilan
        $data = [
            'title' => 'Daftar Produk',
            'produk_Model' => $produk_list,
            'kategori_model' => $kategori_list,
        ];
    }


    public function tambahProduk()
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
            'title' => 'produk',
            'produk_Model' => $produk_list,
            'kategori' => $kategori_list,
            'subKategori' => $sub_kategori_list,
            'variasi' => $variasList,
            'variasiItem' => $variasiItemList
        ];
        // dd($data);
        return view('dashboard/produk/tambahProduk', $data);
    }
    // save produk
    public function save()
    {
        // ambil gambar
        // dd($this->request->getVar());
        $produkModel = new ProdukModel();
        $variasItemiModel = new VariasiItemModel();
        $fotoProduk = $this->request->getFile('img');
        if ($fotoProduk->getError() == 4) {
            $namaProduk = 'default.png';
        } else {
            $namaProduk = $fotoProduk->getRandomName();
            $fotoProduk->move('assets/img/produk/main/', $namaProduk);
        }
        $slug = url_title($this->request->getVar('nama'), '-', true);

        $data = [
            'slug' => $slug,
            'nama' => $this->request->getVar('nama'),
            'sku' => $this->request->getVar('sku'),
            'harga' => $this->request->getVar('harga'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'img' => $namaProduk,
            'id_kategori' => $this->request->getVar('parent_kategori_id'),
            'id_sub_kategori' => $this->request->getVar('sub_kategori')
        ];
        $produk = $produkModel->insert($data);
        $data2 = [
            'id_variasi' => $this->request->getVar('selectVariant'),
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

            return redirect()->to('dashboard/produk/tambah-produk')->withInput();
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/produk/tambah-produk')->withInput();
        }
    }
    // Update Produk
    public function updateProduk($id)
    {
        session();

        $produkModel = new ProdukModel();

        $km = $produkModel->find($id);
        $data = [
            'title' => 'Edit Produk',
            'km' => $km,
            'back'  => 'dashboard/tambah-produk'
        ];
        return view('dashboard/produk/updateProduk', $data);
    }
    public function editProduk($id)
    {
        $produkModel = new ProdukModel();
        $image = $this->request->getFile('img');

        if ($image->getError() == 4) {
            $namaProdukImage = $this->request->getVar('imageLama');
        } else {
            $produk = $produkModel->find($id);

            if ($produk['img'] == 'default.png') {
                $namaProdukImage = $image->getRandomName();
                $image->move('assets/img/produk/main', $namaProdukImage);
            } else {
                $namaProdukImage = $image->getRandomName();
                $image->move('assets/img/produk/main', $namaProdukImage);
                $gambarLamaPath = 'assets/img/produk/main/' . $this->request->getVar('imageLama');
                if (file_exists($gambarLamaPath)) {
                    unlink($gambarLamaPath);
                }
            }
        }
        $data = [
            'id_produk' => $id,
            'nama' => $this->request->getVar('nama'),
            'sku' => $this->request->getVar('sku'),
            'harga' => $this->request->getVar('harga'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'img' => $namaProdukImage
        ];
        // dd($data);
        if ($produkModel->save($data)) {
            session()->setFlashdata('success', 'Produk berhasil diubah.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Produk berhasil diubah.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/produk/tambah-produk');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/produk/tambah-produk/update-produk/' . $id)->withInput();
        }
    }

    // delete
    public function deleteProduk($id)
    {
        $produkModel = new ProdukModel();
        $produk = $produkModel->find($id);

        if ($produk['img'] != 'default.png') {
            $gambarLamaPath = 'assets/img/produk/main/' . $produk['img'];
            if (file_exists($gambarLamaPath)) {
                unlink($gambarLamaPath);
            }
        }
        $deleted = $produkModel->delete($id);
        // dd($id);
        if ($deleted) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Produk berhasil di hapus.'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/produk/tambah-produk');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada penghapusan produk'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/produk/tambah-produk')->withInput();
        }
    }
}
