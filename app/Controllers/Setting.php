<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\AlamatUserModel;
use App\Controllers\BaseController;
use App\Models\AuthIdentitesModel;

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
    // USER DETAIL
    public function detailUser($id): string
    {
        $usersModel = new UsersModel();
        $authIdentitesModel = new AuthIdentitesModel();
        $query = $usersModel->select('users.username, users.fullname, users.telp, auth_identities.secret')
            ->join('auth_identities', 'auth_identities.user_id = users.id', 'inner')
            ->where('users.id', $id)
            ->get();

        $du = $usersModel->find([$id]);
        $data = [
            'title' => 'Detail User',
            'detail' => $usersModel,
            'du' => $du[0],
            'results' => $query->getResult()
        ];
        // dd($data);
        return view('user/home/setting/detailUser', $data);
    }
    // PEMBAYARAN
    public function pembayaran(): string
    {
        $data = [
            'title' => 'Pembayaran',
        ];
        return view('user/home/setting/pembayaran', $data);
    }

    // CONTROLLER ALAMAT
    public function alamatList(): string
    {
        $alamat_user_model = new AlamatUserModel();
        $alamat_list = $alamat_user_model->findAll();
        $data = [
            'title' => 'Alamat',
            'alamat_user_model' => $alamat_list
        ];
        // dd($data);
        return view('user/home/setting/alamatList', $data);
    }
    public function createAlamat(): string
    {
        session();
        $provinsi = $this->rajaongkir('province');
        $data = [
            'title'     => 'Tambah Alamat Baru',
            'provinsi' => json_decode($provinsi)->rajaongkir->results
        ];
        return view('user/home/setting/createAlamat', $data);
    }
    public function updateAlamat($id): string
    {
        $provinsi = $this->rajaongkir('province');
        $alamatModel = new AlamatUserModel();
        $au = $alamatModel->find([$id]);
        $data = [
            'title' => 'Edit Alamat',
            'provinsi' => json_decode($provinsi)->rajaongkir->results,
            'au' => $au[0]
        ];
        // dd($data);
        return view('user/home/setting/updateAlamat', $data);
    }
    public function saveAlamat()
    {
        $alamatModel = new AlamatUserModel();
        $id = session()->get('user');

        $data = [
            'id_user' => $id['id'],
            'label' => $this->request->getVar('label'),
            'penerima' => $this->request->getVar('nama_penerima'),
            'alamat_1' => $this->request->getVar('alamat_1'),
            'alamat_2' => $this->request->getVar('alamat_2'),
            'id_province' => $this->request->getVar('id_provinsi'),
            'province' => $this->request->getVar('provinsi'),
            'id_city' => $this->request->getVar('id_kabupaten'),
            'city' => $this->request->getVar('kabupaten'),
            'zip_code' => $this->request->getVar('zip_code'),
            'telp' => $this->request->getVar('no_telp1'),
            'telp2' => $this->request->getVar('no_telp2')
        ];
        // SWAL
        if ($alamatModel->save($data)) {
            session()->setFlashdata('success', 'Alamat berhasil disimpan.');
            $alert = [
                'type' => 'success',
                'title' => 'Sukses',
                'message' => 'Alamat berhasil disimpan.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('setting/create-alamat');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Kesalahan',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('setting/create-alamat')->withInput();
        }
    }
    public function deleteAlamat($id)
    {
        $alamatModel = new AlamatUserModel();

        $deleted = $alamatModel->delete($id);

        if ($deleted) {
            $alert = [
                'type' => 'success',
                'title' => 'Sukses',
                'message' => 'Alamat berhasil disimpan.'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('setting/create-alamat');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Kesalahan',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('setting/create-alamat')->withInput();
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
