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
            $users = $usersModel->orderBy('id', 'DESC')->like('username', $keyword);
        } else {
            $users = $usersModel->orderBy('id', 'DESC');
        }
        $user_list = $usersModel->paginate($perPage, 'user');
        $data = [
            'users' => $user_list,
            'pager' => $usersModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1,
        ];

        return view('dashboard/userManagement/index', $data);
    }
}
