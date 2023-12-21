<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use CodeIgniter\I18n\Time;

class ContactController extends BaseController
{

    public function storeData()
    {
        $email = $this->request->getVar('email');
        $name = $this->request->getVar('name');
        $message = $this->request->getVar('message');
        $subject = $this->request->getVar('subject');
        if ($email == null || $name == null || $message == null || $subject == null) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Mohon lengkapi semua kolom'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->back()->withInput();
        }

        $to = 'ptssayomartaplikasi@gmail.com';
        $cc = ['kiki@ssayomart.com', 'kikioffice0111@gmail.com'];
        $this->sendToAdmin($to, $cc, $email, $name, $subject, $message);
        $this->sendToUser($email, $name, $subject);
        $alert = [
            'type' => 'success',
            'title' => 'Sukses',
            'message' => 'Pesan terkirim'
        ];
        session()->setFlashdata('alert', $alert);
        return redirect()->to(base_url('setting'));
    }

    function sendToUser($from, $name, $subject)
    {

        /** @var IncomingRequest $request */
        $request = service('request');
        $ipAddress = $request->getIPAddress();
        $userAgent = (string) $request->getUserAgent();
        $date      = Time::now()->toDateTimeString();
        // Send the user an email with the code
        helper('email');
        $email = emailer()->setFrom(setting('Email.fromEmail'), setting('Email.fromName') ?? '');
        $email->setTo($from);
        $email->setSubject($subject);
        $email->setMessage(view('Email/contact/toUser', [
            'ipAddress' => $ipAddress,
            'userAgent' => $userAgent,
            'date'      => $date,
            'name'   => $name
        ]));

        if ($email->send(false) === false) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => $this->validator->listErrors()
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->back()->withInput();
        }
        // Clear the email
        $email->clear();
    }
    function sendToAdmin($to, $cc = [], $from, $name, $subject, $message)
    {

        /** @var IncomingRequest $request */
        $request = service('request');
        $ipAddress = $request->getIPAddress();
        $userAgent = (string) $request->getUserAgent();
        $date      = Time::now()->toDateTimeString();

        // Send the user an email with the code
        helper('email');
        $email = emailer()->setFrom(setting('Email.fromEmail'), $name ?? '');
        $email->setTo($to);
        $email->setCc($cc);
        $email->setReplyTo($from);
        $email->setSubject($subject);
        $email->setMessage(view('Email/contact/toAdmin', [
            'ipAddress' => $ipAddress,
            'userAgent' => $userAgent,
            'date'      => $date,
            'message'   => $message
        ]));

        if ($email->send(false) === false) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Gagal mengirim email'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->back()->withInput();
        }
        // Clear the email
        $email->clear();
    }
}
