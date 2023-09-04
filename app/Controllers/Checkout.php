<?php

namespace App\Controllers;

use App\Models\AlamatUserModel;
use App\Models\CheckoutModel;

class Checkout extends BaseController
{
    public function checkout(): string
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
        if (empty($alamat_list)) {
            $data['error'] = 'Tidak ada alamat yang tersedia. Silakan tambahkan alamat terlebih dahulu.';
        } else {
            $data = [
                'title' => 'Checkout',
                'alamat_list' => $alamat_list
            ];
        }

        return view('user/home/checkout/checkout', $data);
    }
}
