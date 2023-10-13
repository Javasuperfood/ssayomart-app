<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class AdminProfil extends BaseController
{
    public function profilAdmin($id)
    {
        $usersModel = new UsersModel();
        $query = $usersModel->select('users.username, users.fullname, users.telp, users.img, auth_identities.secret')
            ->join('auth_identities', 'auth_identities.user_id = users.id', 'inner')
            ->where('users.id', $id)
            ->get();

        $um = $usersModel->find([$id]);
        $data = [
            'title' => 'Profile Admin',
            'um' => $um[0],
            'results' => $query->getResult()
        ];
        return view('dashboard/profil/profilAdmin', $data);
    }

    public function editProfil($id)
    {
        $usersModel = new UsersModel();
        $query = $usersModel->select('users.username, users.fullname, users.telp, users.img, auth_identities.secret')
            ->join('auth_identities', 'auth_identities.user_id = users.id', 'inner')
            ->where('users.id', $id)
            ->get();

        $um = $usersModel->find([$id]);
        $data = [
            'title' => 'Sunting Admin',
            'um' => $um[0],
            'results' => $query->getResult()
        ];
        return view('dashboard/profil/editProfil', $data);
    }
    public function saveProfil($id)
    {
        $usersModel = new UsersModel();
        $image = $this->request->getFile('img');

        // Validasi untuk unggah gambar
        $aturanValidasi = [
            'img' => 'mime_in[img,image/jpg,image/jpeg,image/png]|max_size[img,2048]' // Hapus 'uploaded' dari validasi
        ];

        // Jika ada file gambar yang diunggah, lakukan validasi
        if (!$image->getError() == 4) {
            $aturanValidasi['img'] .= '|uploaded[img]';
        }

        if (!$this->validate($aturanValidasi)) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => $this->validator->listErrors()
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/profil/edit-admin/' . $id)->withInput();
        }

        // Jika validasi berhasil atau tidak ada gambar yang diunggah, lanjutkan pembaruan data
        $namaUserImage = $this->request->getVar('imageLama'); // Tetapkan nama gambar lama sebagai nilai awal

        if ($image->getError() != 4) { // Jika ada file gambar yang diunggah, proses unggahan gambar
            $produk = $usersModel->find($id);

            if ($produk['img'] == 'default.png') {
                $namaUserImage = $image->getRandomName();
                $image->move('assets/img/pic', $namaUserImage);
            } else {
                $namaUserImage = $image->getRandomName();
                $image->move('assets/img/pic', $namaUserImage);
                $gambarLamaPath = 'assets/img/pic/' . $this->request->getVar('imageLama');
                if (file_exists($gambarLamaPath)) {
                    unlink($gambarLamaPath);
                }
            }
        }

        $data = [
            'id' => $id,
            'username' => $this->request->getVar('username'),
            'fullname' => $this->request->getVar('fullname'),
            'telp' => $this->request->getVar('telp'),
            'img' => $namaUserImage
        ];
        // dd($data);

        if ($usersModel->save($data)) {
            session()->setFlashdata('success', 'Data pengguna berhasil diperbarui.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data pengguna berhasil diperbarui.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/profil/profile-admin/' . $id);
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/profil/profile-admin/' . $id)->withInput();
        }
    }
}
