<?php

namespace App\Controllers;

use App\Models\BannerModel;
use App\Models\BannerPopupModel;
use App\Models\BannerAdsKontenModel;
use App\Models\BannerContentModel;

class AdminBannerController extends BaseController
{

    // ===================================================================
    // ------------------------ TAMBAH KONTEN BANNER ---------------------
    // ===================================================================
    public function tambahKonten()
    {
        $contentModel = new BannerContentModel();
        $bannerList = $contentModel->findAll();
        $data = [
            'title' => 'Tambah Konten Banner',
            'banner_list' => $bannerList
        ];
        // dd($data);
        return view('/dashboard/banner/tambahKonten', $data);
    }
    public function saveContent()
    {
        // ambil gambar
        $contentModel = new BannerContentModel();

        $fotoBanner = $this->request->getFile('img');
        $data = [
            'title' => $this->request->getVar('title'),
            'img' => $fotoBanner
        ];
        //validate data
        if (!$this->validateData($data, $contentModel->validationRules) && !$this->validateData($data, [
            'img' => [
                'errors' => [
                    'uploaded' => 'Gambar content wajib diunggah.'
                ]
            ]
        ])) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/banner/tambah-konten')->withInput();
        }
        if ($fotoBanner->getError() == 4) {
            $namaBanner = 'pop-up-1.png';
        } else {
            $namaBanner = $fotoBanner->getRandomName();
            $fotoBanner->move('assets/img/banner/content/', $namaBanner);
        }

        //repalce data
        $data = [
            'title' => $this->request->getVar('title'),
            'img' => $namaBanner
        ];
        // dd($data);

