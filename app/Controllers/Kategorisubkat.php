<?php

namespace App\Controllers;

use App\Models\SubKategoriModel;
class Kategorisubkat extends BaseController
{
    public function kategorisubkat(): string
    {
        $data = [
            'title' => 'Kategorisubkat'
        ];
        return view('/dashboard/kategorisubkat', $data);
    }

    //error code 
    // public function save()
    // {
    //     $slug =url_title($this->request->getVar('kategori'), '-' true)
    //     $this->SubKategoriModel->save([
    //         'kategori' => $this-> getVar('kategori'),
    //         'slug' => $this->request-> getVar('slug'),
    //         'deskripsi' => $this->request-> getVar('deskripsi')
    //     ]);

    //     return redirect()->to('/dashboard');

    // }

    public function save()
    {
        $SubKategoriModel = new SubKategoriModel(); // Ganti dengan model yang sesuai

        $data = [
            'kategori' => $this->request->getPost('kategori'),
            'slug' => $this->request->getPost('slug'),
            'induk_kategori' => $this->request->getPost('induk_kategori'),
            'deskripsi' => $this->request->getPost('deskripsi')
        ];

        $SubKategoriModel->insert($data); // Simpan data ke dalam tabel

        return redirect()->to('/dashboard/kategorisubkat'); // Redirect kembali ke halaman kategorisubkat
    }


    public function view($id)
    {
        $SubKategoriModel = new SubKategoriModel(); // Ganti dengan model yang sesuai
        $kategori = $SubKategoriModel->findAll(); // Ambil data kategori berdasarkan ID

        $data = [
            'title' => 'View Kategori',
            'kategori' => $kategori
        ];

        return view('/dashboard/view_kategori', $data); // Ganti dengan nama view yang sesuai
    }

}
