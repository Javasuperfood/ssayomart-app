<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class WebHook extends BaseConfig
{
    public $url;
    public $secretKey;
    public $timeout;
    public function __construct()
    {
        $isP = getenv('CI_ENVIRONMENT');
        if ($isP == 'production') {
            $this->url = 'https://example.com/prod/webhook';
            $this->secretKey = 'your_secret_key';
            $this->timeout = 10; // Waktu timeout dalam detik
        } elseif ($isP == 'development') {
            $this->url = 'https://example.com/dev/webhook';
            $this->secretKey = 'your_secret_key';
            $this->timeout = 10; // Waktu timeout dalam detik
        }
    }
}
