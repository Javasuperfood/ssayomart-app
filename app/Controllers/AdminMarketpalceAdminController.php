<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminTokoModel;
use App\Models\TokoModel;
use App\Models\UsersModel;

class AdminMarketpalceAdminController extends BaseController
{
    public function index()
    {
        $userModel = new UsersModel();
        $tokoModel = new TokoModel();
        $adminTokoModel = new AdminTokoModel();
        $user = $userModel->getUserWithRole();
        $data = [
            'users' => $user,
            'market' => $tokoModel->findAll(),
            'marketAdmin' => $adminTokoModel->getAdminToko()
        ];
        // dd($data);
        return view('dashboard/marketplaceAdmin/index', $data);
    }

    public function adminSave()
    {
        $adminTokoModel = new AdminTokoModel();
        if ($this->request->getVar('admin') == '') {
            $admin = null;
        } else {
            $admin = $this->request->getVar('admin');
        }
        if ($this->request->getVar('market') == '') {
            $market = null;
        } else {
            $market = $this->request->getVar('market');
        }
        $data = [
            'id_user' => $admin,
            'id_toko' => $market,
            'created_by' => user_id(),
            'updated_by' => user_id(),
        ];
        // dd($data);
        if (!$this->validateData($data, $adminTokoModel->validationRules)) {
            return redirect()->to(base_url('dashboard/admin-market'))->withInput();
        }
        $cek = $adminTokoModel->where('id_user', $admin)->findAll();
        foreach ($cek as $key => $m) {
            if ($m['id_toko'] == $market) {
                $alert = [
                    'type' => 'error',
                    'title' => 'Gagal',
                    'message' => 'Admin Sudah terdaftar pada market'
                ];
                session()->setFlashdata('alert', $alert);
                return redirect()->to(base_url('dashboard/admin-market'))->withInput();
            }
        }
        if (!$adminTokoModel->save($data)) {
            $alert = [
                'type' => 'error',
                'title' => 'Gagal',
                'message' => 'Gagal menambahkan keterangan market'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to(base_url('dashboard/admin-market'))->withInput();
        }
        $alert = [
            'type' => 'success',
            'title' => 'Berhasil',
            'message' => 'Berhasil menambahkan keterangan market'
        ];
        session()->setFlashdata('alert', $alert);
        return redirect()->to(base_url('dashboard/admin-market'));
    }

    public function storeDataUpdate($id)
    {
        $adminTokoModel = new AdminTokoModel();
        $id_toko = $this->request->getVar('chakedMarket');
        if (!$id_toko) {
            $id_toko = [];
        }
        $allmarket = $adminTokoModel->where('id_user', $id)->findAll();
        foreach ($allmarket as $key => $m) {
            if (!in_array($m['id_toko'], $id_toko)) {
                $adminTokoModel->delete($m['id_admin_toko']);
            }
        }
        $alert = [
            'type' => 'success',
            'title' => 'Berhasil',
            'message' => 'Berhasil update admin'
        ];
        session()->setFlashdata('alert', $alert);
        return redirect()->to(base_url('dashboard/admin-market'));
    }

    public function deleteAllAdminMarket($id)
    {
        $adminTokoModel = new AdminTokoModel();
        $allMarket = $adminTokoModel->where('id_user', $id)->findAll();
        // delete all $allMarket
        foreach ($allMarket as $market) {
            $adminTokoModel->delete($market['id_admin_toko']);
        }
        $alert = [
            'type' => 'success',
            'title' => 'Berhasil',
            'message' => 'Berhasil hapus admin dari semua market'
        ];
        session()->setFlashdata('alert', $alert);
        return redirect()->to(base_url('dashboard/admin-market'));
    }
}
