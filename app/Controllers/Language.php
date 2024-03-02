<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Language extends BaseController
{
    public function index()
    {
        $session = session();
        $locale = $this->request->getLocale();
        $session->remove('lang');
        $session->set('lang', $locale);
        $url = base_url();
        return redirect()->to($url);
    }
    public function pilihBahasa($bahasa)
    {
        $session = session();
        $url = base_url();

        // Set bahasa ke dalam session
        $session->set('bahasa', $bahasa);

        // Jika ini adalah pemilihan bahasa pertama kali, alihkan ke beranda
        if (!$session->get('first_language_selection')) {
            $session->set('first_language_selection', true);
        }
        return redirect()->to($url);
    }
}
