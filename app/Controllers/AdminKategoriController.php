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
        // ambil gambar
        $fotoKategori = $this->request->getFile('gambar_kategori');
        if ($fotoKategori->getError() == 4) {
            # code...
            $nama_kategori = 'default.png';
        } else {
            $nama_kategori = $fotoKategori->getRandomName();
            $fotoKategori->move('assets/img/kategori/', $nama_kategori);
        }
  
        // dd($this->request->getVar());
        $kategoriModel = new KategoriModel();
        $slug = url_title($this->request->getVar('kategori'), '-', true);
        $data = [
            'slug' => $slug,
            'nama_kategori' => $this->request->getVar('kategori'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'img' => $nama_kategori,
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
        // Instansiasi model kategori
        $kategoriModel = new KategoriModel();
        $image = $this->request->getFile('gambar_kategori');

        if ($image->getError() == 4) {
            $namaKategoriImage = $this->request->getVar('imageLama');
        } else {
            $kategori = $kategoriModel->find($id);

            if ($kategori['img'] == 'default.png') {
                $namaKategoriImage = $image->getRandomName();
                $image->move('assets/img/kategori', $namaKategoriImage);
            } else {
                $namaKategoriImage = $image->getRandomName();
                $image->move('assets/img/kategori', $namaKategoriImage);
                $gambarLamaPath = 'assets/img/kategori' . $this->request->getVar('imageLama');
                if (file_exists($gambarLamaPath)) {
                    unlink($gambarLamaPath);
                }
            }
        }
        $slug = url_title($this->request->getVar('kategori'), '-', true);
        $data = [
            'slug' => $slug,
            'id_kategori' => $id,
            'img' => $namaKategoriImage,
            'nama_kategori' => $this->request->getVar('kategori'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            
        ];
        // dd($id);
        if ($kategoriModel->save($data)) {
            session()->setFlashdata('success', 'Kategori beerhasil diubah');
            $alert = [
                'type' => 'success',
                'title' => 'berhasil',
                'message' => 'Data Kategori Bwrhasil diubah.'

            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/kategori');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat Kesalahan pada pengisian data kategori.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/kategori')->withInput();
    
        }
    }







    // public function updateKategori($id)
    // {
    //     // Instansiasi model kategori
    //     $kategoriModel = new KategoriModel();
    //     $image = $this->request->getFile('gambar_kategori');


    //     if ($image->getError() != 4) {
    //         // Jika tidak ada gambar yang diunggah, gunakan gambar lama
    //         $namaKategoriImage = $this->request->getVar('imageLama');
    //     } else {
    //         //ada gambar baru yang diunggah, proses gambar baru
    //         if ($kategori['img'] != 'default.png' || $image->getError() == 4) {
    //             $namaKategoriImage = $image->getRandomName();
    //             $image->move('assets/img/kategori', $namaKategoriImage);

    //             //Hapus gambar Lama
    //             if ($this->request->getVar('imageLama') != 'default.png') {
    //                 unlink('assets/img/kategori' . $this->request->getVar('imageLama'));
    //             }
    //         }
    //     }
    //     $slug = url_title($this->request->getVar('kategori'), '-', true);
    //     $data = [
    //         'slug' => $slug,
    //         'id_kategori' => $id,
    // 'nama_kategori' => $this->request->getVar('nama_kategori'),
    // 'deskripsi' => $this->request->getVar('deskripsi'),

    //     ];

    //     // Jika ada gambar baru yang diunggah, proses gambar baru
    //     if (!empty($data)) {
    //         //Gunakan variabel $kategoriModel yang telah diinisialisasi dengan benar
    //         if ($km && $kategoriModel->save($data)) {
    //             session()->setFlashdata('success', 'Kategori Berhasil diubah.');
    //             $alert = [
    //                 'type' => 'success',
    //                 'title' => 'Berhasil',
    //                 'message' => 'Data Kategori berhsil diubah.'
    //             ];
    //             session()->setFlashdata('alert', $alert);

    //             return redirect()->to('dashboard/kategori');
    //         } else {
    //             $alert = [
    //                 'type' => 'error',
    //                 'title' => 'Error',
    //                 'message' => 'Terdapat kesalahan pada pengisian data kategori'
    //             ];
    //             session()->setFlashdata('alert', $alert);
    //             return redirect()->to('dashboard/kategori');
    //         }
    //     }
    // }





}
