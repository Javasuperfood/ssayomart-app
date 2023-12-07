<?php

namespace App\Controllers;

use App\Models\SubKategoriModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class SubKategori extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new SubKategoriModel();
        $data['jsf_kategori'] = $model->orderBy('id_kategori', 'DESC')->findAll();
        return $this->respond($data);
    }
    // Create Data
    public function create()
    {
        $model = new SubKategoriModel();
        $data = [
            'id_kategori' => $this->request->getPost('id_kategori'),
            'nama_sub_kategori' => $this->request->getPost('nama_sub_kategori'),
            'deskripsi_sub_kategori' => $this->request->getPost('deskripsi_sub_kategori')
        ];

        if ($model->insert($data)) {
            $response = [
                'status' => 201,
                'error' => null,
                'messages' => [
                    'success' => 'Data berhasil disimpan.'
                ]
            ];
            return $this->respondCreated($response);
        } else {
            $response = [
                'status' => 400,
                'error' => 'Validation Error',
                'messages' => $model->errors()
            ];
            return $this->respond($response, 400);
        }
    }

    //Show Data
    public function show($id = null)
    {
        $model = new SubKategoriModel();
        $data = $model->where('id_sub_kategori', $id)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Sub Kategori Tidak Ditemukan');
        }
    }
    //Update Data
    public function update($id = null)
    {
        $model = new SubKategoriModel();
        $data = [
            'id_kategori' => $this->request->getVar('id_kategori'),
            'nama_sub_kategori' => $this->request->getVar('nama_sub_kategori'),
            'deskripsi_sub_kategori' => $this->request->getVar('deskripsi_sub_kategori')
        ];
        $model->update($id, $data);
        $response = [
            'status'    => 200,
            'error'     => null,
            'messages'  => [
                'success' => 'Sub Kategori berhasil di ubah'
            ]
        ];
        return $this->respond($response);
    }
    // Delete Data
    public function delete($id = null)
    {
        $model = new SubKategoriModel();
        $data = $model->find($id);
        if ($data) {
            if ($model->delete($id)) {
                $response = [
                    'status' => 200,
                    'error' => null,
                    'messages' => [
                        'success' => 'Sub Kategori berhasil dihapus.'
                    ]
                ];
                return $this->respondDeleted($response);
            } else {
                $response = [
                    'status' => 500,
                    'error' => 'Delete Error',
                    'messages' => 'Gagal menghapus sub kategori.'
                ];
                return $this->respond($response, 500);
            }
        } else {
            return $this->failNotFound('Data Sub Kategori Tidak Ditemukan');
        }
    }
}
