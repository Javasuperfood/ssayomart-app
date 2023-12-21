<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\AuthIdentitesModel;
use App\Models\AuthGroupUsersModel;

class AppleCallbackController extends BaseController
{
    public function index()
    {
        $appleUserData = $this->request->getPost();

        // Your logic to verify Apple ID data, check signature, etc.
        // ...
        $userId = $this->processAppleIDData($appleUserData);

        if ($userId) {
            $this->saveUserEmail($userId, $appleUserData['email']);
            $this->saveUserData($userId, $appleUserData);
            $this->saveUserRole($userId, 'user');

            // You can add more custom logic here as needed
            return redirect()->to('/');
        } else {
            return redirect()->to('/login')->with('error', 'Failed to process Apple ID login');
        }
    }

    protected function processAppleIDData($appleUserData)
    {
        // Your logic to verify Apple ID data, check signature, etc.

        $authIdentitiesModel = new AuthIdentitesModel();
        $user = $authIdentitiesModel->where('secret', $appleUserData['email'])->first();

        if ($user) {
            return $user['id'];
        } else {
            $newUserData = [
                'secret'    => $appleUserData['email'],
            ];

            $userId = $authIdentitiesModel->insert($newUserData);

            return $userId;
        }
    }

    protected function saveUserEmail($userId, $email)
    {
        $authIdentitiesModel = new AuthIdentitesModel();
        $authIdentitiesModel->insert([
            'user_id' => $userId,
            'type'    => 'email_password',
            'name'    => 'apple_account',
            'secret'  => $email,
        ]);
    }

    protected function saveUserData()
    {
        $usersModel = new UsersModel();
        $usersModel->insert([
            // 'user_id' => $userId,
            'username'    => 'default_username',
            'fullname'    => 'default_name',
            'img'         => 'default.png',
        ]);
    }

    protected function saveUserRole($userId, $role)
    {
        $authGroupUsersModel = new AuthGroupUsersModel();
        $authGroupUsersModel->insert([
            'user_id' => $userId,
            'group'   => $role,
        ]);
    }
}
