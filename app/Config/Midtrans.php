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
            $this->serverKey = 'Mid-server-aLZoDj1cUy1D4vxBdOwA3E9e';
            $this->clientKey = 'Mid-client-5aUc7KzYPl1l8Lpj';
            $this->urlMidtrans = 'https://app.midtrans.com/snap/snap.js';
        } elseif ($isP == 'development') {
            $this->isProduction = false;
            $this->serverKey = 'SB-Mid-server-9ya8fzSZH6K-HJyvn5kmuG-8';
            $this->clientKey = 'SB-Mid-client-T_uUJ6ot5ry3BrGh';
            $this->urlMidtrans = 'https://app.sandbox.midtrans.com/snap/snap.js';
        }
    }
}
