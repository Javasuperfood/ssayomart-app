<?php

namespace App\Controllers;

use Hybridauth\Hybridauth;

class AppleCallbackController extends BaseController
{

    protected $hybridauth;

    public function __construct()
    {
        // Inisialisasi Hybridauth
        $this->hybridauth = new Hybridauth(config('Hybridauth'));
    }

    public function appleCallback()
    {
        // Tangani callback dari login dengan Apple ID
        $adapter = $this->hybridauth->authenticate('Apple');
        $profile = $adapter->getUserProfile();

        // Gunakan data $profile untuk mendaftarkan atau login pengguna di aplikasi Anda.
    }
}
