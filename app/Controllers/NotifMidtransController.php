<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CheckoutModel;
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

class NotifMidtransController extends BaseController
{
    private $APP_ID = '1191e933-e52c-466f-946f-e8cab83009d7';
    private $APP_KEY_TOKEN = 'OTM4N2YxMGYtNjM5NS00ZGZiLWEyNGYtZmNjNGM5ODNiNDVi';
    private $USER_KEY_TOKEN = 'NmNkYTljMGQtY2UwYS00NjQzLTgyMjItYzUyNjYyYzljMzE5';
    public function webhookMidtranss()
    {
        $data = $this->request->getVar();
        $responseApi = $this->NotifHandler($data);

        return $responseApi;
    }

    function NotifHandler($data)
    {
        $checkoutModel = new CheckoutModel();
        $transaksi = $checkoutModel->where('invoice', $data->order_id)->first();
        $total = 'Rp. ' . number_format(($data->gross_amount), 0, ',', '.');
        $string = $data->order_id . ' ' . 'Pembayaran anda berhasil ' . $total . ' dengan metode ' . $data->payment_type;
        $usersModel = new UsersModel();
        $uuid = $usersModel->where('id', $transaksi['id_user'])->first()['uuid'];
        if ($uuid == null) {
            return response()->setJSON([
                'status' => 200,
                'result' => 'UUID NOT FOUND',
                'body' => $data,
            ], 200);
        }
        $config = Configuration::getDefaultConfiguration()
            ->setAppKeyToken($this->APP_KEY_TOKEN)
            ->setUserKeyToken($this->USER_KEY_TOKEN);
        $apiInstance = new DefaultApi(
            new GuzzleHttp\Client(),
            $config
        );
        $notification = $this->createNotification($string, $uuid);

        $result = $apiInstance->createNotification($notification);
        if ($transaksi['id_status_pesan'] == 1) {
            $checkoutModel->save([
                'id_checkout' => $transaksi['id_checkout'],
                'id_status_pesan' => 2
            ]);
        }
        return response()->setJSON([
            'status' => 200,
            'result' => $result,
            'message' => $string,
            'body' => $data,
        ], 200);
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
}
