<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AppleCallbackController extends BaseController
{
    public function index()
    {
        // Tangani notifikasi dari Apple di sini
        $payload = file_get_contents('php://input');

        // Log pesan untuk keperluan debugging
        $logger = service('logger');
        $logger->info('Received Apple Notification', ['payload' => $payload]);

        // Lakukan pemrosesan notifikasi sesuai kebutuhan Anda

        // Respon ke Apple untuk konfirmasi penerimaan notifikasi
        echo json_encode(['status' => 'success']);
    }
}
