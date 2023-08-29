<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlamatUserModel;

class AlamatUser extends BaseController
{
    public function index()
    {
        $alamat_user_model = new AlamatUserModel();
        $data = $alamat_user_model->getAlamatUser();
        return view('user/home/setting/alamatList', $data);
    }
}
