<?php

namespace App\Controllers;

class Edit extends BaseController
{
    public function edit(): string
    {
        $data = [
            'title' => 'Edit'
        ];
        return view('/dashboard/edit', $data);
    }

    public function save()
    {
        dd($this->request->getVar());
    }
}
