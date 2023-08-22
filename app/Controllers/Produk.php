<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProdukModel;

class produk extends ResourceController
{
    use ResponseTrait;
    // all produk
    public function index()
    {
        $model = new ProdukModel();
        $data 
        = $model->orderBy('id_produk', 'DESC')->findAll();
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data produk berhasil diambil.'
            ],
            'produk' => $data
        ];
        return $this->respond($response, 200);
    }
    // create
    public function create()
    {
        $model = new ProdukModel();
        $data = [
            'id_kategori' => $this->request->getVar('id_kategori'),
            'nama_produk'  => $this->request->getVar('nama_produk'),
            'harga_produk'  => $this->request->getVar('harga_produk'),
            'deskripsi_produk'  => $this->request->getVar('deskripsi_produk'),
            'stock_produk'  => $this->request->getVar('stock_produk'),
            'gambar_produk'  => $this->request->getVar('gambar_produk'),
            'created_by'  => $this->request->getVar('created_by'),
        ];
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data produk berhasil ditambahkan.'
            ],
            'data' => $data
        ];
         
        return $this->respondCreated($response, 201);
    }
    // single produk
    public function show($id = null)
    {
        $model = new ProdukModel();
        $data = $model->where('id_produk', $id)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }
    // update
    public function update($id = null)
    {
        $model = new ProdukModel();
        $data = [
            'id_kategori' => $this->request->getVar('id_kategori'),
            'nama_produk'  => $this->request->getVar('nama_produk'),
            'harga_produk'  => $this->request->getVar('harga_produk'),
            'deskripsi_produk'  => $this->request->getVar('deskripsi_produk'),
            'stock_produk'  => $this->request->getVar('stock_produk'),
            'gambar_produk'  => $this->request->getVar('gambar_produk'),
            'created_by'  => $this->request->getVar('created_by'),
        ];
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data produk berhasil diubah.'
            ],
            'produk' => $data
        ];
        return $this->respond($response);
    }
    // delete
    public function delete($id = null)
    {
        $model = new ProdukModel();
        $data = $model->where('id_produk', $id)->delete($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data produk berhasil dihapus.'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }
}
