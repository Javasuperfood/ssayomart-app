<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthIdentitesModel;
use App\Models\KategoriModel;
use CodeIgniter\Shield\Entities\User;

class PasswordUserController extends BaseController
{
    public function index()
    {
        // $pass =  password_hash('mlpnkobji', PASSWORD_DEFAULT);
        // dd($pass);
        // $user = auth()->user();
        // $result = auth()->check([
        //     'email'    => $user->email,
        //     'password' => '12345678',
        // ]);
        // dd($result->isOK());
    }

    public function changePassword()
    {
        $users = auth()->getProvider();
        $kategoriModel = new KategoriModel();
        $data = [
            'title' => 'Change Password',
            'kategori' => $kategoriModel->findAll(),
            'back'  => 'setting/detail-user'
        ];
        return view('user/home/setting/changePassword/oldPassword', $data);
    }
    public function storeChangePassword()
    {
        $oldPass = $this->request->getVar('oldPass');
        $newPass = $this->request->getVar('newPass');
        $reNewPass = $this->request->getVar('reNewPass');
        $data = [
            'oldPass' => $oldPass,
            'newPass' => $newPass,
            'reNewPass' => $reNewPass,
        ];
        if (!$this->validateData($data, [
            'oldPass' => [
                'label' => 'Old Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'newPass' => [
                'label' => 'New Password',
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'min_length' => '{field} minimal 8 karakter',
                ]
            ],
            'reNewPass' => [
                'label' => 'Re New Password',
                'rules' => 'required|matches[newPass]',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'matches' => '{field} tidak sama dengan password baru',
                ]
            ],
        ])) {
            session()->setFlashdata('_ci_validation_errors', $this->validator->getErrors());
            return redirect()->back();
        }

        $user = auth()->user();
        $result = auth()->check([
            'email'    => $user->email,
            'password' => $oldPass,
        ]);
        if (!$result->isOK()) {
            session()->setFlashdata('_ci_validation_errors', ['oldPass' => 'Password lama salah']);
            return redirect()->back();
        }


        $hashPass = password_hash($newPass, PASSWORD_DEFAULT);
        $AuthIdentitesModel = new AuthIdentitesModel();
        $id_AI = $AuthIdentitesModel->find(user_id())['id'];
        $AuthIdentitesModel->save([
            'id' => $id_AI,
            'secret2' => $hashPass,
        ]);
        session()->setFlashdata('alert', [
            'type' => 'success',
            'title' => 'Berhasil',
            'message' => 'Password Berhasil diubah',
        ]);
        return redirect()->to(base_url('/setting'));
    }
    public function magicLink()
    {
        //
    }
    public function storeMagicLink()
    {
        //
    }
}
