<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Controllers\BaseController;
use App\Models\AlamatUserModel;
use App\Models\TokoModel;
use App\Models\UsersModel;

class RestfullApiController extends BaseController
{
    use ResponseTrait;
    public function index()
    {

        $response = [
            'status' => 200,
            'success' => 'Home',
            'messages' => 'Home Route'
        ];
        return $this->respond($response, 200);
    }
    public function user($id)
    {

        $userModel = new UsersModel();
        $alamatUserModel = new AlamatUserModel();
        $marketModel = new TokoModel();

        $user = $userModel->find($id);
        if (!$user) {
            $response = [
                'status' => 404,
                'success' => 'User not found',
                'response' => $user
            ];
            return $this->respond($response, 404);
        }
        $market = $marketModel->where('id_toko', $user['market_selected'])->first();
        $destination = $alamatUserModel->where('id_alamat_users', $user['address_selected'])->first();
        $alamat = $alamatUserModel->where('id_user', $id)->findAll();
        $response = [
            'status' => 200,
            'success' => 'User',
            'response' => [
                'user' => $user,
                'origin_selected' => $market,
                'destination_selected' => $destination,
                'address_list' => $alamat,

            ]
        ];
        return $this->respond($response, 200);
    }

    public function originList()
    {
        $tokoModel = new TokoModel();
        $origin = $tokoModel->findAll();
        $response = [
            'status' => 200,
            'success' => 'Origin List',
            'response' => $origin
        ];
        return $this->respond($response, 200);
    }
    public function origin($id)
    {
        $tokoModel = new TokoModel();
        $origin = $tokoModel->find($id);
        if (!$origin) {
            $response = [
                'status' => 404,
                'success' => 'Origin not found',
                'response' => $origin
            ];
            return $this->respond($response, 404);
        }
        $response = [
            'status' => 200,
            'success' => $origin['lable'],
            'response' => $origin
        ];
        return $this->respond($response, 200);
    }
}
