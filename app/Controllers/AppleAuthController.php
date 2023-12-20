<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\UsersModel;

use Firebase\JWT\JWT;

class AppleAuthController extends BaseController
{
    public function handleAppleLoginCallback()
    {
        $authorizationCode = $this->request->getGet('code');
        $state = $this->request->getGet('state');

        if ($authorizationCode && $state) {
            // Validasi state untuk mencegah CSRF attacks
            if ($state !== $this->session->get('apple_oauth_state')) {
                return redirect()->to('login')->with('error', 'Invalid state parameter. Possible CSRF attack.');
            }

            // Hapus state dari sesi setelah validasi
            $this->session->remove('apple_oauth_state');

            // Validasi CSRF token
            if (!$this->validate(['csrf' => 'csrf'])) {
                return redirect()->to('login')->with('error', 'CSRF token validation failed.');
            }

            // Panggil API Apple untuk mendapatkan ID token dan informasi pengguna
            $appleTokenInfo = $this->getAppleTokenInfo($authorizationCode);

            // Ambil informasi pengguna dari ID token
            $appleUserInfo = $this->decodeAppleIdToken($appleTokenInfo['id_token']);

            // Lakukan proses login atau registrasi pengguna
            $user = $this->processAppleLoginOrRegistration($appleUserInfo);

            if ($user) {
                // Setelah login atau registrasi berhasil, atur sesi pengguna atau tindakan lainnya
                return redirect()->to('user/home/Kategori2');
            } else {
                return redirect()->to('login')->with('error', 'Failed to process Apple login or registration.');
            }
        } else {
            return redirect()->to('login')->with('error', 'Invalid authorization code or state.');
        }
    }

    // Metode untuk memulai proses login dengan Apple
    public function initiateAppleLogin()
    {
        // Generate state parameter dan simpan di sesi
        $state = bin2hex(random_bytes(16));
        $this->session->set('apple_oauth_state', $state);

        // Redirect pengguna ke endpoint login Apple dengan menyertakan state parameter
        $redirectURI = base_url('callback-apple'); // Sesuaikan dengan URI callback Anda
        $appleLoginURL = "https://appleid.apple.com/auth/authorize?client_id=com.javasuperfood.ssayomartappready&redirect_uri={$redirectURI}&response_type=code&scope=name%20email&state={$state}";
        return redirect()->to($appleLoginURL);
    }

    private function getAppleTokenInfo($authorizationCode)
    {
        // Panggil API Apple untuk menukarkan authorization code dengan ID token
        // Sesuaikan dengan implementasi Anda
        // ...

        // Contoh sederhana (tidak digunakan di lingkungan produksi)
        $appleTokenEndpoint = 'https://appleid.apple.com/auth/token';
        $clientID = 'com.javasuperfood.ssayomartappready';
        $clientSecret = 'MIGTAgEAMBMGByqGSM49AgEGCCqGSM49AwEHBHkwdwIBAQQgfxhHs5FLfkY3dZAvVdKYMq63xubAPW6VvoNN+XItD3SgCgYIKoZIzj0DAQehRANCAAQMWT1vwcu/XDS+U/4lhbR/kjqEdBWIejFfd/KfPzqZMlHj4KNfOVvRa+z5kdKMs7T7jvHzop0sQRludLMKTvQC';
        $redirectURI = 'https://apps.ssayomart.com/callback-apple';

        $data = [
            'client_id' => $clientID,
            'client_secret' => $clientSecret,
            'code' => $authorizationCode,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $redirectURI,
        ];

        $response = $this->callAppleApi($appleTokenEndpoint, $data);

        // Return response dari panggilan ke API Apple
        return json_decode($response, true);
    }

    private function callAppleApi($url, $data)
    {
        // Implementasi untuk panggilan ke API Apple
        // Sesuaikan dengan cara Anda melakukan HTTP request
        // ...

        // Contoh sederhana menggunakan cURL (tidak digunakan di lingkungan produksi)
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    private function decodeAppleIdToken($idToken)
    {
        // Decode ID token dari Apple
        $decodedToken = JWT::decode($idToken, '', null);

        // Return informasi pengguna dari ID token
        return $decodedToken;
    }

    private function processAppleLoginOrRegistration($appleUserInfo)
    {
        $userModel = new UsersModel();

        // Cari pengguna berdasarkan email di tabel users
        $user = $userModel->findUserByEmail($appleUserInfo->email);

        if ($user) {
            // Pengguna sudah terdaftar, lakukan proses login
            // Sesuaikan dengan logika login Anda, misalnya, atur sesi
            // ...

            return $user; // Return objek pengguna
        } else {
            // Pengguna belum terdaftar, lakukan proses registrasi

            // Simpan pengguna ke tabel users dan auth_identities
            $userId = $userModel->saveUserFromAppleID($appleUserInfo);

            if ($userId) {
                // Registrasi berhasil, lakukan proses login
                // Sesuaikan dengan logika login Anda, misalnya, atur sesi
                // ...

                return $userModel->find($userId); // Return objek pengguna yang baru didaftarkan
            } else {
                // Gagal menyimpan pengguna, tangani sesuai kebutuhan Anda
                return null;
            }
        }
    }
}
