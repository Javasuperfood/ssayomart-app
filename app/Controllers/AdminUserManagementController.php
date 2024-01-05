<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\AdminTokoModel;
use App\Models\AuthGroupUsersModel;
use App\Models\DeleteRequestUsersModel;
use App\Models\AuthIdentitesModel;

class AdminUserManagementController extends BaseController
{
    public function index()
    {
        $usersModel = new UsersModel();
        $adminTokoModel = new AdminTokoModel();
        $delRequest = new DeleteRequestUsersModel();
        $authIdentitiesModel = new AuthIdentitesModel();
        $perPage = 10;

        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;
        $keyword = $this->request->getVar('search');

        $users = $usersModel->getUser($perPage, $keyword);

        $delRequestAll = $delRequest->getAllRequests();
        $delRequestCount = count($delRequestAll);

        // Retrieve the emails for the users and add them to the user data
        // $emails = [];
        // foreach ($users['users'] as $user) {
        //     // $email = $usersModel->getEmail($user['id']);
        //     $emails[$user['id']] = $email;
        // }

        $totalUsers = $usersModel->select('users.id')->join('auth_groups_users', 'users.id = auth_groups_users.user_id')->findAll();

        $data = [
            'users' => $users['users'],
            'pager' => $users['pager'],
            'iterasi' => ($currentPage - 1) * $perPage + 1,
            'totalUsers' => count($totalUsers),
            'marketAdmin' => $adminTokoModel->getAdminToko(),
            'delRequest' => $delRequestAll,
            'usersModel' => $usersModel,
            'authIdentitiesModel' => $authIdentitiesModel,
            'delRequestCount' => $delRequestCount,
        ];

        return view('dashboard/userManagement/index', $data);
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

    // =============================================================
    // ===================== DELETE ACCOUNT ========================
    // =============================================================

    public function delRequest()
    {
        $usersModel = new UsersModel();
        $delRequest = new DeleteRequestUsersModel();
        $authIdentitiesModel = new AuthIdentitesModel();
        $perPage = 10;

        $currentPage = $this->request->getVar('page_user') ? $this->request->getVar('page_user') : 1;
        $keyword = $this->request->getVar('search');
        $users = $usersModel->getUser($perPage, $keyword);
        $delRequestAll = $delRequest->getAllRequests();

        $data = [
            'users' => $users['users'],
            'delRequest' => $delRequestAll,
            'usersModel' => $usersModel,
            'authIdentitiesModel' => $authIdentitiesModel,
        ];

        return view('dashboard/userManagement/deleteRequest', $data);
    }

    public function delete($id)
    {
        $authIdentitiesModel = new AuthIdentitesModel();
        $authGroupUsersModel = new AuthGroupUsersModel();
        $requestDeleteModel = new DeleteRequestUsersModel();

        // Retrieve user data
        $userToDelete = $authIdentitiesModel->getRequestDeleteId($id);

        if (!$userToDelete) {
            // Handle if data is not found
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Data tidak ditemukan.'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/user-management');
        }

        // Delete from auth_identities table
        $authIdentitiesDeleted = $authIdentitiesModel->delete($userToDelete['id']);
        if ($authIdentitiesDeleted) {
            $authIdentitiesModel->delete($userToDelete['id']);
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada penghapusan Akun'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/user-management')->withInput();
        }

        // Delete from auth_groups_users table
        $authGroupUsersModel->where('user_id', $userToDelete['user_id'])
            ->where('group !=', 'superadmin') // Hanya hapus jika bukan superadmin
            ->delete();

        // Delete from jsf_request_delete table
        $requestDeleteModel->deleteByUserId($userToDelete['user_id']);

        // Display success message
        $alert = [
            'type' => 'success',
            'title' => 'Berhasil',
            'message' => 'Akun berhasil dihapus.'
        ];
        session()->setFlashdata('alert', $alert);

        return redirect()->to('dashboard/user-management');
    }
}
