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
            // Sesuaikan dengan cara Anda menyimpan dan memeriksa state
            // ...

            // Panggil API Apple untuk mendapatkan ID token dan informasi pengguna
            $appleTokenInfo = $this->getAppleTokenInfo($authorizationCode);

            // Ambil informasi pengguna dari ID token
            $appleUserInfo = $this->decodeAppleIdToken($appleTokenInfo['id_token']);

            // Lakukan proses login atau registrasi pengguna
            $user = $this->processAppleLoginOrRegistration($appleUserInfo);

            if ($user) {
                // Setelah login atau registrasi berhasil, atur sesi pengguna atau tindakan lainnya
                // ...

                return redirect()->to('dashboard');
            } else {
                return redirect()->to('login')->with('error', 'Failed to process Apple login or registration.');
            }
        } else {
            return redirect()->to('login')->with('error', 'Invalid authorization code or state.');
        }
    }

    private function getAppleTokenInfo($authorizationCode)
    {
        // Panggil API Apple untuk menukarkan authorization code dengan ID token
        // Sesuaikan dengan implementasi Anda
        // ...

        // Contoh sederhana (tidak digunakan di lingkungan produksi)
        $appleTokenEndpoint = 'https://appleid.apple.com/auth/token';
        $clientID = 'com.javasuperfood.ssayomartappready';
        $clientSecret = 'MIGTAgEAMBMGByqGSM49AgEGCCqGSM49AwEHBHkwdwIBAQQgS1qD8Va17RW9V/hWX03epgnywCNyLORLw6czCfmNIH2gCgYIKoZIzj0DAQehRANCAATGklWQ21dME3qG4biJGPrD3qV4PhScANaWlH4gGqhrfHWfOXWCIqfGVTU1h4i9T16AyBLroThTdwppze7ujvyU';
        $redirectURI = 'https://apps.ssayomart.com/apple-login-callback';

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
        // Implementasi proses login atau registrasi pengguna
        // Sesuaikan dengan kebutuhan dan struktur pengguna di sistem Anda
        // ...

        // Contoh sederhana (hanya untuk tujuan ilustrasi)
        $userModel = new UsersModel();
        $user = $userModel->findUserByEmail($appleUserInfo->email);

        if ($user) {
            // Pengguna sudah terdaftar, lakukan proses login
            // ...
        } else {
            // Pengguna belum terdaftar, lakukan proses registrasi
            // ...
        }

        return $user; // Return objek pengguna
    }
}
