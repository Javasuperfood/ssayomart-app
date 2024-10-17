<?php

namespace App\Libraries;

use Config\LocationIQ;
use GuzzleHttp\Client;

class LocationiqService
{
    private $apiKey;
    private $client;

    public function __construct()
    {
        // Ambil API Key dari konfigurasi
        $config = new Locationiq();
        $this->apiKey = $config->apiKey;

        // Inisialisasi Guzzle Client
        $this->client = new Client([
            'base_uri' => 'https://us1.locationiq.com/v1/',
        ]);
    }

    // Fungsi untuk Geocoding (Alamat ke Koordinat)
    public function geocode($address)
    {
        $response = $this->client->get('search.php', [
            'query' => [
                'key' => $this->apiKey,
                'q'   => $address,
                'format' => 'json'
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    // Fungsi untuk Reverse Geocoding (Koordinat ke Alamat)
    public function reverseGeocode($lat, $lon)
    {
        $response = $this->client->get('reverse.php', [
            'query' => [
                'key' => $this->apiKey,
                'lat' => $lat,
                'lon' => $lon,
                'format' => 'json',
                'accept-language' => 'id'
            ]
        ]);

        return json_decode($response->getBody(), true);
    }
}
