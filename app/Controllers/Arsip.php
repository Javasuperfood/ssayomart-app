<?php

namespace App\Controllers;

use App\Models\ArsipModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Arsip extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new ArsipModel();
        $data['jsf_arsip'] = $model->orderBy('id_arsip', 'DESC')->findAll();
        return $this->respond($data);
    }
    //Show Data
    public function show($id = null)
    {
        $model = new ArsipModel();
        $data = $model->where('id_arsip', $id)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data arsip Tidak Ditemukan');
        }
    }
    // Delete Data
    public function delete($id = null)
    {
        $model = new ArsipModel();
        $data = $model->find($id);
        if ($data) {
            if ($model->delete($id)) {
                $response = [
                    'status' => 200,
                    'error' => null,
                    'messages' => [
                        'success' => 'Data arsip berhasil dihapus.'
                    ]
                ];
                return $this->respondDeleted($response);
            } else {
                $response = [
                    'status' => 500,
                    'error' => 'Delete Error',
                    'messages' => 'Gagal menghapus data arsip.'
                ];
                return $this->respond($response, 500);
            }
        } else {
            return $this->failNotFound('Data arsip Tidak Ditemukan');
        }
    }
}
