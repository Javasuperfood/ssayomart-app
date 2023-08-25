<?php

namespace App\Controllers;

class Input extends BaseController
{
    public function input(): string
    {
        $data = [
            'title' => 'Input'
        ];
        return view('/dashboard/input', $data);
    }
}
