<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\UsersModel;
use App\Models\AuthIdentitesModel;
use App\Models\AuthGroupUsersModel;

class AppleCallbackController extends BaseController
{
    public function index()
    {
        $appleUserData = $this->request->getPost();

        // Your logic to verify Apple ID data, check signature, etc.

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
            // Handle the case where user is not found, create a new user, etc.

            // Example: Create a new user in the database
            $newUserData = [
                'username' => $appleUserData['username'],
                'fullname' => $appleUserData['fullname'],
                'secret'    => $appleUserData['secret'],
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
            'type'    => 'secret',
            'name'    => 'apple',
            'secret'  => $email,
        ]);
    }

    protected function saveUserData($userId, $appleUserData)
    {
        $usersModel = new UsersModel();
        // Your logic to update user data in the database based on Apple ID callback
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
