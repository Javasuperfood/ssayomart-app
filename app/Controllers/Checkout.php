<?php

namespace App\Controllers;

use App\Models\AlamatUserModel;
use App\Models\CheckoutModel;
//  $query = $usersModel->select('users.username, users.fullname, users.telp, auth_identities.secret')
// ->join('auth_identities', 'auth_identities.user_id = users.id', 'inner')
// ->where('users.id', $id)
// ->get();
class Checkout extends BaseController
{
    public function checkout($id_alamat, $id_user): string
    {
        $checkoutModel = new CheckoutModel();
        $alamatModel = new AlamatUserModel();
        $alamat_list = $alamatModel->where('id_user', user_id())->findAll();

        $data = [
            'title'     => 'Checkout',
            // 'checkout'  => $checkoutModel->getCheckout($id_checkout, $id_user),
            'alamat_list'    => $alamat_list

        ];
        // dd($data);
        return view('user/home/checkout/checkout', $data);
    }
}
