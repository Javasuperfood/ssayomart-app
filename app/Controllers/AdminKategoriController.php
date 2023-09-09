<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\SubKategoriModel;

class AdminkategoriController extends BaseController
{
    // tampilkan dasboard
    public function index()
    {
        $kategoriModel = new KategoriModel();
        $subKategoriModel = new SubKategoriModel();
        $kategori_list = $subKategoriModel->joinTable();

        $data = [
            'title' => 'Kategori',
            'kategori_model' => $kategori_list
        ];
        return view('dashboard/kategori/kategori', $data);
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
        return view('dashboard/kategori/tambahKategori', $data);
    }

    // Save ke database
    public function saveKategori()
    {
        // ambil gambar
        $kategoriModel = new KategoriModel();
        $subKategoriModel = new SubKategoriModel();
        $fotoKategori = $this->request->getFile('img');

        if ($fotoKategori->getError() == 4) {
            $namaKategori = 'default.jpg';
        } else {
            $namaKategori = $fotoKategori->getRandomName();
            $fotoKategori->move('assets/img/kategori/', $namaKategori);
        }

        $slug = url_title($this->request->getVar('kategori'), '-', true);
        $parentKategoriId = $this->request->getVar('parent_kategori_id');

        $data = [
            'nama_kategori' => $this->request->getVar('kategori'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'img' => $namaKategori,
            'slug' => $slug,
            'id_kategori' => $parentKategoriId,
        ];
        // dd($data);
        if ($parentKategoriId != "") {
            if ($subKategoriModel->save($data)) {
                session()->setFlashdata('success', 'Kategori berhasil disimpan.');
                $alert = [
                    'type' => 'success',
                    'title' => 'Berhasil',
                    'message' => 'Kategori berhasil disimpan.'
                ];
                session()->setFlashdata('alert', $alert);

                return redirect()->to('dashboard/kategori/tambah-kategori')->withInput();
            } else {
                $alert = [
                    'type' => 'error',
                    'title' => 'Error',
                    'message' => 'Terdapat kesalahan pada pengisian formulir'
                ];
                session()->setFlashdata('alert', $alert);

                return redirect()->to('dashboard/kategori/tambah-kategori')->withInput();
            }
        }
        // swet alert
        if ($kategoriModel->save($data)) {
            session()->setFlashdata('success', 'Kategori berhasil disimpan.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Kategori berhasil disimpan.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/kategori/tambah-kategori')->withInput();
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/kategori/tambah-kategori')->withInput();
        }
    }

    // Delete ke database
    public function deleteKategori($id)
    {
        $kategoriModel = new KategoriModel();
        $kategori = $kategoriModel->find($id);

        if ($kategori['img'] != 'default.jpg') {
            $gambarLamaPath = 'assets/img/kategori/' . $kategori['img'];
            if (file_exists($gambarLamaPath)) {
                unlink($gambarLamaPath);
            }
        }
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
                'message' => 'Terdapat kesalahan pada penghapusan kategori'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/kategori')->withInput();
        }
    }

    // tampilan Form Edit Kategori
    public function editKategori($id)
    {
        $kategoriModel = new KategoriModel();

        $kategori = $kategoriModel->find($id);

        if ($kategori === null) {
            return redirect()->to(base_url('dashboard/kategori/kategori'))->with('error', 'Kategori tidak ditemukan.');
        }

        return view('dashboard/kategori/editKategori', ['kategori' => $kategori]);
    }

    public function updateKategori($id)
    {
        $kategoriModel = new KategoriModel();
        $image = $this->request->getFile('img');

        if ($image->getError() == 4) {
            $namaKategoriImage = $this->request->getVar('imageLama');
        } else {
            $produk = $kategoriModel->find($id);

            if ($produk['img'] == 'default.jpg') {
                $namaKategoriImage = $image->getRandomName();
                $image->move('assets/img/kategori', $namaKategoriImage);
            } else {
                $namaKategoriImage = $image->getRandomName();
                $image->move('assets/img/kategori', $namaKategoriImage);
                $gambarLamaPath = 'assets/img/kategori/' . $this->request->getVar('imageLama');
                if (file_exists($gambarLamaPath)) {
                    unlink($gambarLamaPath);
                }
            }
        }
        $slug = url_title($this->request->getVar('kategori'), '-', true);
        $data = [
            'id_kategori' => $id,
            'nama_kategori' => $this->request->getVar('kategori'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'slug' => $slug,
            'img' => $namaKategoriImage
        ];
        // dd($data);
        if ($kategoriModel->save($data)) {
            session()->setFlashdata('success', 'Kategori berhasil diubah.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Kategori berhasil diubah.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/kategori/kategori');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/kategori/edit-kategori/' . $id)->withInput();
        }
    }
}
