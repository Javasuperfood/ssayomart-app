<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\AuthIdentitesModel;
use App\Models\AuthGroupUsersModel;

class AppleCallbackController extends BaseController
{
    // public function index()
    // {
    //     $appleUserData = $this->request->getPost();

    //     // Your logic to verify Apple ID data, check signature, etc.
    //     // ...
    //     $userId = $this->processAppleIDData($appleUserData);
    //     var_dump($appleUserData); // Tampilkan isi $appleUserData untuk debugging

    //     if ($userId) {
    //         $this->saveUserEmail($userId, $appleUserData['secret']);
    //         $this->saveUserData($userId, $appleUserData);
    //         $this->saveUserRole($userId, 'user');

    //         // You can add more custom logic here as needed
    //         return redirect()->to('/');
    //     } else {
    //         return redirect()->to('/login')->with('error', 'Failed to process Apple ID login');
    //     }
    // }

    // protected function processAppleIDData($appleUserData)
    // {
    //     // Your logic to verify Apple ID data, check signature, etc.

    //     $authIdentitiesModel = new AuthIdentitesModel();
    //     $user = $authIdentitiesModel->where('secret', $appleUserData['secret'])->first();

    //     if ($user) {
    //         return $user['id'];
    //     } else {
    //         $newUserData = [
    //             'secret'    => $appleUserData['secret'],
    //         ];

    //         $userId = $authIdentitiesModel->insert($newUserData);

    //         return $userId;
    //     }
    // }

    // protected function saveUserEmail($userId, $email)
    // {
    //     $authIdentitiesModel = new AuthIdentitesModel();
    //     $authIdentitiesModel->insert([
    //         'user_id' => $userId,
    //         'type'    => 'email_password',
    //         'name'    => 'apple_account',
    //         'secret'  => $email,
    //     ]);
    // }

    // protected function saveUserData()
    // {
    //     $usersModel = new UsersModel();
    //     $usersModel->insert([
    //         // 'user_id' => $userId,
    //         'username'    => 'default_username',
    //         'fullname'    => 'default_name',
    //         'img'         => 'default.png',
    //     ]);
    // }

    // protected function saveUserRole($userId, $role)
    // {
    //     $authGroupUsersModel = new AuthGroupUsersModel();
    //     $authGroupUsersModel->insert([
    //         'user_id' => $userId,
    //         'group'   => $role,
    //     ]);
    // }

    public function index()
    {
        $payload = file_get_contents('php://input');

        $logger = service('logger');
        $logger->info('Received Apple Notification', ['payload' => $payload]);

        // Dapatkan informasi pengguna dari notifikasi Apple
        $appleUserInfo = json_decode($payload, true); // Pastikan payload dapat di-decode

        // Cek apakah pengguna sudah terdaftar
        $existingUser = null;

        if (isset($appleUserInfo['sub'])) {
            $userModel = new UsersModel();
            $existingUser = $userModel->getUserInfo($appleUserInfo['sub']);
        }

        if ($existingUser && isset($existingUser['id']) && isset($existingUser['username'])) {
            // Pengguna sudah terdaftar, lakukan login
            $userSession = \Config\Services::session();

            $userSession->set('user_id', $existingUser['id']);
            $userSession->set('username', $existingUser['username']);

            // Respon ke Apple untuk konfirmasi penerimaan notifikasi
            echo json_encode(['status' => 'success']);

            return redirect()->to(base_url()); // Ganti dengan URL tujuan setelah login
        } else {
            // Pengguna belum terdaftar, buat pengguna baru
            $newUserData = [
                'username' => isset($appleUserInfo['email']) ? $appleUserInfo['email'] : '',
                'fullname' => isset($appleUserInfo['name']) ? $appleUserInfo['name'] : '',
                'uuid' => isset($appleUserInfo['sub']) ? $appleUserInfo['sub'] : '',
            ];

            $userModel = new UsersModel();
            $userId = $userModel->insert($newUserData);

            $authIdentitiesModel = new AuthIdentitesModel();
            $authIdentitiesModel->insert([
                'user_id' => $userId,
                'secret' => isset($appleUserInfo['email']) ? $appleUserInfo['email'] : '',
            ]);

            // Set data pengguna ke dalam sesi
            $userSession = \Config\Services::session();
            $userSession->set('user_id', $userId);
            $userSession->set('username', isset($appleUserInfo['email']) ? $appleUserInfo['email'] : '');

            // Respon ke Apple untuk konfirmasi penerimaan notifikasi
            echo json_encode(['status' => 'success']);

            return redirect()->to(base_url()); // Ganti dengan URL tujuan setelah login
        }
    }
}
