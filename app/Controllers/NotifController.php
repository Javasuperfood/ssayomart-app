<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use App\Models\CheckoutModel;
use DateTime;
use onesignal\client\api\DefaultApi;
use onesignal\client\Configuration;
use onesignal\client\model\GetNotificationRequestBody;
use onesignal\client\model\Notification;
use onesignal\client\model\StringMap;
use onesignal\client\model\Player;
use onesignal\client\model\UpdatePlayerTagsRequestBody;
use onesignal\client\model\ExportPlayersRequestBody;
use onesignal\client\model\Segment;
use onesignal\client\model\FilterExpressions;
use PHPUnit\Framework\TestCase;
use GuzzleHttp;
use CodeIgniter\API\ResponseTrait;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client as GuzzleClient;

class NotifController extends BaseController
{
    use ResponseTrait;
    private $APP_ID = '1191e933-e52c-466f-946f-e8cab83009d7';
    private $APP_KEY_TOKEN = 'OTM4N2YxMGYtNjM5NS00ZGZiLWEyNGYtZmNjNGM5ODNiNDVi';
    private $USER_KEY_TOKEN = 'NmNkYTljMGQtY2UwYS00NjQzLTgyMjItYzUyNjYyYzljMzE5';

    public function setUuid()
    {
        $uuid = $this->request->getVar('uuid');
        $usersModel = new UsersModel();
        $user = $usersModel->find(user_id());
        if ($user) {
            if ($user['uuid'] != $uuid) {
                $usersModel->update($user['id'], [
                    'uuid' => $uuid
                ]);
                return $this->respond([
                    'type' => 'UUID Updated',
                    'uuid' => $uuid
                ], 200);
            } else {
                return $this->respond([
                    'type' => 'UUID Already Up to date',
                    'uuid' => $uuid
                ], 200);
            }
        }
    }

    public function PaymentSuccess()
    {
        $usersModel = new UsersModel();
        $uuid = $usersModel->find(user_id())['uuid'];
        $inv = $this->request->getVar('inv');
        // dd($uuid);
        $config = Configuration::getDefaultConfiguration()
            ->setAppKeyToken($this->APP_KEY_TOKEN)
            ->setUserKeyToken($this->USER_KEY_TOKEN);
        $apiInstance = new DefaultApi(
            new GuzzleHttp\Client(),
            $config
        );
        $notification = $this->createNotification('Pebayaran anda dengan nomor ' . $inv . ' Telah Berhasil', $uuid);

        $result = $apiInstance->createNotification($notification);
        return $result;
    }

    public function PaymentSuccess2()
    {
        $usersModel = new UsersModel();
        $uuid = 'cd4e7bca-f047-4321-937c-7699d2a5ad3b';
        $inv = '1029371382198';
        // dd($uuid);
        $config = Configuration::getDefaultConfiguration()
            ->setAppKeyToken($this->APP_KEY_TOKEN)
            ->setUserKeyToken($this->USER_KEY_TOKEN);
        $apiInstance = new DefaultApi(
            new GuzzleHttp\Client(),
            $config
        );
        $notification = $this->createNotification('Pebayaran anda dengan nomor ' . $inv . ' Telah Berhasil', $uuid);

        $result = $apiInstance->createNotification($notification);
        return $result;
    }

    function createNotification($enContent, $uuid): Notification
    {
        $content = new StringMap();
        $content->setEn($enContent);

        $notification = new Notification();
        $notification->setAppId($this->APP_ID);
        $notification->setContents($content);
        $notification->setIncludePlayerIds([$uuid]);
        return $notification;
    }

    function createPlayerModel($playerId): Player
    {
        $player = new Player();

        $player->setAppId($this->APP_ID);
        $player->setIdentifier($playerId);
        $player->setDeviceType(1);
        // dd($player);
        return $player;
    }

    // WEBHOOK NOTIFICAITON DRIVER PICKED UP //
    public function sendOrderNotification()
    {
        // Ambil data raw dari permintaan POST
        $rawData = file_get_contents('php://input');
        $postData = json_decode($rawData, true);

        $status = isset($postData['status']) ? $postData['status'] : null;

        log_message('debug', 'Status: ' . $status);

        return $this->sendOrderNotificationByStatus($status);
    }

