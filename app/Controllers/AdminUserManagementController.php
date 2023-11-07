<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class AdminUserManagementController extends BaseController
{
    public function index()
    {
        $usersModel = new UsersModel();

        $perPage = 10;

        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;
        $keyword = $this->request->getVar('search');


        if ($keyword) {
            $user = $usersModel->getUser($perPage, $keyword);
        } else {
            $user = $usersModel->getUser($perPage);
        }

        $totalUsers = $usersModel->countAllResults();

        $data = [
            'users' =>  $user['users'],
            'pager' => $user['pager'],
            'iterasi' => ($currentPage - 1) * $perPage + 1,
            'totalUsers' => $totalUsers,
        ];

        return view('dashboard/userManagement/index', $data);
    }

    public function tambahAdmin()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required',
            'telp' => 'required',
            'status' => 'required',
        ]);
    }
}
