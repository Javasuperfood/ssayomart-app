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
        try {
            $response = $this->client->get('https://us1.locationiq.com/v1/reverse.php', [
                'query' => [
                    'key' => $this->apiKey,
                    'lat' => $lat,
                    'lon' => $lon,
                    'format' => 'json',
                    'accept-language' => 'id'
                ],
                'headers' => [
                    'Accept' => 'application/json',
                ],
            ]);

            $data = json_decode($response->getBody(), true);

            return [
                'display_name' => $data['display_name'] ?? null,
                'province' => $data['address']['state'] ?? null,
                'city' => $data['address']['city'] ?? null,
                'postcode' => $data['address']['postcode'] ?? null,
                'lat' => $lat,
                'lon' => $lon,
            ];
        } catch (\Exception $e) {
            echo "An error occurred: " . $e->getMessage();
            return null;
        }
    }
}
