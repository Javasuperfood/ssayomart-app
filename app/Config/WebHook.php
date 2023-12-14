<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class WebHook extends BaseConfig
{
    public $base_url;
    public $client_id;
    public $pas_key;
    public function __construct()
    {
        $isP = getenv('CI_ENVIRONMENT');
        if ($isP == 'production') {
            $this->base_url = 'https://kilat-api.gojekapi.com/';
            $this->client_id = 'ssayomart-engine';
            $this->pas_key = '03085d71b11d9b9fb76a421af9e56b8b82997020105b039d89b4f04d3cfbbcfe';
        } elseif ($isP == 'development') {
            $this->base_url = 'https://integration-kilat-api.gojekapi.com';
            $this->client_id = 'ssayomart-engine';
            $this->pas_key = 'caffa1988f9930ca7c66747e892a7e689f3ded81b3d142b10fc99df7ff36f989';
        }
    }
}
