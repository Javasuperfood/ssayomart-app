<?php

namespace App\Controllers;

use App\Models\BannerModel;
use App\Models\BannerPopupModel;
use App\Models\BannerAdsKontenModel;
use App\Models\BannerPromotionModel;
use App\Models\KategoriModel;

class AdminBannerController extends BaseController
{
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
        $fotoContent = $this->request->getFile('img_konten');
        $data = [
            'title' => $this->request->getVar('title'),
            'img' => $fotoBanner,
            'img_konten' => $fotoContent,
            'deskripsi' => $this->request->getVar('deskripsi')
        ];
        //validate data
        if (!$this->validateData($data, $bannerModel->validationRules) && !$this->validateData($data, [
            'img' => [
                'rules' => 'uploaded[img]',
                'errors' => [
                    'uploaded' => 'Gambar banner wajib diunggah.'
                ]
            ],
            'img_konten' => [
                'rules' => 'uploaded[img]',
                'errors' => [
                    'uploaded' => 'Gambar konten wajib diunggah.'
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
        // Homepage Banner
        if ($fotoBanner->getError() == 4) {
            $namaBanner = 'banner-2.png';
        } else {
            $namaBanner = $fotoBanner->getRandomName();
            $fotoBanner->move('assets/img/banner/', $namaBanner);
        }
        // Content Banner
        if ($fotoContent->getError() == 4) {
            $namaContent = 'content-1.jpg';
        } else {
            $namaContent = $fotoContent->getRandomName();
            $fotoContent->move('assets/img/banner/content/', $namaContent);
        }
        $data = [
            'title' => $this->request->getVar('title'),
            'img' => $namaBanner,
            'img_konten' => $namaContent,
            'deskripsi' => $this->request->getVar('deskripsi')
        ];
        // dd($data);

        // SWAL
        if ($bannerModel->save($data)) {
            session()->setFlashdata('success', 'Data banner konten berhasil disimpan.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data banner konten berhasil disimpan.'
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

        if ($banner['img_konten'] != 'default.jpg') {
            $contentLamaPath = 'assets/img/banner/content/' . $banner['img_konten'];
            if (file_exists($contentLamaPath)) {
                unlink($contentLamaPath);
            }
        }
        $deleted = $bannerModel->delete($id);
        // dd($id);
        if ($deleted) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data banner berhasil di hapus.'
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
    public function detailBanner($id)
    {
        $bannerModel = new BannerModel();

        $bl = $bannerModel->find($id);
        $data = [
            'title' => 'Edit Banner',
            'bl' => $bl,
            'back'  => 'dashboard/banner/tambah-banner'
        ];
        return view('dashboard/banner/detailBanner', $data);
    }
    // action
    public function detailBannerSave($id)
    {
        $bannerModel = new BannerModel();

        $image = $this->request->getFile('img');
        $imageContent = $this->request->getFile('img_konten');

        // Data awal dari database
        $bannerData = $bannerModel->find($id);

        // Mengecek apakah ada file img yang diupload
        if ($image->getError() != 4) {
            $namaBannerImage = $image->getRandomName();
            $image->move('assets/img/banner', $namaBannerImage);

            // Menghapus gambar lama jika tidak default
            if ($bannerData['img'] != 'banner-2.png') {
                $gambarLamaPath = 'assets/img/banner/' . $bannerData['img'];
                if (file_exists($gambarLamaPath)) {
                    unlink($gambarLamaPath);
                }
            }
        } else {
            // Jika tidak ada file img yang diupload, gunakan data lama
            $namaBannerImage = $bannerData['img'];
        }

        // Mengecek apakah ada file img_konten yang diupload
        if ($imageContent->getError() != 4) {
            $namaContentImage = $imageContent->getRandomName();
            $imageContent->move('assets/img/banner/content', $namaContentImage);

            // Menghapus gambar lama jika tidak default
            if ($bannerData['img_konten'] != 'default_content_image.png') {
                $gambarLamaPath = 'assets/img/banner/content/' . $bannerData['img_konten'];
                if (file_exists($gambarLamaPath)) {
                    unlink($gambarLamaPath);
                }
            }
        } else {
            // Jika tidak ada file img_konten yang diupload, gunakan data lama
            $namaContentImage = $bannerData['img_konten'];
        }

        $data = [
            'id_banner' => $id,
            'img' => $namaBannerImage,
            'img_konten' => $namaContentImage,
            'title' => $this->request->getVar('title'),
            'deskripsi' => $this->request->getVar('deskripsi')
        ];

        //validate data
        if (!$this->validateData($data, $bannerModel->validationRules)) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/banner/detail-banner/' . $id)->withInput();
        }

        if ($bannerModel->save($data)) {
            session()->setFlashdata('success', 'Data banner berhasil diubah.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data banner berhasil diubah.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/banner/detail-banner/' . $id);
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/banner/detail-banner/update/' . $id)->withInput();
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

    // =================================================================
    // ======================= ADSVERTISEMENTS =========================
    // =================================================================

    public function promotionBanner(): string
    {
        $bannerModel = new BannerPromotionModel();
        $bannerList = $bannerModel->findAll();
        $data = [
            'title' => 'List Banner Aplikasi',
            'banner_list' => $bannerList
        ];
        return view('/dashboard/banner/promotionBanner', $data);
    }

    public function saveBannerPromo()
    {
        // ambil gambar
        $bannerModel = new BannerPromotionModel();

        $fotoBanner = $this->request->getFile('img');
        $fotoBannerPromo = $this->request->getFile('img_promo');
        $data = [
            'title' => $this->request->getVar('title'),
            'img' => $fotoBanner,
            'img_promo' => $fotoBannerPromo,
            'title' => $this->request->getVar('title'),
        ];
        //validate data
        if (!$this->validateData($data, $bannerModel->validationRules) && !$this->validateData($data, [
            'img' => [
                'errors' => [
                    'uploaded' => 'Gambar promo wajib diunggah.'
                ]
            ],
            'img_promo' => [
                'errors' => [
                    'uploaded' => 'Gambar konten promo wajib diunggah.'
                ]
            ]
        ])) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian data banner promotion'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/banner/promotion-banner')->withInput();
        }
        // Homepage Banner Promo
        if ($fotoBanner->getError() == 4) {
            $namaBanner = 'default.png';
        } else {
            $namaBanner = $fotoBanner->getRandomName();
            $fotoBanner->move('assets/img/banner/promotion/', $namaBanner);
        }

        // Content Banner Promo
        if ($fotoBannerPromo->getError() == 4) {
            $namaBannerPromo = 'default.jpg';
        } else {
            $namaBannerPromo = $fotoBannerPromo->getRandomName();
            $fotoBannerPromo->move('assets/img/banner/promotion/content/', $namaBannerPromo);
        }

        //repalce data
        $data = [
            'title' => $this->request->getVar('title'),
            'img' => $namaBanner,
            'img_promo' => $namaBannerPromo,
            'deskripsi' => $this->request->getVar('deskripsi'),
        ];
        // dd($data);

        // swet alert
        if ($bannerModel->save($data)) {
            session()->setFlashdata('success', 'Gambar promotion berhasil disimpan.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Gambar promotion berhasil disimpan.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/banner/promotion-banner')->withInput();
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada upload gambar promotion'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/banner/promotion-banner')->withInput();
        }
    }

    public function deletePromotion($id)
    {
        $bannerModel = new BannerPromotionModel();
        $banner = $bannerModel->find($id);

        if ($banner['img'] != 'default.png') {
            $gambarLamaPath = 'assets/img/banner/promotion/' . $banner['img'];
            if (file_exists($gambarLamaPath)) {
                unlink($gambarLamaPath);
            }
        }

        if ($banner['img_promo'] != 'default.jpg') {
            $gambarLamaPath = 'assets/img/banner/promotion/content/' . $banner['img_promo'];
            if (file_exists($gambarLamaPath)) {
                unlink($gambarLamaPath);
            }
        }

        $deleted = $bannerModel->delete($id);

        if ($deleted) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Gambar promotion berhasil di hapus.'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/banner/promotion-banner');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada penghapusan gambar promotion'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/banner/promotion-banner')->withInput();
        }
    }

    public function updatePromotion($id)
    {
        $bannerModel = new BannerPromotionModel();

        $bl = $bannerModel->find($id);
        $data = [
            'title' => 'Edit Promotion Banner',
            'bl' => $bl,
            'back'  => 'dashboard/banner/promotion-banner'
        ];
        return view('dashboard/banner/updatePromotionBanner', $data);
    }

    public function updatePromotionStore()
    {
        $bannerModel = new BannerPromotionModel();
        $id = $this->request->getVar('id_banner_promotion');
        $image = $this->request->getFile('img');
        $image_promo = $this->request->getFile('img_promo');

        $data = [
            'id_banner_promotion' => $id,
            'title' => $this->request->getVar('title'),
            'img' => $image,
            'img_promo' => $image_promo,
            'deskripsi' => $this->request->getVar('deskripsi')
        ];

        if (!$this->validateData($data, $bannerModel->validationRules)) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/banner/update-promotion-banner/' . $id)->withInput();
        }


        if ($image->getError() == 4) {
            $namaBannerImage = $this->request->getVar('imageLama');
        } else {
            $produk = $bannerModel->find($id);

            if ($produk['img'] == 'default.png') {
                $namaBannerImage = $image->getRandomName();
                $image->move('assets/img/banner/promotion', $namaBannerImage);
            } else {
                $namaBannerImage = $image->getRandomName();
                $image->move('assets/img/banner/promotion', $namaBannerImage);
                $gambarLamaPath = 'assets/img/banner/promotion/' . $this->request->getVar('imageLama');
                if (file_exists($gambarLamaPath)) {
                    unlink($gambarLamaPath);
                }
            }
        }

        if ($image_promo->getError() == 4) {
            $namaBannerImagePromo = $this->request->getVar('imagePromoLama');
        } else {
            $produk = $bannerModel->find($id);

            if ($produk['img_promo'] == 'default.jpg') {
                $namaBannerImagePromo = $image_promo->getRandomName();
                $image_promo->move('assets/img/banner/promotion/content', $namaBannerImagePromo);
            } else {
                $namaBannerImagePromo = $image_promo->getRandomName();
                $image_promo->move('assets/img/banner/promotion/content', $namaBannerImagePromo);
                $gambarPromoLamaPath = 'assets/img/banner/promotion/content/' . $this->request->getVar('imagePromoLama');
                if (file_exists($gambarPromoLamaPath)) {
                    unlink($gambarPromoLamaPath);
                }
            }
        }

        $data = [
            'id_banner_promotion' => $id,
            'title' => $this->request->getVar('title'),
            'img' => $namaBannerImage,
            'img_promo' => $namaBannerImagePromo,
            'deskripsi' => $this->request->getVar('deskripsi'),
        ];

        if ($bannerModel->save($data)) {
            session()->setFlashdata('success', 'Gambar promotion banner berhasil diubah.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Gambar promotion banner berhasil diubah.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/banner/promotion-banner');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/banner/update-promotion-banner/' . $id)->withInput();
        }
    }
}
