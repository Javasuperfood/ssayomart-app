<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class AdminUserManagementController extends BaseController
{
    public function index()
    {
        $usersModel = new UsersModel();
        $data = [
            'users' => $usersModel->findAll()
        ];

        return view('dashboard/userManagement/index', $data);
    }
}
