<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
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

    // webhook notification driver picked up //
    public function sendOrderNotification()
    {
        // Ambil data status dari permintaan POST
        $status = $this->request->getPost('status');

        log_message('debug', 'Status: ' . $status);

        // Panggil fungsi yang sebelumnya kita buat
        return $this->sendOrderNotificationByStatus($status);
    }

    public function sendOrderNotificationByStatus($status)
    {
        log_message('debug', 'Status in sendOrderNotificationByStatus: ' . $status);

        $usersModel = new UsersModel();

        // Mendapatkan data pengguna berdasarkan user_id
        $userData = $usersModel->find(user_id());

        // Periksa apakah data pengguna ditemukan dan memiliki kunci 'uuid'
        if ($userData && isset($userData[0]['uuid'])) {
            $uuid = $userData[0]['uuid'];

            // Ambil data atau parameter dari request sesuai kebutuhan
            $order_id = $this->request->getVar('order_id');

            // Buat pesan notifikasi
            $notification_message = $this->getNotificationMessage($status, $order_id);

            // Kirim notifikasi
            $result = $this->sendNotificationToUser($uuid, $notification_message);

            return response()->setJSON($result);
        } else {
            return response()->setJSON([
                'status' => 200,
                'result' => 'UUID NOT FOUND',
                'message' => 'User data not found or UUID is missing.',
            ], 200);
        }
    }

    private function getNotificationMessage($status, $order_id)
    {
        // Default message
        // $default_message = 'Terjadi masalah yang diluar dugaan kami. Kami akan memperbaiki nya segera';
        $default_message = 'Pesan awal contoh';

        // Pesan notifikasi sesuai dengan status
        switch ($status) {
            case 'confirmed':
                return 'Driver sudah dikonfirmasi. Pesanan dengan ID ' . $order_id;
            case 'allocated':
                return 'Driver sudah ditemukan. Pesanan dengan ID ' . $order_id;
            case 'out_for_pickup':
                return 'Driver sedang dalam perjalanan mengambil pesananan Anda. Pesanan dengan ID ' . $order_id;
            case 'out_for_delivery':
                return 'Driver sudah dalam perjalanan ke lokasi Anda. Pesanan dengan ID ' . $order_id;
            case 'picked':
                return 'Driver telah mengambil pesanan Anda. Pesanan dengan ID ' . $order_id;
            case 'cancelled':
                return 'Pesanan dibatalkan. Pesanan dengan ID ' . $order_id;
            case 'rejected':
                return 'Pesanan ditolak. Pesanan dengan ID ' . $order_id;
            case 'on_hold':
                return 'Pesanan ditunda. Pesanan dengan ID ' . $order_id;
            case 'no_driver':
                return 'Driver tidak dalam jangkauan terdekat. Mohon menunggu. Pesanan dengan ID ' . $order_id;
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
    }
}
