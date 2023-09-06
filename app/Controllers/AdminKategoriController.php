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

    // Tampilan Input Kategori
    public function tambahKategori()
    {
        $kategoriModel = new KategoriModel();
        $kategori_list = $kategoriModel->findAll();

        $data = [
            'title' => 'Kategori',
            'kategori_model' => $kategori_list
        ];
        return view('dashboard/tambahKategori', $data);
    }
    // Save ke database
    public function saveKategori()
    {
        // dd($this->request->getVar());
        $kategoriModel = new KategoriModel();
        $slug = url_title($this->request->getVar('kategori'), '-', true);
        $data = [
            'slug' => $slug,
            'nama_kategori' => $this->request->getVar('kategori'),
            'deskripsi' => $this->request->getVar('deskripsi'),
        ];
        // dd($data);
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
            return redirect()->to('dashboard/kategori',)->withInput();
        };
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


    // tampilan Form Edit Kategori
    public function editKategori($id)
    {
        // Instansiasi model kategori
        $kategoriModel = new KategoriModel();

        // Ambil data kategori berdasarkan ID
        $kategori = $kategoriModel->find($id);

        if ($kategori === null) {
            // Kategori tidak ditemukan, mungkin berikan pesan kesalahan atau arahkan kembali ke halaman lain
            return redirect()->to(base_url('dashboard/kategori'))->with('error', 'Kategori tidak ditemukan.');
        }

        // Tampilkan formulir edit kategori
        return view('dashboard/editKategori', ['kategori' => $kategori]);
    }


    public function updateKategori($id)
    {
        // Ambil data yang dikirimkan dari formulir edit

        $nama_kategori = $this->request->getVar('kategori');
        $deskripsi = $this->request->getVar('deskripsi');
        $slug = url_title($nama_kategori, '-', true);
        $data = [
            'slug' => $slug,
            'id_kategori' => $id,
            'nama_kategori' => $nama_kategori,
            'deskripsi' => $deskripsi,

        ];

        // Instansiasi model kategori
        $kategoriModel = new KategoriModel();

        // Update data kategori berdasarkan ID
        if ($kategoriModel->save($data)) {
            session()->setFlashdata('success', 'Data kategori Berhasil diupdate');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data Kategori Berhasil diubah.'
            ];
            // Redirect ke halaman daftar kategori dengan pesan sukses
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/kategori');

        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisiam form Update kategori.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/kategori/edit-kategori/' . $id)->withInput();
        }
    }




    
}
