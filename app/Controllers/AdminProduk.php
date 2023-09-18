<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Models\SubKategoriModel;

class AdminProduk extends BaseController
{
    protected $imageModel;
    public function produk($id)
    {
        $produkModel = new ProdukModel();
        $kategoriModel = new KategoriModel();

        // Ambil semua produk
        $produk_list = $produkModel->findAll();

        // Ambil semua kategori (sesuaikan dengan model dan metode yang sesuai)
        $kategori_list = $kategoriModel->findAll();

        // Kirim data produk dan kategori ke tampilan
        $data = [
            'title' => 'Daftar Produk',
            'produk_Model' => $produk_list,
            'kategori_model' => $kategori_list,
        ];
    }

    public function tambahProduk()
    {
        $produkModel = new ProdukModel();
        $kategoriModel = new KategoriModel();
        $subKategoriModel = new SubKategoriModel();
        $produk_list = $produkModel->findAll();
        $kategori_list = $kategoriModel->findAll();
        $sub_kategori_list = $subKategoriModel->findAll();
        // $sub = [];
        // foreach ($kategori_list as $k) {
        //     foreach ($sub_kategori_list as $s) {
        //         if ($k['id_kategori'] == $s['id_sub_kategori']) {
        //             if (!isset($sub[$k['id_kategori']])) {
        //                 $sub[$k['id_kategori']] = $s['nama_kategori'];
        //             } else {
        //                 $sub[$k['id_kategori']] .= ', ' . $s['nama_kategori'];
        //             }
        //         }
        //     }
        // }
        // $output = array();
        // foreach ($sub as $id_kategori => $sub_kategori) {
        //     $output[] = "$id_kategori: [$sub_kategori]";
        // }
        // foreach ($output as $line) {
        //     echo $line . "\n";
        // }
        // $output = array();

        // // Mengelompokkan subkategori berdasarkan kategori
        // foreach ($kategori_list as $id_kategori => $nama_kategori) {
        //     $subkategori_kategori = array();
        //     foreach ($sub_kategori_list as $id_sub_kategori => $nama_sub_kategori) {
        //         $id_kategori_sub = $id_sub_kategori + 1; // Karena indeks array dimulai dari 0
        //         if ($id_kategori_sub == $id_kategori) {
        //             $subkategori_kategori[] = $nama_sub_kategori;
        //         }
        //     }
        //     if (!empty($subkategori_kategori)) {
        //         $output[] = "$id_kategori: " . json_encode($subkategori_kategori);
        //     }
        // }

        // // Menampilkan output
        // foreach ($output as $line) {
        //     echo $line . "\n";
        // }
        $data = [
            'title' => 'produk',
            'produk_Model' => $produk_list,
            'kategori' => $kategori_list,
            'subKategori' => $sub_kategori_list,
        ];
        // dd($data);
        return view('dashboard/produk/tambahProduk', $data);
    }
    // save
    public function save()
    {
        // ambil gambar
        $kategoriModel = new KategoriModel();
        $produkModel = new ProdukModel();
        $fotoProduk = $this->request->getFile('img');
        if ($fotoProduk->getError() == 4) {
            $namaProduk = 'default.png';
        } else {
            $namaProduk = $fotoProduk->getRandomName();
            $fotoProduk->move('assets/img/produk/main/', $namaProduk);
        }
        $slug = url_title($this->request->getVar('nama'), '-', true);
        $idKategori = $this->request->getVar('parent_kategori_id'); // Ambil ID kategori dari input select

        $data = [
            'slug' => $slug,
            'nama' => $this->request->getVar('nama'),
            'sku' => $this->request->getVar('sku'),
            'harga' => $this->request->getVar('harga'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'img' => $namaProduk,
            'id_kategori' => $idKategori, // Tambahkan ID kategori ke dalam data produk.
        ];

        // swet alert
        if ($produkModel->save($data)) {
            session()->setFlashdata('success', 'Produk berhasil disimpan.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Produk berhasil disimpan.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/produk/tambah-produk')->withInput();
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/produk/tambah-produk')->withInput();
        }
    }

    // view
    public function updateProduk($id)
    {
        session();

        $produkModel = new ProdukModel();

        $km = $produkModel->find($id);
        $data = [
            'title' => 'Edit Produk',
            'km' => $km,
            'back'  => 'dashboard/tambah-produk'
        ];
        return view('dashboard/produk/updateProduk', $data);
    }
    // action
    public function editProduk($id)
    {
        $produkModel = new ProdukModel();
        $image = $this->request->getFile('img');

        if ($image->getError() == 4) {
            $namaProdukImage = $this->request->getVar('imageLama');
        } else {
            $produk = $produkModel->find($id);

            if ($produk['img'] == 'default.png') {
                $namaProdukImage = $image->getRandomName();
                $image->move('assets/img/produk/main', $namaProdukImage);
            } else {
                $namaProdukImage = $image->getRandomName();
                $image->move('assets/img/produk/main', $namaProdukImage);
                $gambarLamaPath = 'assets/img/produk/main/' . $this->request->getVar('imageLama');
                if (file_exists($gambarLamaPath)) {
                    unlink($gambarLamaPath);
                }
            }
        }
        $data = [
            'id_produk' => $id,
            'nama' => $this->request->getVar('nama'),
            'sku' => $this->request->getVar('sku'),
            'harga' => $this->request->getVar('harga'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'img' => $namaProdukImage
        ];
        // dd($data);
        if ($produkModel->save($data)) {
            session()->setFlashdata('success', 'Produk berhasil diubah.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Produk berhasil diubah.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/produk/tambah-produk');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/produk/tambah-produk/update-produk/' . $id)->withInput();
        }
    }

    // delete
    public function deleteProduk($id)
    {
        $produkModel = new ProdukModel();
        $produk = $produkModel->find($id);

        if ($produk['img'] != 'default.png') {
            $gambarLamaPath = 'assets/img/produk/main/' . $produk['img'];
            if (file_exists($gambarLamaPath)) {
                unlink($gambarLamaPath);
            }
        }
        $deleted = $produkModel->delete($id);
        // dd($id);
        if ($deleted) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Produk berhasil di hapus.'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/produk/tambah-produk');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada penghapusan produk'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/produk/tambah-produk')->withInput();
        }
    }
}
