<?php

namespace App\Controllers;

use App\Models\CheckoutModel;
use App\Models\AlamatUserModel;
use App\Models\StatusPesanModel;
use App\Models\UsersModel;

class UserStatusController extends BaseController
{
    public function status($slug)
    {
        $checkoutModel = new CheckoutModel();
        $alamatModel = new AlamatUserModel();
        $statusModel = new StatusPesanModel();
        $userModel = new UsersModel();
        $userSatus = $userModel->getStatus($slug);
        $alamat_list = $alamatModel->where('id_user', user_id())->findAll();
        $alamat = $alamatModel->where('id_user', user_id())->first();

        $status = $statusModel->findAll();


        $data = [
            'title'                     => 'Status Pesanan',
            'getalamat_list'            => $alamat_list,
            'getalamat'                 => $alamat,
            'getstatus'                 => $status,
            'status' => $userSatus[0]

        ];
        // dd($data);
        return view('user/produk/status', $data);
    }
}
