<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\AuthIdentitesModel;

class AppleCallbackController extends BaseController
{
    public function index()
    {
        $payload = file_get_contents('php://input');

        $logger = service('logger');
        $logger->info('Received Apple Notification', ['payload' => $payload]);

        // Dapatkan informasi pengguna dari notifikasi Apple
        $appleUserInfo = json_decode($payload, true);

        // Cek apakah pengguna sudah terdaftar
        $userModel = new UsersModel();
        $existingUser = $userModel->getUserInfo($appleUserInfo['id']);

        if ($existingUser && isset($existingUser['id']) && isset($existingUser['email'])) {
            // Pengguna sudah terdaftar, lakukan login
            $this->handleLogin($existingUser);
        } else {
            // Pengguna belum terdaftar, buat pengguna baru
            $this->handleNewUser($appleUserInfo);
        }
    }

    private function handleLogin($existingUser)
    {
        // Set session untuk pengguna yang sudah terdaftar
        session()->set('id', $existingUser['id']);
        session()->set('email', $existingUser['email']);

        $logger = service('logger');
        $logger->info('User berhasil login : ', ['id' => $existingUser['id'], 'email' => $existingUser['email']]);

        return redirect()->to(base_url());
    }

    private function handleNewUser($appleUserInfo)
    {
        // Pengguna belum terdaftar, buat pengguna baru
        $newUserData = [
            'email' => isset($appleUserInfo['email']) ? $appleUserInfo['email'] : ''
        ];

        $userModel = new UsersModel();
        $userId = $userModel->save($newUserData);

        $authIdentitiesModel = new AuthIdentitesModel();
        $authIdentitiesModel->save([
            'user_id' => $userId,
            'secret' => isset($appleUserInfo['email']) ? $appleUserInfo['email'] : '',
        ]);

        // Set session untuk pengguna baru
        session()->set('user_id', $userId);
        session()->set('email', isset($appleUserInfo['email']) ? $appleUserInfo['email'] : '');

        return redirect()->to(base_url());
    }
}
