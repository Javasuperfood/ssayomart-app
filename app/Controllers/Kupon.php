<?php

namespace App\Controllers;

use App\Models\KuponModel;
use App\Models\KategoriModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;


class Kupon extends ResourceController
{
    use ResponseTrait;

    public function kupon()
    {
        $kategori = new KategoriModel();
        $kupon_model = new KuponModel();
        $kupon_list = $kupon_model->findAll();
        $data = [
            'title' => 'Kupon Promosi Ssayomart',
            'kupon_model' => $kupon_list,
            'kategori' => $kategori->findAll(),

        ];
        return view('user/home/kupon/kupon', $data);
    }

    public function index()
    {
        $model = new KuponModel();
        $data['jsf_kupon'] = $model->orderBy('id_kupon', 'DESC')->findAll();
        return $this->respond($data);
    }
    // Create Data
    public function create()
    {
        $model = new KuponModel();
        $data = [
            'nama_kupon' => $this->request->getPost('nama_kupon'),
            'code_kupon' => $this->request->getPost('code_kupon'),
            'deskripsi_kupon' => $this->request->getPost('deskripsi_kupon'),
            'masa_berlaku' => $this->request->getPost('masa_berlaku'),
            // 'created_by' => $this->request->getPost('created_by')
        ];

        if ($model->insert($data)) {
            $response = [
                'status' => 201,
                'error' => null,
                'messages' => [
                    'success' => 'Data kupon berhasil disimpan.'
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
        $model = new KuponModel();
        $data = $model->where('id_kupon', $id)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data kupon Tidak Ditemukan');
        }
    }
    //Update Data
    public function update($id = null)
    {
        $model = new KuponModel();
        $data = [
            'nama_kupon' => $this->request->getVar('nama_kupon'),
            'code_kupon' => $this->request->getVar('code_kupon'),
            'deskripsi_kupon' => $this->request->getVar('deskripsi_kupon'),
            'masa_berlaku' => $this->request->getVar('masa_berlaku'),
            // 'created_by' => $this->request->getVar('created_by')
        ];
        $model->update($id, $data);
        $response = [
            'status'    => 200,
            'error'     => null,
            'messages'  => [
                'success' => 'Data kupon berhasil di ubah'
            ]
        ];
        return $this->respond($response);
    }
    // Delete Data
    public function delete($id = null)
    {
        $model = new KuponModel();
        $data = $model->find($id);
        if ($data) {
            if ($model->delete($id)) {
                $response = [
                    'status' => 200,
                    'error' => null,
                    'messages' => [
                        'success' => 'Data kupon berhasil dihapus.'
                    ]
                ];
                return $this->respondDeleted($response);
            } else {
                $response = [
                    'status' => 500,
                    'error' => 'Delete Error',
                    'messages' => 'Gagal menghapus data kupon.'
                ];
                return $this->respond($response, 500);
            }
        } else {
            return $this->failNotFound('Data kupon Tidak Ditemukan');
        }
    }
}
