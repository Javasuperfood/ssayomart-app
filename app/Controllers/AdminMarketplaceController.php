<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TokoModel;
use App\Models\UsersModel;

class AdminMarketplaceController extends BaseController
{
    private $url;
    private $apiKey;
    public function __construct()
    {
        $this->url = getenv('API_URL_RO');
        $this->apiKey = getenv('API_KEY_RO');
    }
    public function index()
    {
        $tokoModel = new TokoModel();
        $toko = $tokoModel->where('id_user', user_id())->first();
        $data = [
            'toko' => $toko
        ];
        // dd($data);
        return view('dashboard/markertplace/index', $data);
    }
    public function create()
    {
        $tokoModel = new TokoModel();
        $toko = $tokoModel->where('id_user', user_id())->first();
        if ($toko) {
            return redirect()->to(base_url('dashboard/marketplace'));
        }
        $provinsi = $this->rajaongkir('province');
        $data = [
            'toko' => $toko,
            'provinsi' => json_decode($provinsi)->rajaongkir->results,
        ];
        // dd($data);
        return view('dashboard/markertplace/create', $data);
    }

    public function store()
    {
        // dd($this->request->getVar());
        $tokoModel = new TokoModel();

        $data = [
            'id_user' => user_id(),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'alamat_1' => $this->request->getVar('alamat'),
            'alamat_2' => $this->request->getVar('detail-alamat'),
            'province' => $this->request->getVar('provinsi'),
            'id_province' => $this->request->getVar('id_provinsi'),
            'city' => $this->request->getVar('kabupaten'),
            'id_city' => $this->request->getVar('id_kabupaten'),
            'zip_code' => $this->request->getVar('zip-code'),
            'telp' => $this->request->getVar('telp'),
            'telp2' => $this->request->getVar('telp2'),
        ];
        if ($tokoModel->save($data)) {
            return redirect()->to(base_url('dashboard/marketplace'))->with('success', 'Market has been created');
        }
    }

    // FETCHING DATA API PROVINSI & KOTA
    public function getCity()
    {
        if ($this->request->isAJAX()) {
            $id_province = $this->request->getGet('id_province');
            $data = $this->rajaongkir('city', $id_province);
            return $this->response->setJSON($data);
        }
    }

    // GET DATA API RAJAONGKIR
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
