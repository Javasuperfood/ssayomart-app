<?php

namespace App\Controllers;

use App\Models\BannerModel;

class AdminInputBanner extends BaseController
{
    public function inputbanner(): string
    {
        $bannerModel = new BannerModel();
        $bannerList = $bannerModel->findAll();
        $data = [
            'title' => 'Setting Banner',
            'banner_list' => $bannerList
        ];
        return view('/dashboard/banner/inputbanner', $data);
    }

    public function tambahBanner(): string
    {
        $bannerModel = new BannerModel();
        $bannerList = $bannerModel->findAll();
        $data = [
            'title' => 'Setting Banner',
            'banner_list' => $bannerList
        ];
        return view('dashboard/banner/tambahBanner', $data);
    }

    public function saveBanner()
    {
        // ambil gambar
        $bannerModel = new BannerModel();
        $fotoBanner = $this->request->getFile('img');
        if ($fotoBanner->getError() == 4) {
            $namaBanner = 'default.jpg';
        } else {
            $namaBanner = $fotoBanner->getRandomName();
            $fotoBanner->move('assets/img/banner/', $namaBanner);
        }
        $data = [
            'title' => $this->request->getVar('title'),
            'img' => $namaBanner
        ];
        // dd($data);

        // swet alert
        if ($bannerModel->save($data)) {
            session()->setFlashdata('success', 'Gambar banner berhasil disimpan.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Gambar banner berhasil disimpan.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/banner/tambah-banner')->withInput();
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/banner/tambah-banner')->withInput();
        }
    }

    public function deleteBanner($id)
    {
        $bannerModel = new BannerModel();
        $banner = $bannerModel->find($id);

        if ($banner['img'] != 'default.jpg') {
            $gambarLamaPath = 'assets/img/banner/' . $banner['img'];
            if (file_exists($gambarLamaPath)) {
                unlink($gambarLamaPath);
            }
        }
        $deleted = $bannerModel->delete($id);
        // dd($id);
        if ($deleted) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Gambar banner berhasil di hapus.'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/banner/tambah-banner');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada penghapusan gambar banner'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/banner/tambah-banner')->withInput();
        }
    }
    // view
    public function updateBanner($id)
    {
        session();

        $bannerModel = new BannerModel();

        $bl = $bannerModel->find($id);
        $data = [
            'title' => 'Edit Banner',
            'bl' => $bl,
            'back'  => 'dashboard/banner/tambah-banner'
        ];
        return view('dashboard/banner/updateBanner', $data);
    }
    // action
    public function editBanner($id)
    {
        $bannerModel = new BannerModel();
        $image = $this->request->getFile('img');

        if ($image->getError() == 4) {
            $namaBannerImage = $this->request->getVar('imageLama');
        } else {
            $produk = $bannerModel->find($id);

            if ($produk['img'] == 'default.jpg') {
                $namaBannerImage = $image->getRandomName();
                $image->move('assets/img/banner', $namaBannerImage);
            } else {
                $namaBannerImage = $image->getRandomName();
                $image->move('assets/img/banner', $namaBannerImage);
                $gambarLamaPath = 'assets/img/banner/' . $this->request->getVar('imageLama');
                if (file_exists($gambarLamaPath)) {
                    unlink($gambarLamaPath);
                }
            }
        }
        $data = [
            'id_banner' => $id,
            'img' => $namaBannerImage,
            'title' => $this->request->getVar('title'),
        ];

        if ($bannerModel->save($data)) {
            session()->setFlashdata('success', 'Gambar banner berhasil diubah.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Gambar banner berhasil diubah.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/banner/tambah-banner');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/banner/tambah-banner/update/' . $id)->withInput();
        }
    }
}
