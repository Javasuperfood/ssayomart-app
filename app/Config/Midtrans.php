<?php

namespace Config;

class Midtrans
{
    public $isProduction;
    public $serverKey;
    public $clientKey;
    public $isSanitized = true;
    public $is3ds = true;
    public $urlMidtrans;
    public function __construct()
    {
        $isP = getenv('MIDTRANS_MODE');
        if ($isP == 'production') {
            $this->isProduction = true;
            $this->serverKey = 'Mid-server-PWlTJkfcIaFvU0ORyDf6iotw';
            $this->clientKey = 'Mid-client-dP788ilpmad0y5Ym';
            $this->urlMidtrans = 'https://app.midtrans.com/snap/snap.js';
        } elseif ($isP == 'development') {
            $this->isProduction = false;
            $this->serverKey = 'SB-Mid-server-2sJrXZNs7zTkBie18S3xSGbZ';
            $this->clientKey = 'SB-Mid-client-20YGLThZQ_ouzWxx';
            $this->urlMidtrans = 'https://app.sandbox.midtrans.com/snap/snap.js';
        }
    }
}
