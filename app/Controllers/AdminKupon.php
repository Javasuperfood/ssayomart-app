<?php

namespace App\Controllers;

use App\Models\KuponModel;

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
        return view('dashboard/kupon', $data);
    }

    public function tambahKupon()
    {

        $data = [
            'title' => 'tambahKupon',
        ];
        return view('dashboard/tambahKupon', $data);
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

            return redirect()->to('dashboard/tambah-kupon')->withInput();
        }
    }
}
