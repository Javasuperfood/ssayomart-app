<?php

namespace App\Controllers;

use Hybridauth\Hybridauth;


class AppleAuthController extends BaseController
{
    protected $hybridauth;

    public function __construct()
    {
        // Inisialisasi Hybridauth
        $this->hybridauth = new Hybridauth(config('Hybridauth'));
    }

    public function appleLogin()
    {
        // Arahkan pengguna untuk memulai login dengan Apple ID
        $adapter = $this->hybridauth->authenticate('Apple');
        $adapter->authenticate();
    }
}
