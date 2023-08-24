<?php

namespace App\Controllers;

class Setting extends BaseController
{
    public function setting(): string
    {
        $data = [
            'title' => 'setting',
            'name' => 'Kiki',
            'saldo' => 2000
        ];
        return view('user/home/setting/setting', $data);
    }
}