        // swet alert
        if ($contentModel->save($data)) {
            session()->setFlashdata('success', 'Gambar pop up berhasil disimpan.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Gambar pop up berhasil disimpan.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/banner/pop-up-banner')->withInput();
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada upload pop up'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/banner/pop-up-banner')->withInput();
        }
    }


    // ===================================================================
    // ------------------------ END TAMBAH KONTEN BANNER -----------------
    // ===================================================================

    public function index(): string
    {
        $bannerModel = new BannerModel();
        $bannerList = $bannerModel->findAll();
        $data = [
            'title' => 'Setting Banner',
            'banner_list' => $bannerList
        ];
        return view('/dashboard/banner/banner', $data);
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
        $data = [
            'title' => $this->request->getVar('title'),
            'img' => $fotoBanner
        ];
        //validate data
        if (!$this->validateData($data, $bannerModel->validationRules) && !$this->validateData($data, [
            'img' => [
                'rules' => 'uploaded[img]',
                'errors' => [
                    'uploaded' => 'Gambar banner wajib diunggah.'
                ]
            ]
        ])) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/banner/tambah-banner')->withInput();
        }
        if ($fotoBanner->getError() == 4) {
            $namaBanner = 'banner-2.png';
        } else {
            $namaBanner = $fotoBanner->getRandomName();
            $fotoBanner->move('assets/img/banner/', $namaBanner);
        }

        //repalce data
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
    public function updateBannerSave($id)
    {
        $bannerModel = new BannerModel();

        // $id = $this->request->getVar('id_pop_up_banner');
        $image = $this->request->getFile('img');
        $data = [
            'id_banner' => $id,
            'img' => $image,
            'title' => $this->request->getVar('title'),
        ];

        //validate data
        if (!$this->validateData($data, $bannerModel->validationRules)) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/banner/update-banner/' . $id)->withInput();
        }

        if ($image->getError() == 4) {
            $namaBannerImage = $this->request->getVar('imageLama');
        } else {
            $produk = $bannerModel->find($id);

            if ($produk['img'] == 'banner-2.png') {
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

        // replace data 
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

    public function listBanner(): string
    {
        $bannerModel = new BannerModel();
        $bannerList = $bannerModel->findAll();
        $data = [
            'title' => 'List Banner Aplikasi',
            'banner_list' => $bannerList
        ];
        return view('/dashboard/banner/bannerPilih', $data);
    }

    // =================================================================
    // ======================= POP UP BANNER ===========================
    // =================================================================

    public function popUp(): string
    {
        $bannerModel = new BannerPopupModel();
        $bannerList = $bannerModel->findAll();
        $data = [
            'title' => 'Banner Pop Up Homepage',
            'banner_list' => $bannerList
        ];
        return view('/dashboard/banner/popUp', $data);
    }

    public function savePopup()
    {
        // ambil gambar
        $bannerModel = new BannerPopupModel();

        $fotoBanner = $this->request->getFile('img');
        $data = [
            'title' => $this->request->getVar('title'),
            'img' => $fotoBanner
        ];
        //validate data
        if (!$this->validateData($data, $bannerModel->validationRules) && !$this->validateData($data, [
            'img' => [
                'errors' => [
                    'uploaded' => 'Gambar pop up wajib diunggah.'
                ]
            ]
        ])) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/banner/pop-up-banner')->withInput();
        }
        if ($fotoBanner->getError() == 4) {
            $namaBanner = 'pop-up-1.png';
        } else {
            $namaBanner = $fotoBanner->getRandomName();
            $fotoBanner->move('assets/img/banner/popup/', $namaBanner);
        }

        //repalce data
        $data = [
            'title' => $this->request->getVar('title'),
            'img' => $namaBanner
        ];
        // dd($data);

        // swet alert
        if ($bannerModel->save($data)) {
            session()->setFlashdata('success', 'Gambar pop up berhasil disimpan.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Gambar pop up berhasil disimpan.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/banner/pop-up-banner')->withInput();
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada upload pop up'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/banner/pop-up-banner')->withInput();
        }
    }

    public function deletePopup($id)
    {
        $bannerModel = new BannerPopupModel();
        $banner = $bannerModel->find($id);

        if ($banner['img'] != 'default.jpg') {
            $gambarLamaPath = 'assets/img/banner/popup/' . $banner['img'];
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
                'message' => 'Gambar pop up berhasil di hapus.'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/banner/pop-up-banner');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada penghapusan gambar pop up'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/banner/pop-up-banner')->withInput();
        }
    }

    // view
    public function updatePopup($id)
    {
        $bannerModel = new BannerPopupModel();

        $bl = $bannerModel->find($id);
        $data = [
            'title' => 'Edit Pop Up Banner',
            'bl' => $bl,
            'back'  => 'dashboard/banner/pop-up-banner'
        ];
        return view('dashboard/banner/updatePopup', $data);
    }
    // action
    public function savePopupEdit()
    {
        $bannerModel = new BannerPopupModel();
        $id = $this->request->getVar('id_pop_up_banner');
        $image = $this->request->getFile('img');
        $data = [
            'id_pop_up_banner' => $id,
            'img' => $image,
            'title' => $this->request->getVar('title'),
        ];
        //validate data

        if (!$this->validateData($data, $bannerModel->validationRules)) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/banner/update-pop-up/' . $id)->withInput();
        }


        if ($image->getError() == 4) {
            $namaBannerImage = $this->request->getVar('imageLama');
        } else {
            $produk = $bannerModel->find($id);

            if ($produk['img'] == 'pop-up-1.png') {
                $namaBannerImage = $image->getRandomName();
                $image->move('assets/img/banner/popup', $namaBannerImage);
            } else {
                $namaBannerImage = $image->getRandomName();
                $image->move('assets/img/banner/popup', $namaBannerImage);
                $gambarLamaPath = 'assets/img/banner/popup/' . $this->request->getVar('imageLama');
                if (file_exists($gambarLamaPath)) {
                    unlink($gambarLamaPath);
                }
            }
        }

        // repalce data 
        $data = [
            'id_pop_up_banner' => $id,
            'img' => $namaBannerImage,
            'title' => $this->request->getVar('title'),
        ];

        if ($bannerModel->save($data)) {
            session()->setFlashdata('success', 'Gambar banner berhasil diubah.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Gambar pop up berhasil diubah.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/banner/pop-up-banner');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/banner/pop-up-banner/update-pop-up/' . $id)->withInput();
        }
    }

    // =================================================================
    // ======================= ADSVERTISEMENTS =========================
    // =================================================================

    public function kontenAds(): string
    {
        $bannerModel = new BannerAdsKontenModel();
        $bannerList = $bannerModel->findAll();
        $data = [
            'title' => 'Adsvertisements Konten',
            'banner_list' => $bannerList
        ];
        return view('/dashboard/banner/kontenAds', $data);
    }

    public function saveKontenAds()
    {
        // ambil gambar
        $bannerModel = new BannerAdsKontenModel();

        $fotoBanner = $this->request->getFile('img');
        $data = [
            'title' => $this->request->getVar('title'),
            'img' => $fotoBanner
        ];
        //validate data
        if (!$this->validateData($data, $bannerModel->validationRules) && !$this->validateData($data, [
            'img' => [
                'errors' => [
                    'uploaded' => 'Gambar adsvertisements wajib diunggah.'
                ]
            ]
        ])) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/banner/ads-konten-banner')->withInput();
        }
        if ($fotoBanner->getError() == 4) {
            $namaBanner = 'ads-1.jpg';
        } else {
            $namaBanner = $fotoBanner->getRandomName();
            $fotoBanner->move('assets/img/banner/ads/', $namaBanner);
        }

        //repalce data
        $data = [
            'title' => $this->request->getVar('title'),
            'img' => $namaBanner
        ];
        // dd($data);

        // swet alert
        if ($bannerModel->save($data)) {
            session()->setFlashdata('success', 'Gambar adsvertisements berhasil disimpan.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Gambar adsvertisements berhasil disimpan.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/banner/ads-konten-banner')->withInput();
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada upload gambar adsvertisements'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/banner/ads-konten-banner')->withInput();
        }
    }

    public function deleteKontenAds($id)
    {
        $bannerModel = new BannerAdsKontenModel();
        $banner = $bannerModel->find($id);

        if ($banner['img'] != 'default.jpg') {
            $gambarLamaPath = 'assets/img/banner/ads/' . $banner['img'];
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
                'message' => 'Gambar adsvertisements berhasil di hapus.'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/banner/ads-konten-banner');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada penghapusan gambar adsvertisements'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/banner/ads-konten-banner')->withInput();
        }
    }
    // view
    public function updateKontenAds($id)
    {
        $bannerModel = new BannerAdsKontenModel();

        $bl = $bannerModel->find($id);
        $data = [
            'title' => 'Edit Pop Up Banner',
            'bl' => $bl,
            'back'  => 'dashboard/banner/ads-konten-banner'
        ];
        return view('dashboard/banner/updateKontenAds', $data);
    }
    // action
    public function saveKontenAdsEdit()
    {
        $bannerModel = new BannerAdsKontenModel();
        $id = $this->request->getVar('id_ads_konten');
        $image = $this->request->getFile('img');
        $data = [
            'id_ads_konten' => $id,
            'img' => $image,
            'title' => $this->request->getVar('title'),
        ];
        //validate data

        if (!$this->validateData($data, $bannerModel->validationRules)) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/banner/update-ads-konten/' . $id)->withInput();
        }


        if ($image->getError() == 4) {
            $namaBannerImage = $this->request->getVar('imageLama');
        } else {
            $produk = $bannerModel->find($id);

            if ($produk['img'] == 'ads-1.jpg') {
                $namaBannerImage = $image->getRandomName();
                $image->move('assets/img/banner/ads', $namaBannerImage);
            } else {
                $namaBannerImage = $image->getRandomName();
                $image->move('assets/img/banner/ads', $namaBannerImage);
                $gambarLamaPath = 'assets/img/banner/ads/' . $this->request->getVar('imageLama');
                if (file_exists($gambarLamaPath)) {
                    unlink($gambarLamaPath);
                }
            }
        }

        // repalce data 
        $data = [
            'id_ads_konten' => $id,
            'img' => $namaBannerImage,
            'title' => $this->request->getVar('title'),
        ];

        if ($bannerModel->save($data)) {
            session()->setFlashdata('success', 'Gambar banner berhasil diubah.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Gambar pop up berhasil diubah.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/banner/ads-konten-banner');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/banner/update-ads-konten/' . $id)->withInput();
        }
    }
}
