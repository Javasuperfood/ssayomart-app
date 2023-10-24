<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PromoModel;
use App\Models\PromoItemModel;
use App\Models\ProdukModel;
use App\Models\VariasiItemModel;

class AdminPromoController extends BaseController
{
    public function tambahPromo()
    {
        $promoModel = new PromoModel();
        $promoList = $promoModel->findAll();
        $data = [
            'promo' => $promoList
        ];
        // dd($data);
        return view('dashboard/promo/tambahPromo', $data);
    }
    // Save
    public function savePromo()
    {
        // ambil gambar
        $promoModel = new PromoModel();
        $fotoPromo = $this->request->getFile('img');

        if ($fotoPromo->getError() == 4) {
            $namaPromo = 'default.png';
        } else {
            $namaPromo = $fotoPromo->getRandomName();
            $fotoPromo->move('assets/img/promo/', $namaPromo);
        }

        $slug = url_title($this->request->getVar('title'), '-', true);
        $data = [
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'img' => $namaPromo,
            'start_at' => $this->request->getVar('started'),
            'end_at' => $this->request->getVar('ended'),
            'deskripsi' => $this->request->getVar('deskripsi')
        ];
        // swet alert
        if ($promoModel->save($data)) {
            session()->setFlashdata('success', 'Promosi terbaru berhasil disimpan.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Promosi terbaru berhasil disimpan.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/promo/tambah-promo')->withInput();
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/promo/tambah-promo')->withInput();
        }
    }

    // Delete
    public function deletePromo($id)
    {
        $promoModel = new PromoModel();
        $promo = $promoModel->find($id);

        if ($promo['img'] != 'default.png') {
            $gambarLamaPath = 'assets/img/promo/' . $promo['img'];
            if (file_exists($gambarLamaPath)) {
                unlink($gambarLamaPath);
            }
        }

        $deleted = $promoModel->delete($id);
        if ($deleted) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data promo berhasil di hapus.'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/promo/tambah-promo');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada penghapusan kategori'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/promo/tambah-promo')->withInput();
        }
    }

    // Update
    public function updatePromo($id)
    {
        session();

        $promoModel = new PromoModel();

        $promo = $promoModel->find($id);
        $data = [
            'title' => 'Edit Banner',
            'promo' => $promo,
            'back'  => 'dashboard/promo/tambah-promo'
        ];
        return view('dashboard/promo/updatePromo', $data);
    }
    // Update Acgtion
    public function editPromo($id)
    {
        $promoModel = new PromoModel();
        $image = $this->request->getFile('img');

        if ($image->getError() == 4) {
            $namaPromoImage = $this->request->getVar('imageLama');
        } else {
            $produk = $promoModel->find($id);

            if ($produk['img'] == 'default.jpg') {
                $namaPromoImage = $image->getRandomName();
                $image->move('assets/img/promo', $namaPromoImage);
            } else {
                $namaPromoImage = $image->getRandomName();
                $image->move('assets/img/promo', $namaPromoImage);
                $gambarLamaPath = 'assets/img/promo/' . $this->request->getVar('imageLama');
                if (file_exists($gambarLamaPath)) {
                    unlink($gambarLamaPath);
                }
            }
        }
        $slug = url_title($this->request->getVar('title'), '-', true);
        $data = [
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'img' => $namaPromoImage,
            'start_at' => $this->request->getVar('started'),
            'end_at' => $this->request->getVar('ended'),
            'deskripsi' => $this->request->getVar('deskripsi')
        ];

        if ($promoModel->save($data)) {
            session()->setFlashdata('success', 'Gambar banner berhasil diubah.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data Promo berhasil diubah.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/promo/tambah-promo');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/promo/tambah-promo/update/' . $id)->withInput();
        }
    }

    // =============================================================================
    //                              PROMO ITEM CONTROLLER
    // =============================================================================
    public function tambahPromoItem()
    {
        $promoModel = new PromoModel();
        $produkModel = new ProdukModel();
        $promoItemModel = new PromoItemModel();
        $variasiItemModel = new VariasiItemModel();

        $promoList = $promoModel->findAll();
        $variasiList = $variasiItemModel->findAll();
        $produkList = $produkModel->findAll(); // Mengambil daftar produk
        $ongoingPromoItems = $promoItemModel->getOngoingPromoItems();

        $data = [
            'promo' => $promoList,
            'produk' => $produkList, // Mengirim daftar produk ke View
            'variasi' => $variasiList,
            'ongoingPromoItems' => $ongoingPromoItems
        ];
        // dd($data);
        return view('dashboard/promo/tambahPromoItem', $data);
    }

    public function savePromoItem()
    {
        $promoItemModel = new PromoItemModel();

        $data = [
            'id_promo' => $this->request->getVar('promo'),
            'id_produk' => $this->request->getVar('produk_id'),
            'discount' => $this->request->getVar('discount'),
            'min' => $this->request->getVar('min')
        ];
        // dd($data);

        if ($promoItemModel->save($data)) {
            session()->setFlashdata('success', 'Promosi produk berhasil disimpan.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Promosi produk berhasil disimpan.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/promo/tambah-promo-item')->withInput();
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/promo/tambah-promo-item')->withInput();
        }
    }

    public function deletePromoItem($id)
    {
        $promoItemModel = new PromoItemModel();
        $promoItemModel->find($id);

        $deleted = $promoItemModel->delete($id);
        // dd($id);
        if ($deleted) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Promo item produk berhasil di hapus.'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/promo/tambah-promo-item');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada penghapusan data'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/promo/tambah-promo-item')->withInput();
        }
    }
}
