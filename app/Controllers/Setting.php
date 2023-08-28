<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Controllers\BaseController;

class Setting extends BaseController
{

    private $url;
    private $apiKey;
    public function __construct()
    {
        $this->url = getenv('API_URL_RO');
        $this->apiKey = getenv('API_KEY_RO');
    }
    public function setting(): string
    {
        $userModel = new UsersModel();
        $user = $userModel->find(session()->get('id'));
        $data = [
            'title' => 'Setting',
            'user' => $user[0],
            'saldo' => 2000000
        ];
        // dd($data);
        return view('user/home/setting/setting', $data);
    }
    public function detailUser(): string
    {
        $data = [
            'title' => 'Detail User',
        ];
        return view('user/home/setting/detailUser', $data);
    }
    public function pembayaran(): string
    {
        $data = [
            'title' => 'Pembayaran',
        ];
        return view('user/home/setting/pembayaran', $data);
    }
    public function alamatList(): string
    {
        $data = [
            'title' => 'Alamat',
            'nama' => 'Javasuperfood',
            'label'     => 'Kantor',
            'alamat' => 'Ruko Cyber Park Jalan Gajah Mada Jalan Boulevard Jendral Sudirman No.2159/2161/2165, RT.001/RW.009, Panunggangan Bar., Kec. Cibodas, Kota Tangerang, Banten 15139'
        ];
        return view('user/home/setting/alamatList', $data);
    }

    public function updateAlamat(): string
    {
        $provinsi = $this->rajaongkir('province');
        $data = [
            'title'     => 'Edit Alamat',
            'nama'      => 'Javasuperfood',
            'telp'      => '+62 123456789',
            'label'     => 'Kantor',
            'alamat'    => 'Ruko Cyber Park Jalan Gajah Mada Jalan Boulevard Jendral Sudirman No.2159/2161/2165, RT.001/RW.009, Panunggangan Bar., Kec. Cibodas, Kota Tangerang, Banten 15139',
            'catatan'   => 'Rumah saya ada anjing nya. Awas di gigit. Anjing saya rabies.',
            'provinsi' => json_decode($provinsi)->rajaongkir->results,

        ];
        return view('user/home/setting/updateAlamat', $data);
    }

    public function createAlamat(): string

    {
        $provinsi = $this->rajaongkir('province');
        $data = [
            'title'     => 'Tambah Alamat Baru',
            'provinsi' => json_decode($provinsi)->rajaongkir->results,
        ];
        // dd();
        return view('user/home/setting/createAlamat', $data);
    }
    public function getCity()
    {
        if ($this->request->isAJAX()) {
            $id_province = $this->request->getGet('id_province');
            $data = $this->rajaongkir('city', $id_province);
            return $this->response->setJSON($data);
        }
    }
    public function getCost()
    {
        if ($this->request->isAJAX()) {
            $origin = $this->request->getGet('origin');
            $destination = $this->request->getGet('destination');
            $weight = $this->request->getGet('weight');
            $courier = $this->request->getGet('courier');
            $data = $this->rejaongkircost($origin, $destination, $weight, $courier);
            return $this->response->setJSON($data);
        }
    }
    private function rejaongkircost($origin, $destination, $weight, $courier)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=" . $origin . "&destination=" . $destination . "&weight=" . $weight . "&courier=" . $courier . "",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
                "key: " . $this->apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return $response;
    }

    private function rajaongkir($method, $id_province = null)
    {
        $endPoint = $this->url . $method;
        if ($id_province != null) {
            # code...
            $endPoint = $endPoint . "?province=" . $id_province;
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: " . $this->apiKey
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);
        return $response;
    }
}
