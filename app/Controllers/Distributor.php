<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DistributorModel;

class distributor extends ResourceController
{
    use ResponseTrait;
    // all distributor
    public function index()
    {
        $model = new DistributorModel();
        $data
            = $model->orderBy('id_distributor', 'DESC')->findAll();
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data distributor berhasil diambil.'
            ],
            'distributor' => $data
        ];
        return $this->respond($response, 200);
    }
    // create
    public function create()
    {
        $model = new DistributorModel();
        $data = [
            'id_user' => $this->request->getVar('id_user'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'alamat_distributor' => $this->request->getVar('alamat_distributor'),
        ];
        if ($model->insert($data)) {
            $response = [
                'status' => 201,
                'error' => null,
                'messages' => [
                    'success' => 'Data berhasil disimpan.'
                ],
                'distributor' => $data
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
    // single distributor
    public function show($id = null)
    {
        $model = new DistributorModel();
        $data = $model->where('id_distributor', $id)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }
    // update
    public function update($id = null)
    {
        $model = new DistributorModel();
        $data = [
            'id_user' => $this->request->getVar('id_user'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'alamat_distributor' => $this->request->getVar('alamat_distributor'),
        ];
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data distributor berhasil diubah.'
            ],
            'distributor' => $data
        ];
        return $this->respond($response);
    }
    // delete
    public function delete($id = null)
    {
        $model = new DistributorModel();
        $data = $model->where('id_distributor', $id)->delete($id);
        if ($data) {
            if ($model->delete($id)) {
                $response = [
                    'status' => 200,
                    'error' => null,
                    'messages' => [
                        'success' => 'distributor berhasil dihapus.'
                    ]
                ];
                return $this->respondDeleted($response);
            } else {
                $response = [
                    'status' => 500,
                    'error' => 'Delete Error',
                    'messages' => 'Gagal menghapus distributor.'
                ];
                return $this->respond($response, 500);
            }
        } else {
            return $this->failNotFound('Data distributor Tidak Ditemukan');
        }
    }
}
