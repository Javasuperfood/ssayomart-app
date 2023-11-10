<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\AdminTokoModel;
use App\Models\AuthGroupUsersModel;
use App\Models\DeleteRequestUsersModel;

class AdminUserManagementController extends BaseController
{
    public function index()
    {
        $usersModel = new UsersModel();
        $adminTokoModel = new AdminTokoModel();

        $perPage = 10;

        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;
        $keyword = $this->request->getVar('search');

        $users = $usersModel->getUser($perPage, $keyword);

        // Retrieve the emails for the users and add them to the user data
        $emails = [];
        foreach ($users['users'] as $user) {
            $email = $usersModel->getEmail($user['id']);
            $emails[$user['id']] = $email;
        }

        $totalUsers = $usersModel->countAllResults();

        $data = [
            'users' => $users['users'],
            'emails' => $emails, // Pass the emails to the view
            'pager' => $users['pager'],
            'iterasi' => ($currentPage - 1) * $perPage + 1,
            'totalUsers' => $totalUsers,
            'marketAdmin' => $adminTokoModel->getAdminToko()
        ];

        return view('dashboard/userManagement/index', $data);
    }

    public function viewDeleteRequests()
    {
        $deleteRequestsModel = new DeleteRequestUsersModel();
        $deleteRequests = $deleteRequestsModel->getAllDeleteRequests();

        return view('admin/delete_requests_list', ['deleteRequests' => $deleteRequests]);
    }



    public function updateUserRole($id)
    {
        if (!auth()->user()->inGroup('superadmin')) {
            return view('dashboard/userNotListed');
        }

        $usersModel = new UsersModel();
        $authGroupModel = new AuthGroupUsersModel();
        $newRole = $this->request->getPost('newRole');
        $group = $authGroupModel->where('user_id', $id)->first();
        // dd($group);

        $data = [
            'id' => $group['id'],
            'group' => $newRole,
        ];

        if (!$authGroupModel->save($data)) {
            $alert = [
                'type' => 'error',
                'title' => 'Gagal',
                'message' => 'Gagal mengupdate role'
            ];
        } else {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Berhasil mengupdate role'
            ];
        }

        session()->setFlashdata('alert', $alert);
        return redirect()->to(base_url('dashboard/user-management'))->withInput();
    }
}
