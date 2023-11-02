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
        $user = $usersModel->find(user_id())[0];
        if ($user) {
            if ($user['uuid'] != $uuid) {
                $usersModel->update($user['id'], [
                    'uuid' => $uuid
                ]);
                return $this->respond([
                    'type' => 'UUID Updated',
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
        $notification = $this->createNotification('Pesanan ' . $inv . ' Telah Berhasil', $uuid);

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
}
