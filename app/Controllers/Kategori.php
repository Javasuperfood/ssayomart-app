<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Kategori extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new KategoriModel();
        $data['jsf_kategori'] = $model->orderBy('id_kategori', 'DESC')->findAll();
        // $response = [
        //     'status' => 200,
        //     'error' => null,
        //     'messages' => [
        //         'success' => 'Data berhasil di ditampilkan.'
        //     ],
        //     'kategori' => $data
        //];
        return $this->respond($data);
    }
    // Create Data
    public function create()
    {
        $model = new KategoriModel();
        $data = [
            'id_sub_kategori' => $this->request->getPost('id_sub_kategori'),
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'deskripsi_kategori' => $this->request->getPost('deskripsi_kategori')
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
        $model = new KategoriModel();
        $data = $model->where('id_kategori', $id)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data Kategori Tidak Ditemukan');
        }
    }
    //Update Data
    public function update($id = null)
    {
        $model = new KategoriModel();
        $data = [
            'id_sub_kategori' => $this->request->getVar('id_sub_kategori'),
            'nama_kategori' => $this->request->getVar('nama_kategori'),
            'deskripsi_kategori' => $this->request->getVar('deskripsi_kategori')
        ];
        $model->update($id, $data);
        $response = [
            'status'    => 200,
            'error'     => null,
            'messages'  => [
                'success' => 'Kategori berhasil di ubah'
            ]
        ];
        return $this->respond($response);
    }
    // Delete Data
    public function delete($id = null)
    {
        $model = new KategoriModel();
        $data = $model->find($id);
        if ($data) {
            if ($model->delete($id)) {
                $response = [
                    'status' => 200,
                    'error' => null,
                    'messages' => [
                        'success' => 'Kategori berhasil dihapus.'
                    ]
                ];
                return $this->respondDeleted($response);
            } else {
                $response = [
                    'status' => 500,
                    'error' => 'Delete Error',
                    'messages' => 'Gagal menghapus kategori.'
                ];
                return $this->respond($response, 500);
            }
        } else {
            return $this->failNotFound('Data Kategori Tidak Ditemukan');
        }
    }
}
