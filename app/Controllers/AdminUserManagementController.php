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

        $user_list = $usersModel->paginate($perPage, 'user');

        $totalUsers = $usersModel->countAllResults();

        $data = [
            'users' =>  $user,
            'pager' => $usersModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1,
            'totalUsers' => $totalUsers,
        ];

        return view('dashboard/userManagement/index', $data);
    }
}
