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

        // dd($this->request->getVar());
        $produkModel = new ProdukModel();
        $slug = url_title($this->request->getVar('nama_produk'), '-', true);
        $data = [
            'slug' => $slug,
            'nama' => $this->request->getVar('nama_produk'),
            'harga' => $this->request->getVar('harga_produk'),
            'deskripsi' => $this->request->getVar('deskripsi_produk'),
            'stok' => $this->request->getVar('stock_produk'),
            'img' => $this->request->getVar('gambar'),
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
}
