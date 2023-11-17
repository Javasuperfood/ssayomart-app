<?php

namespace App\Controllers;

use App\Models\KuponModel;
use App\Models\ProdukModel;

class AdminKupon extends BaseController
{
    public function kupon()
    {
        $kuponModel = new KuponModel();
        $kupon_list = $kuponModel->getAllKupon();
        $data = [
            'title' => 'kupon',
            'kupon_Model' => $kupon_list
        ];
        // dd($data);
        return view('dashboard/kupon/kupon', $data);
    }

    public function tambahKupon()
    {

        $data = [
            'title' => 'tambahKupon',
        ];
        return view('dashboard/kupon/tambahKupon', $data);
    }

    //menyimpan ke database
    public function saveKupon()
    {
        // dd($this->request->getVar());
        $kuponModel = new KuponModel();
        if ($this->request->getVar('is_active') == 1) {
            $is_active = 1;
        } else {
            $is_active = 0;
        }
        if ($this->request->getVar('discount') == '') {
            $discount = null;
        } else {
            $discount = $this->request->getVar('discount');
        }
        if ($this->request->getVar('available_kupon') <= 0) {
            $available_kupon = 0;
        } else {
            $available_kupon = $this->request->getVar('available_kupon');
        }
        $data = [
            'nama' => $this->request->getVar('nama_kupon'),
            'kode' => $this->request->getVar('kode_kupon'),
            'deskripsi' => $this->request->getVar('deskripsi_kupon'),
            'discount' => $discount,
            'total_buy' => $this->request->getvar('total_buy'),
            'available_kupon' => $available_kupon,
            'is_active' => $is_active,
            'created_by' => user_id()
        ];
        // dd($data);
        //validate data
        if (!$this->validateData($data, $kuponModel->validationRules)) {
            return redirect()->to('dashboard/kupon/tambah-kupon')->withInput();
        }
        if ($kuponModel->save($data)) {
            session()->setFlashdata('success', 'Berhasil menambahkan kupon');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Berhasil menambahkan kupon'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/kupon');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada input kupon'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/kupon/tambah-kupon')->withInput();
        }
    }

    // delete
    public function deleteKupon($id)
    {

        $kuponModel = new KuponModel();
        $deleted = $kuponModel->delete($id);
        // dd($id);
        if ($deleted) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Produk Berhasil di Hapus'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/kupon');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Opps.. Terdapat Kesalahan pada penghapusan kupon'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/kupon')->withInput();
        }
    }

    // update
    public function editKupon($id)
    {
        $kuponModel = new KuponModel();
        $kp = $kuponModel->find($id);
        $data = [
            'title' => 'Edit Kupon',
            'kp' => $kp,
            'back' => 'dashboard/kupon'
        ];
        return view('dashboard/kupon/editKupon', $data);
    }
    // save update
    public function updateKupon($id)
    {
        $kuponModel = new KuponModel();
        // $id = $this->request->getVar('id_kupon');
        if ($this->request->getVar('is_active') == 1) {
            $is_active = 1;
        } else {
            $is_active = 0;
        }
        if ($this->request->getVar('discount') == '') {
            $discount = null;
        } else {
            $discount = $this->request->getVar('discount');
        }
        if ($this->request->getVar('available_kupon') <= 0) {
            $available_kupon = 0;
        } else {
            $available_kupon = $this->request->getVar('available_kupon');
        }
        $data = [
            'id_kupon' => $id,
            'nama' => $this->request->getVar('nama_kupon'),
            'kode' => $this->request->getVar('kode_kupon'),
            'deskripsi' => $this->request->getVar('deskripsi_kupon'),
            'discount' => $discount,
            'total_buy' => $this->request->getvar('total_buy'),
            'available_kupon' => $available_kupon,
            'is_active' => $is_active,
            'created_by' => user_id()
        ];
        // dd($data);
        if (!$this->validateData($data, $kuponModel->validationRules)) {

            return redirect()->to('dashboard/kupon/edit-kupon/' . $id)->withInput();
        }
        if ($kuponModel->save($data)) {
            // echo "Available Kupon: " . $data['available_kupon'];
            session()->setFlashdata('success', 'Kupon berhasil diubah.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data Kupon berhasil diubah.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/kupon');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/kupon/kupon/edit-kupon/' . $id)->withInput();
        }
    }
}
