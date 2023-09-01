<?php

namespace App\Controllers;

use App\Models\ProdukModel;


class AdminProduk extends BaseController
{
    public function input()
    {
        $data = [
            'title' => 'Input'
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

    // save
    public function save()
    {
        // ambil gambar
        $fotoProduk = $this->request->getFile('gambar');
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
