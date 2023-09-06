<?php

namespace App\Controllers;

use App\Models\ProdukModel;


class AdminProduk extends BaseController
{
    protected $imageModel;
    public function input()
    {
        $produkModel = new ProdukModel();
        $produk_list = $produkModel->findAll();

        $data = [
            'title' => 'Input',
            'produk_Model' => $produk_list
        ];
        return view('dashboard/input', $data);
    }

    public function tambahProduk()
    {
        $produkModel = new ProdukModel();
        $produk_list = $produkModel->findAll();
        $data = [
            'title' => 'produk',
            'produk_Model' => $produk_list
        ];
        return view('dashboard/tambahProduk', $data);
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
        return view('dashboard/updateProduk', $data);
    }
    // action
    public function editProduk($id)
    {
        $produkModel = new ProdukModel();
        $image = $this->request->getFile('gambar_produk');

        if ($image->getError() == 4) {
            $namaProdukImage = $this->request->getVar('imageLama');
        } else {
            $produk = $produkModel->find($id);
            if ($produk['img'] != 'default.png' || $image->getError() == 4) {
                $namaProdukImage = $image->getRandomName();
                $image->move('assets/img/produk/main', $namaProdukImage);
            } else {
                $namaProdukImage = $image->getRandomName();
                $image->move('assets/img/produk/main', $namaProdukImage);
                unlink('assets/img/produk/main/' . $this->request->getVar('imageLama'));
            }
        }
        $slug = url_title($this->request->getVar('nama_produk'), '-', true);
        $data = [
            'slug' => $slug,
            'id_produk' => $id,
            'img' => $namaProdukImage,
            'nama' => $this->request->getVar('nama_produk'),
            'harga' => $this->request->getVar('harga_produk'),
            'deskripsi' => $this->request->getVar('deskripsi_produk'),
            'stok' => $this->request->getVar('stock_produk'),
        ];


        if ($produkModel->save($data)) {
            session()->setFlashdata('success', 'Produk berhasil diubah.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data Produk berhasil diubah.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/tambah-produk');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/tambah-produk/update-produk/' . $id)->withInput();
        }
    }
    // save
    public function save()
    {
        // ambil gambar
        $fotoProduk = $this->request->getFile('gambar_produk');
        if ($fotoProduk->getError() == 4) {
            # code...
            $namaProduk = 'default.png';
        } else {
            $namaProduk = $fotoProduk->getRandomName();
            $fotoProduk->move('assets/img/produk/main/', $namaProduk);
        }
        // dd($this->request->getVar());
        $produkModel = new ProdukModel();
        $slug = url_title($this->request->getVar('nama_produk'), '-', true);
        $data = [
            'slug' => $slug,
            'nama' => $this->request->getVar('nama_produk'),
            'sku' => $this->request->getVar('sku'),
            'harga' => $this->request->getVar('harga_produk'),
            'deskripsi' => $this->request->getVar('deskripsi_produk'),
            'stok' => $this->request->getVar('stock_produk'),
            'img' => $namaProduk,
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

            return redirect()->to('dashboard/tambah-produk');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/tambah-produk')->withInput();
        }
    }
    // delete
    public function deleteProduk($id)
    {
        $produkModel = new ProdukModel();
        $deleted = $produkModel->delete($id);
        // dd($id);
        if ($deleted) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Produk berhasil di hapus.'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/tambah-produk');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada penghapusan produk'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/tambah-produk')->withInput();
        }
    }
}
