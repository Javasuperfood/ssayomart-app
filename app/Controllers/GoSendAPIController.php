<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class GoSendAPIController extends BaseController
{
    public function getCostGoSend()
    {
        $origin = $this->request->getVar('origin');
        $destination = $this->request->getVar('destination');
        if (!$this->validateData(['origin' => $origin, 'destination' => $destination], ['origin' => 'required', 'destination' => 'required'])) {
            return response()->setJSON(validation_errors());
        }
        $webhookConfig = config('WebHook');
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
            return response()->setJSON($response);
        }

        curl_close($ch);
    }
}
