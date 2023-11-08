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

        return view('dashboard/marketplace/index', [
            'toko' => $tokoModel->findAll()
        ]);
    }

    public function show($id)
    {
        $tokoModel = new TokoModel();
        $toko = $tokoModel->find($id);

        return view('dashboard/marketplace/market', [
            'toko' => $toko
        ]);
    }

    public function market($id)
    {
        $tokoModel = new TokoModel();
        $toko = $tokoModel->find($id);
        $data = [
            'toko' => $toko
        ];
        // dd($data);
        return view('dashboard/marketplace/market', $data);
    }

    // Save
    public function create()
    {
        session();
        $tokoModel = new TokoModel();

        $provinsi = $this->rajaongkir('province');
        $data = [
            'provinsi' => json_decode($provinsi)->rajaongkir->results,
        ];
        // dd($data);
        return view('dashboard/marketplace/create', $data);
    }

    public function store()
    {
        // dd($this->request->getVar());
        $tokoModel = new TokoModel();

        $id_province = ($this->request->getVar('id_provinsi') == '') ? null : $this->request->getVar('id_provinsi');
        $id_city = ($this->request->getVar('id_kabupaten') == '') ? null : $this->request->getVar('id_kabupaten');


        $data = [
            'deskripsi' => $this->request->getVar('deskripsi'),
            'alamat_1' => $this->request->getVar('alamat_1'),
            'alamat_2' => $this->request->getVar('detail-alamat'),
            'province' => $this->request->getVar('provinsi'),
            'id_province' => $id_province,
            'city' => $this->request->getVar('kabupaten'),
            'id_city' => $id_city,
            'zip_code' => $this->request->getVar('zip_code'),
            'telp' => $this->request->getVar('telp'),
            'telp2' => $this->request->getVar('telp2'),
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude'),
        ];
        // dd($data);
        if (!$this->validateData($data, $tokoModel->validationRules)) {
            session()->setFlashdata('success', 'Berhasil menambahkan keterangan toko');
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada input kupon'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/marketplace/create')->withInput();
        }
        // dd($data);
        if ($tokoModel->save($data)) {
            session()->setFlashdata('success', 'Berhasil menambahkan keterangan toko');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Berhasil menambahkan keterangan toko'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/marketplace');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada input kupon'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/marketplace/create')->withInput();
        }
    }

    // Update
    public function edit($id)
    {
        $tokoModel = new TokoModel();

        $toko = $tokoModel->find($id);

        $provinsi = $this->rajaongkir('province');
        $data = [
            'title' => 'Edit Toko',
            't' => $toko,
            'provinsi' => json_decode($provinsi)->rajaongkir->results,
            'back' => 'dashboard/marketplace'
        ];

        return view('dashboard/marketplace/edit', $data);
    }

    public function update()
    {
        // dd($this->request->getVar());
        $tokoModel = new TokoModel();
        $id_province = ($this->request->getVar('id_provinsi') == '') ? null : $this->request->getVar('id_provinsi');
        $id_city = ($this->request->getVar('id_kabupaten') == '') ? null : $this->request->getVar('id_kabupaten');
        $id = $this->request->getVar('id_toko');

        if ($this->request->getVar('telp2') == '') {
            $telp2 = null;
        } else {
            $telp2 = $this->request->getVar('telp2');
        }

        $data = [
            'id_toko' => $id,
            'deskripsi' => $this->request->getVar('deskripsi'),
            'alamat_1' => $this->request->getVar('alamat_1'),
            'alamat_2' => $this->request->getVar('detail-alamat'),
            'province' => $this->request->getVar('provinsi'),
            'id_province' => $id_province,
            'city' => $this->request->getVar('kabupaten'),
            'id_city' => $id_city,
            'zip_code' => $this->request->getVar('zip_code'),
            'telp' => $this->request->getVar('telp'),
            'telp2' => $telp2,
            'latitude' => $this->request->getVar('latitude'),
            'longitude' => $this->request->getVar('longitude'),
        ];
        // dd($data);

        if (!$this->validateData($data, $tokoModel->validationRules)) {
            session()->setFlashdata('success', 'Berhasil menambahkan keterangan toko');
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada input kupon'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/marketplace/edit/' . $id)->withInput();
        }
        if ($tokoModel->save($data)) {
            session()->setFlashdata('success', 'Data toko cabang berhasil diubah.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data Toko cabang berhasil diubah.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/marketplace');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/marketplace/marketplace/edit/' . $id)->withInput();
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
