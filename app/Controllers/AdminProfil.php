<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminProfil extends BaseController
{
    public function profilAdmin()
    {

        $data = [
            'title' => 'Profile',
        ];
        return view('dashboard/profil/profilAdmin', $data);
    }

    public function editProfil()
    {

        $data = [
            'title' => 'edit',
        ];
        return view('dashboard/profil/editProfil', $data);
    }
}
