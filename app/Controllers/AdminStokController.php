<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminTokoModel;
use App\Models\ProdukModel;
use App\Models\StockModel;
use App\Models\TokoModel;
use App\Models\VariasiItemModel;

class AdminStokController extends BaseController
{
    // Views
    public function updateStock($slug)
    {
        $produkModel = new ProdukModel();
        $adminTokoModel = new AdminTokoModel();
        $variasiItemModel = new VariasiItemModel();
        $stokModel = new StockModel();

        $produk = $produkModel->getProduk($slug);
        $adminToko = $adminTokoModel->getAdminToko(user_id());
        $variasiItemList = $variasiItemModel->getByIdProduk($produk['id_produk'], $adminToko[0]['id_toko']);
        $stok = $stokModel->getStock($produk['id_produk'], $adminToko[0]['id_toko']);
        $data = [
            'produk' => $produk,
            'market' => $adminToko,
            'variasi' => $variasiItemList,
            'stock' => $stok
        ];
        // dd($data);
        return view('dashboard/stock/updateStock', $data);
    }

    //Methods
    public function storeUpdateStok()
    {
        // dd($this->request->getVar());
        $stokModel = new StockModel();
        $id_produk = $this->request->getvar('produk');
        $id_variasi_item = $this->request->getVar('variasi_item');
        $id_toko = $this->request->getVar('market');
        $id_stok = $this->request->getVar('id_stok');
        $stok = $this->request->getVar('stok');
        $idUpdate = null;
        if (empty($id_stok)) {
            $id_stok = [];
        }
        foreach ($id_stok as $id) {
            $stoklist = $stokModel->where('id_stock', $id)->first();
            if ($stoklist['id_toko'] == $id_toko && $stoklist['id_variasi_item'] == $id_variasi_item && $stoklist['id_produk'] == $id_produk) {
                $idUpdate = $id;
            }
        }

        $data = [
            'id_stock' => $idUpdate,
            'id_produk' => $id_produk,
            'id_variasi_item' => $id_variasi_item,
            'id_toko' => $id_toko,
            'stok' => $stok,
            'update_by' => user_id()
        ];
        if (!$this->validateData($data, [
            'id_produk' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ID Produk harus diisi'
                ]
            ],
            'id_variasi_item' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ID Variasi harus diisi'
                ]
            ],
            'id_toko' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'ID Market harus diisi'
                ]
            ],
            'stok' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Stok harus diisi'
                ]
            ]
        ])) {
            $alert = [
                'type' => 'danger',
                'title' => 'Gagal',
                'message' => 'Data gagal diupdate'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to(base_url('dashboard/update-stok/' . $this->request->getVar('slug')))->withInput();
        }
        if ($stokModel->save($data)) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Stok produk berhasil diupdate'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to(base_url('dashboard/update-stok/' . $this->request->getVar('slug')));
        }
    }
}
