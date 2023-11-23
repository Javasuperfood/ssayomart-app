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
            $imgKategori = $km->img;
            $imgSubKategori = $km->img_sub_kategori;
            $slugKategori = $km->slug;
            $slugSubKategori = $km->slug_sub_kategori;
            // Jika nama_kategori belum ada dalam array, tambahkan sebagai elemen array baru
            if (!isset($kategoriGroups[$namaKategori])) {
                $kategoriGroups[$namaKategori] = [
                    'id_kategori' => $id_kategori,
                    'nama_kategori' => $namaKategori,
                    'img_kategori' => $imgKategori,
                    'slug_kategori' => $slugKategori,
                    'sub_kategori' => [],
                ];
            }
            // Tambahkan sub_kategori ke dalam array sub_kategori di bawah nama_kategori yang sesuai
            $kategoriGroups[$namaKategori]['sub_kategori'][] = [
                'id_sub_kategori' => $id_sub_kategori,
                'nama_sub_kategori' => $namaSubKategori,
                'slug_sub_kategori' => $slugSubKategori,
                'img_sub_kategori' => $imgSubKategori,
            ];
        }

        $data = [
            'title' => 'Kategori',
            'kategori_list' => $kategoriGroups
        ];

        // dd($data['kategori_list']);
        return view('dashboard/kategori/kategori', $data);
    }

    // Tampilan Input Kategori
    public function tambahKategori()
    {
        $kategoriModel = new KategoriModel();
        $kategori = $kategoriModel->findAll();

        $data = [
            'title' => 'Kategori',
            'kategori' => $kategori
        ];
        return view('dashboard/kategori/tambahKategori', $data);
    }

    public function tambahKategori2()
    {
        $kategoriModel = new KategoriModel();
        $kategori = $kategoriModel->findAll();

        $data = [
            'title' => 'Kategori',
            'kategori' => $kategori
        ];
        return view('dashboard/kategori/tambahKategori2', $data);
    }

    // Save ke database
    public function saveKategori()
    {
        // ambil gambar
        $kategoriModel = new KategoriModel();
        $subKategoriModel = new SubKategoriModel();
        $slug = url_title($this->request->getVar('kategori'), '-', true);
        $parentKategoriId = $this->request->getVar('parent_kategori_id');
        $data = [
            'nama_kategori' => $this->request->getVar('kategori'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'img' => $this->request->getFile('img'),
            'slug' => $slug,
            'id_kategori' => $parentKategoriId,
        ];
        //validate
        if (!$this->validateData($data, $kategoriModel->validationRules)) {
            return redirect()->to('dashboard/kategori/tambah-kategori')->withInput();
        }

        $fotoKategori = $this->request->getFile('img');

        if ($fotoKategori->getError() == 4) {
            $namaKategori = 'default.png';
        } else {
            $namaKategori = $fotoKategori->getRandomName();
            $fotoKategori->move('assets/img/kategori/', $namaKategori);
        }

        //replace data value
        $data = [
            'nama_kategori' => $this->request->getVar('kategori'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'img' => $namaKategori,
            'slug' => $slug,
            'id_kategori' => $parentKategoriId,
        ];
        // dd($data);
        // Save sub kategori 
        if ($parentKategoriId != "") {
            if ($subKategoriModel->save($data)) {
                session()->setFlashdata('success', 'Kategori berhasil disimpan.');
                $alert = [
                    'type' => 'success',
                    'title' => 'Berhasil',
                    'message' => 'Kategori berhasil disimpan.'
                ];
                session()->setFlashdata('alert', $alert);

                return redirect()->to('dashboard/kategori')->withInput();
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
        // Save perent kategori
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
        $slug = url_title($this->request->getVar('kategori'), '-', true);
        $image = $this->request->getFile('img');
        $data = [
            'id_kategori' => $id,
            'nama_kategori' => $this->request->getVar('kategori'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'slug' => $slug,
            'img' => $image
        ];

        // validate data
        if (!$this->validateData($data, $kategoriModel->validationRules)) {
            return redirect()->to(base_url('dashboard/kategori/edit-kategori/' . $id))->withInput();
        }

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

            return redirect()->to('dashboard/kategori');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/kategori/edit-kategori/update' . $id)->withInput();
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

        $ProdukModel = new ProdukModel();
        $produk = $ProdukModel->where('id_kategori', $id)->findAll();
        if (!empty($produk)) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat produk yang terhubung dengan kategori ini. Hapus produk terlebih dahulu.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/kategori');
        }

        $deleted = $kategoriModel->delKategori($id);
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



    // ===========================================================================
    // CONTROLLER SUB KATEGORI
    // ===========================================================================



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
    public function updateSubKategori()
    {
        $subKategoriModel = new SubKategoriModel();
        $id = $this->request->getVar('id_sub_kategori');
        $image = $this->request->getFile('img');

        $parentKategoriId = $this->request->getVar('parent_kategori_id');
        $data = [
            'id_kategori' => $parentKategoriId,
            'id_sub_kategori' => $id,
            'nama_kategori' => $this->request->getVar('kategori'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'img' => $image,
        ];

        //validate data
        if (!$this->validateData($data, $subKategoriModel->validationRules)) {
            return redirect()->to(base_url('dashboard/kategori/edit-sub-kategori/' . $id))->withInput();
        }

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
        $slug = url_title($this->request->getVar('kategori'), '-', true);
        // Replace Data
        $data = [
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
                'message' => 'Sub Kategori berhasil diubah.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/kategori/');
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

        $ProdukModel = new ProdukModel();
        $produk = $ProdukModel->where('id_sub_kategori', $id)->findAll();
        if (!empty($produk)) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat produk yang terhubung dengan sub-kategori ini. Hapus produk terlebih dahulu.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/kategori');
        }

        $deleted = $subKategoriModel->delSubKategori($id);
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
    // =================================================================================================================
    // CONTROLLER SUB KATEGORI
    // =================================================================================================================
    public function editKategoriShort()
    {
        $kategoriModel = new KategoriModel();

        return view('dashboard/kategori/editShortKategori', ['kategori' => $kategoriModel->orderBy('short', SORT_ASC)->findAll()]);
    }
    public function saveKategoriShort()
    {
        $kategoriModel = new KategoriModel();
        $item = $this->request->getVar('id_kategori');
        $j = 1;
        // dd($item);
        foreach ($item as $i) {
            $kategoriModel->save([
                'id_kategori' => $i,
                'short' => $j++
            ]);
        }

        $alert = [
            'type' => 'success',
            'title' => 'Berhasil',
            'message' => 'Urutan Kategori berhasil di ubah.'
        ];
        session()->setFlashdata('alert', $alert);
        return redirect()->to('dashboard/kategori/shorting');
    }
}
