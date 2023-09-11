<?php

namespace App\Controllers;

use App\Models\KuponModel;
use App\Models\ProdukModel;

class AdminKupon extends BaseController
{
    public function kupon()
    {
        $kuponModel = new KuponModel();
        $kupon_list = $kuponModel->findAll();
        $data = [
            'title' => 'kupon',
            'kupon_Model' => $kupon_list
        ];
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
        $data = [
            'nama' => $this->request->getVar('nama_kupon'),
            'kode' => $this->request->getVar('kode_kupon'),
            'deskripsi' => $this->request->getVar('deskripsi_kupon'),
            'discount' => $this->request->getVar('discount'),
            'total_buy' => $this->request->getvar('total_buy'),
            'is_active' => $this->request->getVar('masa_berlaku'),
        ];

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
        $kp = $kuponModel->find($id);
        $data = [
            'id_kupon' => $id,
            'nama' => $this->request->getVar('nama_kupon'),
            'kode' => $this->request->getVar('kode_kupon'),
            'deskripsi' => $this->request->getVar('deskripsi_kupon'),
            'discount' => $this->request->getVar('discount'),
            'total_buy' => $this->request->getvar('total_buy'),
            'is_active' => $this->request->getVar('masa_berlaku'),
        ];

        if ($kuponModel->save($data)) {
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
