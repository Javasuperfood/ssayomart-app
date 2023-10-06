<?php

declare(strict_types=1);

namespace App\Libraries\ShieldOAuth;

use Datamweb\ShieldOAuth\Libraries\Basic\AbstractOAuth;
use CodeIgniter\HTTP\CURLRequest;
use Config\Services;
use Exception;

class GloginOAuth extends AbstractOAuth
{
    private static string $API_CODE_URL      = 'https://accounts.google.com/o/oauth2/v2/auth';
    private static string $API_TOKEN_URL     = 'https://oauth2.googleapis.com/token';
    private static string $API_USER_INFO_URL = 'https://www.googleapis.com/oauth2/v3/userinfo';
    private static string $APPLICATION_NAME  = 'Ssayomart';

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
        $this->token  = $token;
        $this->client = Services::curlrequest();

        $this->config        = config('ShieldOAuthConfig');
        $this->callback_url  = base_url('oauth/' . $this->config->call_back_route);
        $this->client_id     = $this->config->oauthConfigs['glogin']['client_id'];
        $this->client_secret = $this->config->oauthConfigs['glogin']['client_secret'];
    }

    /**
     * Create a link to transfer the user to the new provider.
     *
     * @see https://github.com/datamweb/shield-oauth/blob/develop/docs/add_other_oauth.md#writing-class-yahoo-oauth
     * @param string $state
     * @return string
     */
    public function makeGoLink(string $state): string
    {
        return self::$API_CODE_URL . "?response_type=code&client_id={$this->client_id}&scope=openid%20email%20profile&redirect_uri={$this->callback_url}&state={$state}";
    }

    /**
     * Try to get the value of `access_token` according to the code
     * received from the `makeGoLink()` method.
     *
     * @see https://github.com/datamweb/shield-oauth/blob/develop/docs/add_other_oauth.md#writing-class-yahoo-oauth
     * @param array $allGet
     * @return void
     */
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

    /**
     * Try to receive user information (including first name,
     * last name, email, etc) according to the token code set
     * in the previous step.
     *
     * @see https://github.com/datamweb/shield-oauth/blob/develop/docs/add_other_oauth.md#writing-class-yahoo-oauth
     * @return object
     */
    public function fetchUserInfoWithToken(): object
    {
        // Your code here
        // send request to API URL
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

    /**
     * Set the fields received from each service OAuth to be recorded
     * in each column of the table.
     *
     * @see https://github.com/datamweb/shield-oauth/blob/develop/docs/add_other_oauth.md#writing-class-yahoo-oauth
     * @param string $nameOfProcess
     * @param object $userInfo
     * @return array
     */
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
