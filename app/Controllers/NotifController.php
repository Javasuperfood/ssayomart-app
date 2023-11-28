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

    public function notificationGosend()
    {
        $usersModel = new UsersModel();

        $uuid = $usersModel->find(user_id())['uuid'];
        // $uuid = 'f96e2bff-7141-4afa-b357-edc5d34dace8';

        $entity_id = $this->request->getVar('entity_id');
        $booking_id = $this->request->getVar('booking_id');
        $status = $this->request->getVar('status');
        $driver_name = $this->request->getVar('driver_name');
        $driver_phone = $this->request->getVar('driver_phone');
        $receiver_name = $this->request->getVar('receiver_name');
        $cancellation_reason = $this->request->getVar('cancellation_reason');
        $link_tracking_url = $this->request->getVar('link_tracking_url');

        $notification = $this->createNotification(
            'Pesanan untuk ' . $entity_id . ' atas nama ' . $receiver_name . ' dengan kode booking ' . $booking_id . ' sudah kami terima. ' . $driver_name . ' akan mengantarkan barang milik ' . $receiver_name . ' dengan sepenuh hati! Kamu juga bisa menghubungi driver ' . $driver_phone,
            $uuid,
            $entity_id,
            $status,
            $cancellation_reason
        );

        $config = Configuration::getDefaultConfiguration()
            ->setAppKeyToken($this->APP_KEY_TOKEN)
            ->setUserKeyToken($this->USER_KEY_TOKEN);
        $apiInstance = new DefaultApi(
            new GuzzleHttp\Client(),
            $config
        );

        $result = $apiInstance->createNotification($notification);
        return response()->setJSON($result);
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



    // public function warehouseNotification()
    // {
    //     $adminEmail = 'alfaini01@gmail.com';

    //     helper('email');

    //     $emailConfig = config('Email');
    //     $email = emailer()->initialize($emailConfig);

    //     // $data = [
    //     //     'entity_id' => 
    //     // ];

    //     $email->setFrom(setting('Email.fromEmail'), setting('Email.fromName') ?? '');
    //     $email->setTo($adminEmail);
    //     $email->setSubject('PESANAN MASUK!');
    //     $email->setMessage(view('Email/warehouseNotification'));

    //     if (!$email->send()) {
    //         log_message('error', $email->printDebugger(['headers']));
    //     }

    //     $email->clear();
    // }
}
