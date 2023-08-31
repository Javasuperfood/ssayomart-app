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

        $data = [
            'title' => 'menambahkan data produk'
        ];
        return view('dashboard/tambahProduk', $data);
    }

    public function save()
    {
        // dd($this->request->getVar());
        $produkModel = new ProdukModel();
        $slug = url_title($this->request->getVar('produk'), '-', true);
        $data = [
            'slug' => $slug,
            'nama_produk' => $this->request->getVar('produk'),
            'harga_produk' => $this->request->getVar('harga'),
            'deskripsi_produk' => $this->request->getVar('deskripsi'),
            'stock_produk' => $this->request->getVar('stock'),
            // 'gambar_produk' => $this->request->getVar('gambar'),
        ];
        // dd($data);
        $produkModel->save($data);
    }
}
