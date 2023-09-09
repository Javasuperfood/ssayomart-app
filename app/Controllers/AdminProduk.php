<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\ProdukModel;


class AdminProduk extends BaseController
{
    protected $imageModel;
    public function produk()
    {
        $produkModel = new ProdukModel();
        $produk_list = $produkModel->findAll();

        $data = [
            'title' => 'Input',
            'produk_Model' => $produk_list
        ];
        return view('dashboard/produk/produk', $data);
    }

    public function tambahProduk()
    {
        $produkModel = new ProdukModel();
        $produk_list = $produkModel->findAll();
        $data = [
            'title' => 'produk',
            'produk_Model' => $produk_list
        ];
        return view('dashboard/produk/tambahProduk', $data);
    }

    // view
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
    // action
    public function editProduk($id)
    {
        $produkModel = new ProdukModel();
        $image = $this->request->getFile('img');

        if ($image->getError() == 4) {
            $namaProdukModel = $this->request->getVar('imageLama');
        } else {
            $produk = $produkModel->find($id);

            if ($produk['img'] == 'default.jpg') {
                $namaProdukModel = $image->getRandomName();
                $image->move('assets/img/produk/main', $namaProdukModel);
            } else {
                $namaProdukModel = $image->getRandomName();
                $image->move('assets/img/produk/main', $namaProdukModel);
                $gambarLamaPath = 'assets/img/produk/main/' . $this->request->getVar('imageLama');
                if (file_exists($gambarLamaPath)) {
                    unlink($gambarLamaPath);
                }
            }
        }
        $slug = url_title($this->request->getVar('nama_produk'), '-', true);
        $data = [
            'id_produk' => $id,
            'img' => $namaProdukModel,
            'slug' => $slug,
            'nama' => $this->request->getVar('nama_produk'),
            'sku' => $this->request->getVar('sku'),
            'harga' => $this->request->getVar('harga_produk'),
            'deskripsi' => $this->request->getVar('deskripsi_produk'),
        ];

        if ($produkModel->save($data)) {
            session()->setFlashdata('success', 'Gambar produk berhasil diubah.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Gambar produk berhasil diubah.'
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

            return redirect()->to('dashboard/produk/tambah-produk/update/' . $id)->withInput();
        }
    }

    // save
    public function save()
    {
        // ambil gambar
        $produkModel = new ProdukModel();
        $fotoProduk = $this->request->getFile('img');
        if ($fotoProduk->getError() == 4) {
            $namaProduk = 'default.png';
        } else {
            $namaProduk = $fotoProduk->getRandomName();
            $fotoProduk->move('assets/img/produk/main/', $namaProduk);
        }
        $slug = url_title($this->request->getVar('nama_produk'), '-', true);
        $data = [
            'slug' => $slug,
            'nama' => $this->request->getVar('nama_produk'),
            'sku' => $this->request->getVar('sku'),
            'harga' => $this->request->getVar('harga_produk'),
            'deskripsi' => $this->request->getVar('deskripsi_produk'),
            // 'stok' => $this->request->getVar('stock_produk'),
            'img' => $namaProduk
        ];

        // swet alert
        if ($produkModel->save($data)) {
            session()->setFlashdata('success', 'Prroduk berhasil disimpan.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'produk berhasil disimpan.'
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
