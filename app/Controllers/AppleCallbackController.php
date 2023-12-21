<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\AuthIdentitesModel;
use App\Models\AuthGroupUsersModel;

class AppleCallbackController extends BaseController
{
    public function index()
    {
        $payload = file_get_contents('php://input');

        $logger = service('logger');
        $logger->info('Received Apple Notification', ['payload' => $payload]);

        // Dapatkan informasi pengguna dari notifikasi Apple
        $appleUserInfo = json_decode($payload, true);
        // dd($appleUserInfo);

        // Cek apakah pengguna sudah terdaftar
        $existingUser = null;

        if (isset($appleUserInfo['sub'])) {
            $userModel = new UsersModel();
            $existingUser = $userModel->getUserInfo($appleUserInfo['sub']);
        }

        if ($existingUser && isset($existingUser['id']) && isset($existingUser['username'])) {
            // Pengguna sudah terdaftar, lakukan login
            $userSession = \Config\Services::session();
            var_dump($userSession->get());

            $userSession->set('user_id', $existingUser['id']);
            $userSession->set('username', $existingUser['username']);

            // Respon ke Apple untuk konfirmasi penerimaan notifikasi
            echo json_encode(['status' => 'success']);

            // Tambahkan pernyataan logging di sini
            $logger->info('User logged in successfully', ['user_id' => $existingUser['id'], 'username' => $existingUser['username']]);

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
            var_dump($userSession->get());

            $userSession->set('user_id', $userId);
            $userSession->set('username', isset($appleUserInfo['email']) ? $appleUserInfo['email'] : '');

            // Respon ke Apple untuk konfirmasi penerimaan notifikasi
            echo json_encode(['status' => 'success']);

            return redirect()->to(base_url());
        }
    }
}
