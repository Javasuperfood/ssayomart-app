<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PromoModel;
use App\Models\PromoItemModel;
use App\Models\ProdukModel;
use App\Models\VariasiItemModel;
use App\Models\PromoProduk;

class AdminPromoController extends BaseController
{
    public function index()
    {
        $promoModel = new PromoModel();
        $promoList = $promoModel->findAll();
        $data = [
            'promo' => $promoList
        ];
        return view('dashboard/promo/promo', $data);
    }

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
        $fotoPromo2 = $this->request->getFile('img_2');
        $namaPromo2 = null;

        if ($fotoPromo->getError() == 4) {
            $namaPromo = 'default.png';
        } else {
            $namaPromo = $fotoPromo->getRandomName();
            $fotoPromo->move('assets/img/promo/', $namaPromo);
        }

        if ($fotoPromo2->getError() !== UPLOAD_ERR_NO_FILE) {
            // A file has been uploaded
            $namaPromo2 = $fotoPromo2->getRandomName();
            $fotoPromo2->move('assets/img/promo/', $namaPromo2);
        }

        $slug = url_title($this->request->getVar('title'), '-', true);
        $data = [
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'img' => $namaPromo,
            'img_2' => $namaPromo2,
            'start_at' => $this->request->getVar('started'),
            'end_at' => $this->request->getVar('ended'),
            'deskripsi' => $this->request->getVar('deskripsi')
        ];
        // dd($data);

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
        $promoProdukModel = new PromoProduk();

        $promo = $promoModel->find($id);

        if ($promo['img'] != 'default.png') {
            $gambarLamaPath = 'assets/img/promo/' . $promo['img'];
            if (file_exists($gambarLamaPath)) {
                unlink($gambarLamaPath);
            }
        }

        if ($promo['img_2'] != 'default.png') {
            $gambarLamaPath = 'assets/img/promo/' . $promo['img_2'];
            if (is_file($gambarLamaPath) && file_exists($gambarLamaPath)) {
                unlink($gambarLamaPath);
            }
        }

        $promoProdukModel->where('id_promo', $id)->delete();

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
        $promoModel = new PromoModel();

