<?php

namespace App\Controllers;

use App\Models\KategoriModel;

class AdminkategoriController extends BaseController
{
    // tampilkan dasboard
    public function index()
    {
        $kategoriModel = new KategoriModel();
        $kategori_list = $kategoriModel->findAll();

        $data = [
            'title' => 'Kategori',
            'kategori_model' => $kategori_list
        ];
        return view('dashboard/kategori', $data);
    }
    // Save ke database
    public function save()
    {
        // dd($this->request->getVar());
        $kategoriModel = new KategoriModel();
        $slug = url_title($this->request->getVar('kategori'), '-', true);
        $data = [
            'slug' => $slug,
            'nama_kategori' => $this->request->getVar('kategori'),
            'deskripsi' => $this->request->getVar('deskripsi'),
        ];

        if ($kategoriModel->save($data)) {
            session()->setFlashdata('success', 'Data Kategori Berhasil disimpan');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data kategori berhasil disimpan.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/kategori');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada input kategori'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/kategori/create-kategori')->withInput();
        };
    }

    // Update ke database
    public function update($id)
    {
        session();
        $kategoriModel = new KategoriModel();
        $data = [
            'title' => 'Edit Kategori',
        ];
        return view('dashboard/kategori/upate', $data);
    }

    public function edit($id)
    {
        $kategoriModel = new KategoriModel();
        $slug = url_title($this->request->getVar('kategori'), '-', true);
        $data = [
            'slug' => $slug,
            'nama_kategori' => $this->request->getVar('kategori'),
            'deskripsi' => $this->request->getVar('deskripsi'),
        ];
    }


    // Delete ke database
    public function deleteKategori($id)
    {
        $kategoriModel = new KategoriModel();
        $deleted = $kategoriModel->delete($id);
        // dd($id);
        if ($deleted) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Kategori berhasil di hapus.'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/kategori');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada penghapusan data'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/kategori')->withInput();
        }
    }
}
