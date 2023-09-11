<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\SubKategoriModel;
use App\Models\ProdukModel;

class AdminkategoriController extends BaseController
{
    // tampilkan dasboard
    public function index()
    {
        $kategoriModel = new KategoriModel();
        $subKategoriModel = new SubKategoriModel();
        $kategori_list = $subKategoriModel->joinTable();
        $kategoriGroups = [];

        foreach ($kategori_list as $km) {
            $id_kategori = $km->id_kategori;
            $id_sub_kategori = $km->id_sub_kategori;
            $namaKategori = $km->nama_kategori;
            $namaSubKategori = $km->nama_sub_kategori;
            $imgKategori = $km->img_kategori;
            $imgSubKategori = $km->img_sub_kategori;
            $slugKategori = $km->slug_kategori;
            $slugSubKategori = $km->slug_sub_kategori;
            // Jika nama_kategori belum ada dalam array, tambahkan sebagai elemen array baru
            if (!isset($kategoriGroups[$namaKategori])) {
                $kategoriGroups[$namaKategori] = [
                    'id_kategori' => $id_kategori,
                    'id_sub_kategori' => $id_sub_kategori,
                    'nama_kategori' => $namaKategori,
                    'img_kategori' => $imgKategori,
                    'img_sub_kategori' => $imgSubKategori,
                    'sub_kategori' => [],
                    'slug_kategori' => $slugKategori,
                    'slug_sub_kategori' => $slugSubKategori,
                ];
            }
            // Tambahkan sub_kategori ke dalam array sub_kategori di bawah nama_kategori yang sesuai
            $kategoriGroups[$namaKategori]['sub_kategori'][] = $namaSubKategori;
        }

        $data = [
            'title' => 'Kategori',
            'kategori_list' => $kategoriGroups
        ];

        // dd($data);
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
            $namaKategori = 'default.png';
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

            if ($produk['img'] == 'default.png') {
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

    // Delete Kategori
    public function deleteKategori($id)
    {
        $kategoriModel = new KategoriModel();
        $kategori = $kategoriModel->find($id);

        if ($kategori['img'] != 'default.png') {
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



    // =================================================================================================================
    // CONTROLLER SUB KATEGORI
    // =================================================================================================================



    // tampilan Form Edit Sub Kategori
    public function editSubKategori($id)
    {
        $subKategoriModel = new SubKategoriModel();
        $subKategori = $subKategoriModel->find($id);

        $kategoriModel = new KategoriModel();
        $kategori_list = $kategoriModel->findAll();

        $data = [
            'title' => 'Sub Kategori',
            'kategori_model' => $kategori_list,
            'subkategori' => $subKategori
        ];

        if ($subKategori === null) {
            return redirect()->to(base_url('dashboard/kategori/kategori'))->with('error', 'Kategori tidak ditemukan.');
        }

        return view('dashboard/kategori/editSubKategori', $data);
    }

    // Update Sub Kategori
    public function updateSubKategori($id)
    {
        $kategoriModel = new KategoriModel();
        $subKategoriModel = new SubKategoriModel();
        $kategori_list = $kategoriModel->findAll();
        $image = $this->request->getFile('img');

        if ($image->getError() == 4) {
            $namaSubKategoriImage = $this->request->getVar('imageLama');
        } else {
            $produk = $subKategoriModel->find($id);

            if ($produk['img'] == 'default.png') {
                $namaSubKategoriImage = $image->getRandomName();
                $image->move('assets/img/subkategori', $namaSubKategoriImage);
            } else {
                $namaSubKategoriImage = $image->getRandomName();
                $image->move('assets/img/subkategori', $namaSubKategoriImage);
                $gambarLamaPath = 'assets/img/subkategori/' . $this->request->getVar('imageLama');
                if (file_exists($gambarLamaPath)) {
                    unlink($gambarLamaPath);
                }
            }
        }
        $slug = url_title($this->request->getVar('sub_kategori'), '-', true);
        $parentKategoriId = $this->request->getVar('parent_kategori_id');
        $data = [
            'kategori_model' => $kategori_list,
            'id_kategori' => $parentKategoriId,
            'id_sub_kategori' => $id,
            'nama_kategori' => $this->request->getVar('kategori'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'slug' => $slug,
            'img' => $namaSubKategoriImage
        ];
        // dd($data);
        if ($subKategoriModel->save($data)) {
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

            return redirect()->to('dashboard/kategori/edit-sub-kategori/' . $id)->withInput();
        }
    }
    // Delete ke database
    public function deleteSubKategori($id)
    {
        $subKategoriModel = new SubKategoriModel();
        $produkModel = new ProdukModel();
        $subKategoriModel->find($id);

        $relatedProduct = $produkModel->where('id_sub_kategori', $id)->findAll();

        if (!empty($relatedProduct)) {
            foreach ($relatedProduct as $produk) {
                $produk['id_sub_kategori'] = null;
                $produkModel->save($produk);
            }
        }

        // if ($subKategori['img'] != 'default.png') {
        //     $gambarLamaPath = 'assets/img/subkategori/' . $subKategori['img'];
        //     if (file_exists($gambarLamaPath)) {
        //         unlink($gambarLamaPath);
        //     }
        // }

        $deleted = $subKategoriModel->delete($id);
        // dd($id);
        if ($deleted) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Sub Kategori berhasil di hapus.'
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
}
