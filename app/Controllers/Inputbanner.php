<?php

namespace App\Controllers;

class Inputbanner extends BaseController
{
    public function inputbaner(): string
    {
        $data = [
            'title' => 'Inputbanner'
        ];
        return view('/dashboard/inputbaner', $data);
    }
}
