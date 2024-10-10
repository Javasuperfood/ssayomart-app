<?php

use Config\Locationiq;
use GuzzleHttp\Client;

if (!function_exists('get_geocode')) {
    function get_geocode($address)
    {
        $config = new Locationiq();
        $client = new Client(['base_uri' => 'https://us1.locationiq.com/v1/']);
        $response = $client->get('search.php', [
            'query' => [
                'key' => $config->apiKey,
                'q'   => $address,
                'format' => 'json'
            ]
        ]);
        return json_decode($response->getBody(), true);
    }
}
