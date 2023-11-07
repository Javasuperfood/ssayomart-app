<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class AdminManagementController extends BaseController
{
    public function index()
    {
        $usersModel = new UsersModel();

        $perPage = 10;

        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;
        $keyword = $this->request->getVar('search');
        $isAdmin = true;

        if ($keyword) {
            $admin = $usersModel->getUser($perPage, $keyword, $isAdmin);
        } else {
            $admin = $usersModel->getUser($perPage, null, $isAdmin);
        }

        $totalAdmins = $usersModel->select('users.id')->join('auth_groups_users', 'users.id = auth_groups_users.user_id')->where('group', 'admin')->findAll();

        $data = [
            'admin' =>  $admin['users'],
            'pager' => $admin['pager'],
            'iterasi' => ($currentPage - 1) * $perPage + 1,
            'totalAdmins' => count($totalAdmins),
        ];

        return view('dashboard/adminManagement/index', $data);
    }
}
