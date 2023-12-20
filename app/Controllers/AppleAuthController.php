<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthIdentitesModel;
use App\Models\UsersModel;

use Firebase\JWT\JWT;

class AppleAuthController extends BaseController
{
    // Properti untuk konfigurasi CSRF protection
    protected $CSRFProtectOptions = [
        'handleAppleLoginCallback' => ['except' => ['post']],
    ];

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

            // Nonaktifkan validasi CSRF untuk metode handleAppleLoginCallback
            $this->request->setMethod('post');

            // Validasi CSRF token secara manual
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

    public function initiateAppleLogin()
    {
        // Generate state parameter dan simpan di sesi
        $state = bin2hex(random_bytes(16));
        $this->session->set('apple_oauth_state', $state);

        $redirectURI = base_url('callback-apple'); // Sesuaikan dengan URI callback Anda
        $appleLoginURL = "https://appleid.apple.com/auth/authorize?client_id=com.javasuperfood.ssayomartappready&redirect_uri={$redirectURI}&response_type=code&scope=name%20email&state={$state}";
        return redirect()->to($appleLoginURL);
    }

    private function getAppleTokenInfo($authorizationCode)
    {
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

        return json_decode($response, true);
    }

    private function callAppleApi($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    private function decodeAppleIdToken($idToken)
    {
        $decodedToken = JWT::decode($idToken, '', null);

        return $decodedToken;
    }

    private function processAppleLoginOrRegistration($appleUserInfo)
    {
        $authIdentities = new AuthIdentitesModel();

        $user = $authIdentities->findUserByEmail($appleUserInfo->secret);

        if ($user) {
            return $user; // Return objek pengguna
        } else {
            $userId = $authIdentities->saveUserFromAppleID($appleUserInfo);

            if ($userId) {
                return $authIdentities->find($userId); // Return objek pengguna yang baru didaftarkan
            } else {
                return null;
            }
        }
    }
}
