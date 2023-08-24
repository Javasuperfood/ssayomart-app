<?php

namespace App\Controllers;

class HistoryTransaksi extends BaseController
{
    public function history(): string
    {
        $data = [
            'title' => 'History',
            'name' => 'Kiki',
            'saldo' => 2000
        ];
        return view('user/home/history/history', $data);
    }
}
