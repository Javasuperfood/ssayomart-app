<?php

declare(strict_types=1);

namespace App\Libraries\ShieldOAuth;

use Datamweb\ShieldOAuth\Libraries\Basic\AbstractOAuth;
use CodeIgniter\HTTP\CURLRequest;
use Config\Services;
use Exception;

class AppleLoginOAuth extends AbstractOAuth
{
    private static $API_CODE_URL = 'https://appleid.apple.com/auth/oauth2/v2/authorize'; // Tambahkan URL untuk mendapatkan Auth Code
    private static $API_TOKEN_URL = 'https://appleid.apple.com/auth/oauth2/v2/token'; // Tambahkan URL untuk mendapatkan Auth Token
    private static $API_USER_INFO_URL = 'https://appleid.apple.com/auth/me'; // Tambahkan URL untuk mendapatkan informasi pengguna
    private static $APPLICATION_NAME = 'Ssayomart';

    protected string $token;
    protected CURLRequest $client;
    protected ?object $config = null;
    protected string $client_id;
    protected string $client_secret;
    protected string $callback_url;

    /**
     * Class construct
     *
     * @see https://github.com/datamweb/shield-oauth/blob/develop/docs/add_other_oauth.md#writing-class-yahoo-oauth
     * @param string $token
     */
    public function __construct(string $token = '')
    {
        $this->token = $token;

        $this->config        = config('ShieldOAuthConfig');
        $this->callback_url  = 'https://apps.ssayomart.com'; // Pastikan sesuai dengan yang didaftarkan di Apple Developer
        $this->client_id     = 'com.javasuperfood.ssayomartappready';
        $this->client_secret = 'MIGTAgEAMBMGByqGSM49AgEGCCqGSM49AwEHBHkwdwIBAQQgWJcXYMwwBAJ+jxSXX088+8finxsmjVf3+UU0/8nn5VqgCgYIKoZIzj0DAQehRANCAAQy+VijbDwI/q0ayDD6yNBhBRDyklId/YJAT2uKe81fS/2V2lsXvF+Nzb8HsZSoridlqv9xjuN9uxjHW0oA5CkM';
    }

    public function makeGoLink(string $state): string
    {
        return self::$API_CODE_URL . "?response_type=code&client_id={$this->client_id}&scope=openid%name%20email&redirect_uri={$this->callback_url}&state={$state}";
    }

    public function fetchAccessTokenWithAuthCode(array $allGet): void
    {
        try {
            // send request to API URL
            $response = $this->client->request('POST', self::$API_TOKEN_URL, [
                'form_params' => [
                    'client_id'     => $this->client_id,
                    'client_secret' => $this->client_secret,
                    'code'          => $allGet['code'],
                    'redirect_uri'  => $this->callback_url,
                    'grant_type'    => 'authorization_code',
                ],
                'headers' => [
                    'User-Agent' => self::$APPLICATION_NAME . '/1.0',
                    'Accept'     => 'application/json',
                ],
            ]);
        } catch (Exception $e) {
            exit($e->getMessage());
        }

        $token = json_decode($response->getBody())->access_token;
        $this->setToken($token);
    }


    public function fetchUserInfoWithToken(): object
    {
        try {
            $response = $this->client->request('POST', self::$API_USER_INFO_URL, [
                'headers' => [
                    'Accept'        => 'application/json',
                    'User-Agent'    => self::$APPLICATION_NAME . '/1.0',
                    'Authorization' => 'Bearer ' . $this->getToken(),
                ],
                'http_errors' => false,
            ]);
        } catch (Exception $e) {
            exit($e->getMessage());
        }

        return json_decode($response->getBody());
    }


    public function setColumnsName(string $nameOfProcess, object $userInfo): array
    {
        if ($nameOfProcess === 'syncingUserInfo') {
            return [
                $this->config->usersColumnsName['first_name'] => $userInfo->name,
                // $this->config->usersColumnsName['last_name']  => $userInfo->family_name,
                $this->config->usersColumnsName['avatar']     => $userInfo->picture,
            ];
        }

        if ($nameOfProcess === 'newUser') {
            return [
                // users tbl                                    // OAuth
                'username'                                    => 'user' . rand(10000, 99999),
                'email'                                       => $userInfo->email,
                'password'                                    => random_string('crypto', 32),
                'active'                                      => $userInfo->email_verified,
                $this->config->usersColumnsName['first_name'] => $userInfo->given_name,
                // $this->config->usersColumnsName['last_name']  => $userInfo->family_name,
                $this->config->usersColumnsName['avatar']     => $userInfo->picture,
            ];
        }
        return [];
    }
}
