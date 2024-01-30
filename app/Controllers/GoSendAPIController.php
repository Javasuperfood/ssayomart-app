<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class GoSendAPIController extends BaseController
{
    private $key;
    public function __construct()
    {
        $this->key = "15139";;
    }
    public function getCostGoSend()
    {
        $origin = $this->request->getVar('origin');
        $destination = $this->request->getVar('destination');
        if (!$this->validateData(['origin' => $origin, 'destination' => $destination], ['origin' => 'required', 'destination' => 'required'])) {
            return response()->setJSON(validation_errors());
        }
        $webhookConfig = new \Config\WebHook();
        $baseUrl = $webhookConfig->base_url;
        $clientId = $webhookConfig->client_id;
        $pasKey = $webhookConfig->pas_key;
        $endpoint = $baseUrl . '/gokilat/v10/calculate/price';

        $paymentType = 3;

        $headers = array(
            'Accept: application/json',
            'Client-ID: ' . $clientId,
            'Pass-Key: ' . $pasKey
        );

        $url = "{$endpoint}?origin={$origin}&destination={$destination}&paymentType={$paymentType}";

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            return 'Error: ' . curl_error($ch);
        } else {
            $response = json_decode($response, true);
            foreach ($response as $key => $value) {
                if ($value['active']) {
                    $response[$key]['encodeCost'] = $this->encryptValue($value['price']['go_pay_total_price'], $this->key);
                }
            }
        }

        curl_close($ch);
        return response()->setJSON($response);
    }

    function bookingAPI($body = [])
    {
        $webhookConfig = new \Config\WebHook();
        $baseUrl = $webhookConfig->base_url;
        $clientId = $webhookConfig->client_id;
        $pasKey = $webhookConfig->pas_key;

        $endpoint = $baseUrl . '/gokilat/v10/booking';

        // Request headers
        $headers = array(
            'Accept: application/json',
            'Client-ID: ' . $clientId,
            'Pass-Key: ' . $pasKey
        );

        // Request body payload
        $data = $body;

        // Convert the data array to JSON format
        $jsonData = json_encode($data);

        // Initialize cURL session
        $ch = curl_init($endpoint);

        // Set cURL options
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Execute cURL session and get the response
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            return curl_error($ch);
        }

        // Close cURL session
        curl_close($ch);

        // Print the response
        return $response;
    }
    function encryptValue($value, $key)
    {
        $cipher = "aes-256-cbc";
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $encrypted = openssl_encrypt($value, $cipher, $key, 0, $iv);
        return base64_encode($iv . $encrypted);
    }
    function decryptValue($encryptedValue, $key)
    {
        $cipher = "aes-256-cbc";
        $ivlen = openssl_cipher_iv_length($cipher);
        $data = base64_decode($encryptedValue);
        $iv = substr($data, 0, $ivlen);
        $encrypted = substr($data, $ivlen);
        return openssl_decrypt($encrypted, $cipher, $key, 0, $iv);
    }
}
