<?php

namespace App\Controllers;

use App\Models\CheckoutModel;
use App\Models\AlamatUserModel;
use App\Models\StatusPesanModel;

class Status extends BaseController
{
    public function status(): string
    {
        $checkoutModel = new CheckoutModel();
        $alamatModel = new AlamatUserModel();
        $statusModel = new StatusPesanModel();

        $alamat_list = $alamatModel->where('id_user', user_id())->findAll();
        $status_list = $statusModel->findAll();

        $data = [
            'title'                     => 'Status Pesanan',
            'getalamat'                 => $alamat_list,
            'getstatus'                 => $status_list,
        ];
        return view('user/produk/status', $data);
    }
}