    public function sendOrderNotificationByStatus($status)
    {
        log_message('info', 'Status in sendOrderNotificationByStatus: ' . $status);

        $rawData = file_get_contents('php://input');
        $payload = json_decode($rawData, true);

        $status = isset($payload['status']) ? $payload['status'] : null;

        $usersModel = new UsersModel();

        $users = $usersModel->findUsersByCheckoutStatus();

        if (!empty($users)) {
            foreach ($users as $user) {
                $uuid = $user['uuid'];
                $notification_payload = [
                    'booking_id' => $payload['booking_id'],
                    'driver_name' => $payload['driver_name'],
                    'driver_phone' => $payload['driver_phone'],
                    'cancellation_reason' => $payload['cancellation_reason'],
                    'cancelled_by' => $payload['cancelled_by'],
                    'liveTrackingUrl' => $payload['liveTrackingUrl'],
                ];

                // Buat pesan notifikasi
                $notification_message = $this->getNotificationMessage($status, $notification_payload);

                // Kirim notifikasi
                $result = $this->sendNotificationToUser($uuid, $notification_message);
            }

            return response()->setJSON([
                'status' => 200,
                'message' => 'Data payload sudah dikirim kepada semua pengguna yang memenuhi kondisi dan disimpan ke database',
            ]);
        } else {
            return response()->setJSON([
                'status' => 404,
                'result' => 'No users found with the specified conditions',
                'message' => 'Tidak ada pengguna yang memenuhi kondisi.',
            ], 200);
        }
    }

    private function getNotificationMessage($status, $payload)
    {
        $default_message = 'Terjadi masalah yang diluar dugaan kami. Kami akan memperbaiki nya segera';

        switch ($status) {
            case 'confirmed':
                return 'Driver sudah dikonfirmasi. Pesanan dengan nomor booking ' . $payload['booking_id'];
            case 'allocated':
                return 'Driver sudah ditemukan. ' . $payload['driver_name'] . ' akan segera mengambil pesananmu';
            case 'out_for_pickup':
                return $payload['driver_name'] . ' sedang dalam perjalanan mengambil pesananan Anda. Kamu bisa menghubungi driver di nomor ' . $payload['driver_phone'];
            case 'out_for_delivery':
                return $payload['driver_name'] . ' sedang dalam perjalanan ke lokasi Anda. Kamu bisa menghubungi driver di nomor ' . $payload['driver_phone'];
            case 'picked':
                return $payload['driver_name'] . ' sudah mengambil pesananan Anda. Kamu bisa menghubungi driver di nomor ' . $payload['driver_phone'];
            case 'cancelled':
                return 'Pesanan dibatalkan oleh ' . $payload['cancelled_by'] . '. Dengan keterangan ' . $payload['cancellation_reason'];
            case 'rejected':
                return 'Pesanan ditolak. Mohon maaf atas ketidaknyamannya';
            case 'on_hold':
                return 'Pesanan ditunda. Mohon maaf atas ketidaknyamannya';
            case 'no_driver':
                return 'Driver tidak dalam jangkauan terdekat. Mohon maaf atas ketidaknyamannya';
            case 'unknown':
                return $default_message;
            default:
                return $default_message;
        }
    }

    private function sendNotificationToUser($uuid, $message)
    {
        $config = Configuration::getDefaultConfiguration()
            ->setAppKeyToken($this->APP_KEY_TOKEN)
            ->setUserKeyToken($this->USER_KEY_TOKEN);

        $apiInstance = new DefaultApi(
            new GuzzleClient(),
            $config
        );

        $notification = $this->createNotification($message, $uuid);

        try {
            $result = $apiInstance->createNotification($notification);

            return response()->setJSON([
                'status' => 200,
                'result' => $result,
                'message' => $message,
            ], 200);
        } catch (GuzzleException $e) {
            // Handle error, log, or return an appropriate response
            return response()->setJSON([
                'status' => 500,
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // WEBHOOK NOTIFICAITON TO WAREHOUSE EMAIL WHEN INCOMING ORDERS  //
    public function warehouseGosendNotification()
    {
        $usersModel = new UsersModel();
        helper('email');

        $emailConfig = config('Email');

        // Dapatkan email admin
        $adminEmails = $usersModel->getAdminEmails();

        if (!empty($adminEmails)) {
            foreach ($adminEmails as $adminEmail) {
                $email = emailer()->initialize($emailConfig);
                $email->setFrom(setting('Email.fromEmail'), setting('Email.fromName') ?? '');
                $email->setSubject('PESANAN MASUK!');
                $email->setMessage(view('Email/warehouseNotification'));
                $email->setTo($adminEmail);

                if (!$email->send()) {
                    log_message('error', $email->printDebugger(['headers']));
                }
            }
        }

        return response()->setJSON([
            'status' => 'success',
            'message' => 'payload dikirm ke email warehouse dan disimpan ke database',
        ]);
    }
}