        $promo = $promoModel->find($id);
        $data = [
            'title' => 'Edit Banner',
            'promo' => $promo,
            'back'  => 'dashboard/promo/tambah-promo'
        ];
        return view('dashboard/promo/updatePromo', $data);
    }
    // Update Action
    public function editPromo($id)
    {
        $promoModel = new PromoModel();
        $image = $this->request->getFile('img');
        $image2 = $this->request->getFile('img_2');
        $namaPromoImage2 = null;

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

        if ($image2->getError() !== UPLOAD_ERR_NO_FILE) {
            // A new file has been uploaded
            $namaPromoImage2 = $image2->getRandomName();
            $image2->move('assets/img/promo', $namaPromoImage2);

            // Remove the old file
            $gambarLamaPath = 'assets/img/promo/' . $this->request->getVar('imageLama2');
            if (is_file($gambarLamaPath)) { // Check if it's a file before unlinking
                unlink($gambarLamaPath);
            }
        } else {
            // No new file uploaded, keep the existing value
            $namaPromoImage2 = null;
        }

        $slug = url_title($this->request->getVar('title'), '-', true);
        $cekSlug = $promoModel->where('slug', $slug)->first();
        if ($cekSlug != null) {
            $slug = $slug;
        }

        $data = [
            'id_promo' => $id,
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'img' => $namaPromoImage,
            'img_2' => $namaPromoImage2,
            'start_at' => $this->request->getVar('started'),
            'end_at' => $this->request->getVar('ended'),
            'deskripsi' => $this->request->getVar('deskripsi')
        ];

        // dd($data);

        if ($promoModel->save($data)) {
            session()->setFlashdata('success', 'Gambar banner berhasil diubah.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data Promo berhasil diubah.'
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

            return redirect()->to('dashboard/promo/update-promo/' . $id)->withInput();
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
        $produkList = $produkModel->findAll();
        $ongoingPromoItems = $promoItemModel->getOngoingPromo();
        // dd($ongoingPromoItems);

        $data = [
            'promo' => $promoList,
            'produk' => $produkList,
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

    public function editPromoItem($id)
    {
        $promoModel = new PromoModel();
        $promoItemModel = new PromoItemModel();
        $produkModel = new ProdukModel();
        $variasiItemModel = new VariasiItemModel();

        $promo = $promoModel->findAll();
        $variasiList = $variasiItemModel->findAll();
        $produkList = $produkModel->findAll();
        $ongoingPromo = $promoItemModel->find($id);
        $ongoingPromoItems = $promoItemModel->getOngoingPromoItems();

        $ongoingPromo['produk_nama'] = $produkModel->find($ongoingPromo['id_produk'])['nama'];
        $data = [
            'promo' => $promo,
            'produk' => $produkList,
            'variasi' => $variasiList,
            'ongoingPromoItems' => $ongoingPromoItems,
            'op' => $ongoingPromo,
            'back'  => 'dashboard/promo/tambah-promo-item'
        ];
        // dd($data);
        return view('dashboard/promo/updatePromoItem', $data);
    }

    // Update Action
    public function updatePromoItem($id)
    {
        $promoItemModel = new PromoItemModel();

        $data = [
            'id_promo_item' => $id,
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

    // =============================================================================
    //                              PROMO ITEM BATCH CONTROLLER
    // =============================================================================
    // public function show($id)
    // {
    //     $promoModel = new PromoModel();
    //     $promoBatchModel = new PromoBatchModel();
    //     $promoList = $promoModel->findAll();

    //     $produkModel = new ProdukModel();
    //     $variasiItemModel = new VariasiItemModel();

    //     $promoList = $promoModel->findAll();
    //     $variasiList = $variasiItemModel->findAll();

    //     $keyword = $this->request->getVar('search');
    //     if ($keyword) {
    //         $produk = $produkModel->orderBy('id_produk', 'DESC')->adminProdukSearch($keyword);
    //     } else {
    //         $produk = $produkModel->orderBy('id_produk', 'DESC')->limit(10)->find();
    //     }

    //     $getOngoingPromoItems = $promoBatchModel->getOngoingPromoItems($id);

    //     $data = [
    //         'promo' => $promoList,
    //         'ongoingPromoItems' => $getOngoingPromoItems,
    //         'produk' => $produk,
    //         'variasi' => $variasiList
    //     ];
    //     // dd($data);
    //     return view('dashboard/promo/index', $data);
    // }

    // public function create()
    // {
    //     $promoModel = new PromoModel();
    //     $promoBatchModel = new PromoBatchModel();
    //     $produkModel = new ProdukModel();
    //     $variasiItemModel = new VariasiItemModel();

    //     $promoList = $promoModel->findAll();
    //     $variasiList = $variasiItemModel->findAll();
    //     $produkList = $produkModel->findAll();

    //     $keyword = $this->request->getVar('search');
    //     if ($keyword) {
    //         $produk = $produkModel->orderBy('id_produk', 'DESC')->adminProdukSearch($keyword);
    //     } else {
    //         $produk = $produkModel->orderBy('id_produk', 'DESC')->limit(10)->find();
    //     }


    //     $ongoingPromoItems = $promoBatchModel->getOngoingPromo();

    //     $data = [
    //         'promo' => $promoList,
    //         'promoBatch' => $promoBatchModel->findAll(),
    //         'produk' => $produk,
    //         'variasi' => $variasiList,
    //         'ongoingPromoItems' => $ongoingPromoItems
    //     ];
    //     // dd($data);
    //     return view('dashboard/promo/tambahPromoItemBatch', $data);
    // }

    // public function getproductjson()
    // {
    //     $produkModel = new ProdukModel();
    //     $data = $this->request->getVar();
    //     $keyword = $this->request->getVar('search');
    //     if ($keyword) {
    //         $produk = $produkModel->orderBy('id_produk', 'DESC')->where('deleted_at', null)->like('nama', '%' . $keyword . '%')->orLike('sku', '%' . $keyword . '%')->findAll();
    //     } else {
    //         $produk = $produkModel->orderBy('id_produk', 'DESC')->limit(10)->find();
    //     }
    //     return $this->response->setJSON([
    //         'request' => $data,
    //         'response' => $produk,

    //     ]);
    // }

    // public function store()
    // {
    //     // dd($this->request->getVar());
    //     $promoBatchModel = new PromoBatchModel();

    //     $produkIds = (array) $this->request->getVar('produk_id');

    //     $batchData = [];

    //     foreach ($produkIds as $productId) {
    //         $data = [
    //             'id_promo' => $this->request->getVar('promo'),
    //             'id_produk' => $productId,
    //             'discount' => floatval($this->request->getVar('discount')),
    //             'min' => $this->request->getVar('min')
    //         ];

    //         $batchData[] = $data;
    //         // dd($batchData);
    //     }

    //     if ($promoBatchModel->insertBatch($batchData)) {
    //         session()->setFlashdata('success', 'Promosi produk berhasil disimpan.');

    //         $alert = [
    //             'type' => 'success',
    //             'title' => 'Berhasil',
    //             'message' => 'Promosi produk berhasil disimpan.'
    //         ];
    //         session()->setFlashdata('alert', $alert);

    //         return redirect()->to('dashboard/promo/tambah-promo/show-promo/' . $this->request->getVar('promo'));
    //     } else {
    //         $alert = [
    //             'type' => 'error',
    //             'title' => 'Error',
    //             'message' => 'Terdapat kesalahan pada pengisian formulir'
    //         ];
    //         session()->setFlashdata('alert', $alert);
    //         return redirect()->to('dashboard/promo/tambah-promo-item-batch')->withInput();
    //     }
    // }

    // public function edit($id)
    // {
    //     $promoModel = new PromoModel();
    //     $promoBatchModel = new PromoBatchModel();
    //     $produkModel = new ProdukModel();
    //     $variasiItemModel = new VariasiItemModel();

    //     $promoList = $promoModel->findAll();
    //     $variasiList = $variasiItemModel->findAll();
    //     $produkList = $produkModel->findAll();
    //     $ongoingPromo = $promoBatchModel->find($id);
    //     $promoBatch = $promoBatchModel->findAll();

    //     $getOngoingPromoItems = $promoBatchModel->getOngoingPromoItems($id);
    //     $ongoingPromo['produk_nama'] = $produkModel->find($ongoingPromo['id_produk'])['nama'];
    //     // dd($ongoingPromo);

    //     $data = [
    //         'promo' => $promoList,
    //         'promoBatch' => $promoBatch,
    //         'produk' => $produkList,
    //         'variasi' => $variasiList,
    //         'op' => $ongoingPromo,
    //         'ongoingPromoItems' => $getOngoingPromoItems
    //     ];
    //     // dd($data);
    //     return view('dashboard/promo/updatePromoItemBatch', $data);
    // }

    // public function update($id)
    // {
    //     $promoBatchModel = new PromoBatchModel();
    //     $ongoingPromo = $promoBatchModel->find($id);

    //     $data = [
    //         'id_promo_item_batch' => $id,
    //         'id_promo' => $this->request->getVar('promo'),
    //         'id_produk' => $this->request->getVar('produk_id'),
    //         'discount' => floatval($this->request->getVar('discount')),
    //         'min' => $this->request->getVar('min'),
    //     ];
    //     // dd($data);

    //     if ($promoBatchModel->save($data)) {
    //         session()->setFlashdata('success', 'Promosi produk berhasil disimpan.');
    //         $alert = [
    //             'type' => 'success',
    //             'title' => 'Berhasil',
    //             'message' => 'Promosi produk berhasil disimpan.'
    //         ];
    //         session()->setFlashdata('alert', $alert);

    //         return redirect()->to('dashboard/promo/tambah-promo/show-promo/' . $ongoingPromo['id_promo'])->withInput();
    //     } else {
    //         $alert = [
    //             'type' => 'error',
    //             'title' => 'Error',
    //             'message' => 'Terdapat kesalahan pada pengisian formulir'
    //         ];
    //         session()->setFlashdata('alert', $alert);
    //         return redirect()->to('dashboard/promo/tambah-promo/show-promo/edit/' . $id)->withInput();
    //     }
    // }

    // public function delete($id)
    // {
    //     $promoBatchModel = new PromoBatchModel();
    //     $promoBatch = $promoBatchModel->find($id);

    //     if ($promoBatch) {
    //         $deleted = $promoBatchModel->delete($id);
    //         if ($deleted) {
    //             $alert = [
    //                 'type' => 'success',
    //                 'title' => 'Berhasil',
    //                 'message' => 'Promo item produk berhasil di hapus.'
    //             ];
    //             session()->setFlashdata('alert', $alert);
    //             return redirect()->to('dashboard/promo/tambah-promo/show-promo/' . $promoBatch['id_promo'])->withInput();
    //         } else {
    //             $alert = [
    //                 'type' => 'error',
    //                 'title' => 'Error',
    //                 'message' => 'Terdapat kesalahan pada penghapusan data'
    //             ];
    //             session()->setFlashdata('alert', $alert);
    //             return redirect()->to('dashboard/promo/tambah-promo')->withInput();
    //         }
    //     }
    // }

    // public function deleteBatch($id)
    // {
    //     // dd($this->request->getVar());
    //     $promoBatchModel = new PromoBatchModel();
    //     $item = $this->request->getVar('promo_id');

    //     foreach ($item as $promoId) {
    //         $promo = $promoBatchModel->find($promoId);
    //         $deleted = $promoBatchModel->delete($promoId);
    //     }

    //     if ($deleted) {
    //         $alert = [
    //             'type' => 'success',
    //             'title' => 'Berhasil',
    //             'message' => 'Produk promo berhasil dihapus.'
    //         ];
    //         session()->setFlashdata('alert', $alert);
    //         return redirect()->to('dashboard/promo/tambah-promo/show-promo/' . $this->request->getVar('id_promo'))->withInput();
    //     }
    // }

    // =============================================================================
    //                              PROMO PRODUK CONTROLLER
    // =============================================================================

    public function getproductjson()
    {
        $produkModel = new ProdukModel();
        $data = $this->request->getVar();
        $keyword = $this->request->getVar('search');
        if ($keyword) {
            $produk = $produkModel->orderBy('id_produk', 'DESC')->where('deleted_at', null)->like('nama', '%' . $keyword . '%')->orLike('sku', '%' . $keyword . '%')->findAll();
        } else {
            $produk = $produkModel->orderBy('id_produk', 'DESC')->limit(10)->find();
        }
        return $this->response->setJSON([
            'request' => $data,
            'response' => $produk,

        ]);
    }

    public function tambahPromoProduk($id)
    {
        $promoModel = new PromoModel();
        $promoProdukModel = new PromoProduk();
        $promoList = $promoModel->findAll();

        $produkModel = new ProdukModel();
        $variasiItemModel = new VariasiItemModel();

        $promoList = $promoModel->findAll();
        $variasiList = $variasiItemModel->findAll();

        $keyword = $this->request->getVar('search');
        if ($keyword) {
            $produk = $produkModel->orderBy('id_produk', 'DESC')->adminProdukSearch($keyword);
        } else {
            $produk = $produkModel->orderBy('id_produk', 'DESC')->limit(10)->find();
        }

        $keywords = $this->request->getVar('search_product');
        if ($keywords) {
            $produkSearch = $produkModel->orderBy('id_produk', 'DESC')->adminProdukSearch2($keywords);
        } else {
            $produkSearch = $produkModel->orderBy('id_produk', 'DESC')->limit(10)->find();
        }

        $getOngoingPromoItems = $promoProdukModel->getOngoingPromoItems($id);

        $data = [
            'promo' => $promoList,
            'ongoingPromoItems' => $getOngoingPromoItems,
            'produk' => $produk,
            'produkSearch' => $produkSearch,
            'variasi' => $variasiList
        ];
        // dd($data);
        return view('dashboard/promo/tambahPromoProduk', $data);
    }

    public function savePromoProduk()
    {
        $promoBundling = new PromoProduk();

        $produkIds = (array) $this->request->getVar('produk_id');
        $freeprodukIds = $this->request->getVar('free_produk_id'); 

        $fotoPromo = $this->request->getFile('img');
        if ($fotoPromo->getError() == 4) {
            $namaPromo = 'default.png';
        } else {
            $namaPromo = $fotoPromo->getRandomName();
            $fotoPromo->move('assets/img/promo/', $namaPromo);
        }

        $batchData = [];

        foreach ($produkIds as $productId) {
        // Create a new array for each product and its associated free products
            $data = [
                'id_produk' => $productId,
                'free_produk_id' => $freeprodukIds,
                'nama' => $this->request->getVar('nama'),
                'deskripsi' => $this->request->getVar('deskripsi'),
                'img' => $namaPromo
            ];

            $batchData[] = $data;        
        }
        // dd($batchData);

        if (!$promoBundling->insertBatch($batchData)) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/promo/tambah-promo-bundling')->withInput()->with('errors', $promoBundling->errors());
        }
        
         // If validation passes
        session()->setFlashdata('success', 'Promosi produk berhasil disimpan.');

        $alert = [
            'type' => 'success',
            'title' => 'Berhasil',
            'message' => 'Promosi produk berhasil disimpan.'
        ];
        session()->setFlashdata('alert', $alert);

        return redirect()->to('dashboard/promo/tambah-promo/');
    }
    
    // public function tambahPromoProduk()
    // {
    //     $promoBundling = new PromoProduk();
    //     $produkModel = new ProdukModel();
    //     $variasiItemModel = new VariasiItemModel();

    //     $promoList = $promoBundling->findAll();
    //     $variasiList = $variasiItemModel->findAll();

    //     $keyword = $this->request->getVar('search');
    //     if ($keyword) {
    //         $produk = $produkModel->orderBy('id_produk', 'DESC')->adminProdukSearch($keyword);
    //     } else {
    //         $produk = $produkModel->orderBy('id_produk', 'DESC')->limit(10)->find();
    //     }

    //     $data = [
    //         'promo' => $promoList,
    //         'produk' => $produk,
    //         'variasi' => $variasiList,
    //     ];
    //     // dd($data);
    //     return view('dashboard/promo/tambahPromoBundling', $data);
    // }
}
