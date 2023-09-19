<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\VariasiItemModel;
use App\Models\VariasiModel;

class AdminVariasiController extends BaseController
{
    public function index()
    {
        $variasiModel = new VariasiModel();
    }
    // Variasi Produk
    public function tambahVariasi()
    {
        $variasiModel = new VariasiModel();
        $variasiList = $variasiModel->findAll();
        $data = [
            'variasi' => $variasiList
        ];
        // dd($data);
        return view('dashboard/produk/tambahVariasi', $data);
    }
    // save
    public function saveVariasi()
    {
        // ambil gambar
        $variasiModel = new VariasiModel();

        $data = [
            'nama_varian' => $this->request->getVar('nama_varian'),
        ];

        // swet alert
        if ($variasiModel->save($data)) {
            session()->setFlashdata('success', 'Variasi produk berhasil disimpan.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Variasi Produk berhasil disimpan.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/produk/tambah-variasi')->withInput();
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/produk/tambah-variasi')->withInput();
        }
    }

    public function detail($slug)
    {
        $produkModel = new ProdukModel();
        $variasiModel = new VariasiModel();
        $variasiItemModel = new VariasiItemModel();
        $produk = $produkModel->getProduk($slug);
        $variasi = $variasiModel->findAll();
        $varianList = $variasiItemModel->getByIdProduk($produk['id_produk']);
        // dd($varianList);
        $data = [
            'produk' => $produk,
            'variasi' => $variasi,
            'varian' => $varianList
        ];
        // dd($data);
        return view('dashboard/produk/detailPorduk', $data);
    }

    public function saveVarianItem()
    {
        $variasiItemModel = new VariasiItemModel();
        $data = [
            'id_variasi' => $this->request->getVar('id_variant') || $this->request->getVar('selectVariant'),
            'id_produk' => $this->request->getVar('id_produk'),
            'value_item' => $this->request->getVar('valueItem'),
            'harga_item' => $this->request->getVar('harga'),
            'berat' => $this->request->getVar('berat'),
        ];
        if (!$variasiItemModel->save($data)) {
            return "Gagal";
        }
        return redirect()->to(base_url('dashboard/produk/detail-varian/' . $this->request->getVar('slug')));
    }

    public function deleteVarianItem($id)
    {
        $variasiItemModel = new VariasiItemModel();
        if (!$variasiItemModel->delete($id)) {
            return 'Gagal';
        }
        return redirect()->to(base_url('dashboard/produk/detail-varian/' . $this->request->getVar('slug')));
    }
}
