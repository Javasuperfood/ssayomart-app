<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthIdentitesModel;
use App\Models\UsersModel;

use Firebase\JWT\JWT;

class AppleAuthController extends BaseController
{
    protected $CSRFProtectOptions = [
        'handleAppleLoginCallback' => ['except' => ['post']],
    ];

    public function handleAppleLoginCallback()
    {
        $authorizationCode = $this->request->getGet('code');
        $state = $this->session->get('apple_oauth_state');
        $nonce = $this->session->get('apple_oauth_nonce');

        // Debugging
        dd($state, $nonce, $authorizationCode);

        if ($authorizationCode && $state && $nonce) {
            $appleTokenInfo = $this->getAppleTokenInfo($authorizationCode);

            $appleUserInfo = $this->decodeAppleIdToken($appleTokenInfo['id_token']);
            $user = $this->processAppleLoginOrRegistration($appleUserInfo);

            if ($user) {
                return redirect()->to('user/home/Kategori2');
            } else {
                return redirect()->to('login')->with('error', 'Failed to process Apple login or registration.');
            }
        } else {
            return redirect()->to('login')->with('error', 'Invalid authorization code, state, or nonce.');
        }
    }


    public function initiateAppleLogin()
    {
        $state = bin2hex(random_bytes(16));
        $nonce = bin2hex(random_bytes(16));

        $this->session->set('apple_oauth_state', $state);
        $this->session->set('apple_oauth_nonce', $nonce);

        $redirectURI = base_url('callback-apple');

        $appleLoginURL = "https://appleid.apple.com/auth/authorize?client_id=com.javasuperfood.ssayomartappready&redirect_uri={$redirectURI}&response_type=code&scope=name%20email&state={$state}&nonce={$nonce}";
        return redirect()->to($appleLoginURL);
    }

    private function getAppleTokenInfo($authorizationCode)
    {
        $appleTokenEndpoint = 'https://appleid.apple.com/auth/token';
        $clientID = 'com.javasuperfood.ssayomartappready';
        $clientSecret = 'MIGTAgEAMBMGByqGSM49AgEGCCqGSM49AwEHBHkwdwIBAQQgfxhHs5FLfkY3dZAvVdKYMq63xubAPW6VvoNN+XItD3SgCgYIKoZIzj0DAQehRANCAAQMWT1vwcu/XDS+U/4lhbR/kjqEdBWIejFfd/KfPzqZMlHj4KNfOVvRa+z5kdKMs7T7jvHzop0sQRludLMKTvQC';
        $redirectURI = 'https://apps.ssayomart.com/callback-apple';
        $state = bin2hex(random_bytes(16));
        $nonce = bin2hex(random_bytes(16));

        $data = [
            'client_id' => $clientID,
            'client_secret' => $clientSecret,
            'response_type' => 'code',
            'grant_type' => 'authorization_code',
            'redirect_uri' => $redirectURI,
            'state' => $state,
            'nonce' => $nonce
        ];

        $response = $this->callAppleApi($appleTokenEndpoint, $data);

        return json_decode($response, true);
    }

    private function callAppleApi($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/x-www-form-urlencoded',
            'Accept: application/json',
        ]);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            // Tangani kesalahan curl
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode != 200) {
            // Tangani kesalahan HTTP
        }

        return $response;
    }

    private function decodeAppleIdToken($idToken)
    {
        try {
            $decodedToken = JWT::decode($idToken, '', null);
        } catch (\Exception $e) {
            log_message('error', 'Error decoding Apple ID token: ' . $e->getMessage());
        }
        return $decodedToken;
    }

    private function processAppleLoginOrRegistration($appleUserInfo)
    {
        $authIdentities = new AuthIdentitesModel();

        $user = $authIdentities->findUserByEmail($appleUserInfo->secret);

        if ($user) {
            return $user;
        } else {
            $userId = $authIdentities->saveUserFromAppleID($appleUserInfo);

            if ($userId) {
                return $authIdentities->find($userId);
            } else {
                return null;
            }
        }
    }
}
