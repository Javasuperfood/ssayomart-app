<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PromoModel;
use App\Models\PromoItemModel;
use App\Models\ProdukModel;
use App\Models\VariasiItemModel;
use App\Models\PromoBatchModel;

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
        $promoItemModel = new PromoItemModel();
        $promoBatchModel = new PromoBatchModel();

        $promo = $promoModel->find($id);

        if ($promo['img'] != 'default.png') {
            $gambarLamaPath = 'assets/img/promo/' . $promo['img'];
            if (file_exists($gambarLamaPath)) {
                unlink($gambarLamaPath);
            }
        }

        $promoItemModel->where('id_promo', $id)->delete();
        $promoBatchModel->where('id_promo', $id)->delete();

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
    // Update Action
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
            'id_promo' => $id,
            'title' => $this->request->getVar('title'),
            'slug' => $slug,
            'img' => $namaPromoImage,
            'start_at' => $this->request->getVar('started'),
            'end_at' => $this->request->getVar('ended'),
            'deskripsi' => $this->request->getVar('deskripsi')
        ];

        // Validation
        $this->validation->setRules([
            'title' => 'required',
            'slug' => 'required',
            'img' => 'uploaded[img]|mime_in[img,image/jpg,image/jpeg,image/png]|max_size[img,1024]',
            'start_at' => 'required',
            'end_at' => 'required',
            'deskripsi' => 'required',
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {

            $errors = $this->validation->getErrors();
            $alert = [
                'type'    => 'error',
                'title'   => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/promo/update-promo/' . $id)->withInput();
        }

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
    public function show($id)
    {
        $promoModel = new PromoModel();
        $promoBatchModel = new PromoBatchModel();
        $promoList = $promoModel->findAll();

        $getOngoingPromoItems = $promoBatchModel->getOngoingPromoItems($id);

        $data = [
            'promo' => $promoList,
            'ongoingPromoItems' => $getOngoingPromoItems,
        ];
        // dd($data);
        return view('dashboard/promo/index', $data);
    }

    public function create()
    {
        $promoModel = new PromoModel();
        $promoBatchModel = new PromoBatchModel();
        $produkModel = new ProdukModel();
        $variasiItemModel = new VariasiItemModel();

        $promoList = $promoModel->findAll();
        $variasiList = $variasiItemModel->findAll();
        $produkList = $produkModel->findAll();

        $ongoingPromoItems = $promoBatchModel->getOngoingPromo();

        $data = [
            'promo' => $promoList,
            'promoBatch' => $promoBatchModel->findAll(),
            'produk' => $produkList,
            'variasi' => $variasiList,
            'ongoingPromoItems' => $ongoingPromoItems
        ];
        // dd($data);
        return view('dashboard/promo/tambahPromoItemBatch', $data);
    }

    public function store()
    {
        // dd($this->request->getVar());
        $promoBatchModel = new PromoBatchModel();

        $produkIds = (array) $this->request->getVar('produk_id');

        $batchData = [];

        foreach ($produkIds as $productId) {
            $data = [
                'id_promo' => $this->request->getVar('promo'),
                'id_produk' => $productId,
                'discount' => $this->request->getVar('discount'),
                'min' => $this->request->getVar('min')
            ];

            $batchData[] = $data;
            // dd($batchData);
        }

        if ($promoBatchModel->insertBatch($batchData)) {
            session()->setFlashdata('success', 'Promosi produk berhasil disimpan.');

            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Promosi produk berhasil disimpan.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/promo/tambah-promo/show-promo/' . $this->request->getVar('promo'))->withInput();
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/promo/tambah-promo/show-promo/' . $this->request->getVar('promo'))->withInput();
        }
    }

    public function edit($id)
    {
        $promoModel = new PromoModel();
        $promoBatchModel = new PromoBatchModel();
        $produkModel = new ProdukModel();
        $variasiItemModel = new VariasiItemModel();

        $promoList = $promoModel->findAll();
        $variasiList = $variasiItemModel->findAll();
        $produkList = $produkModel->findAll();
        $ongoingPromo = $promoBatchModel->find($id);
        $promoBatch = $promoBatchModel->findAll();

        $getOngoingPromoItems = $promoBatchModel->getOngoingPromoItems($id);
        $ongoingPromo['produk_nama'] = $produkModel->find($ongoingPromo['id_produk'])['nama'];

        $data = [
            'promo' => $promoList,
            'promoBatch' => $promoBatch,
            'produk' => $produkList,
            'variasi' => $variasiList,
            'op' => $ongoingPromo,
            'ongoingPromoItems' => $getOngoingPromoItems
        ];
        // dd($data);
        return view('dashboard/promo/updatePromoItemBatch', $data);
    }

    public function update($id)
    {
        $promoBatchModel = new PromoBatchModel();
        $ongoingPromo = $promoBatchModel->find($id);

        $data = [
            'id_promo_item_batch' => $id,
            'id_promo' => $this->request->getVar('promo'),
            'id_produk' => $this->request->getVar('produk_id'),
            'discount' => $this->request->getVar('discount'),
            'min' => $this->request->getVar('min'),
        ];
        // dd($data);

        if ($promoBatchModel->save($data)) {
            session()->setFlashdata('success', 'Promosi produk berhasil disimpan.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Promosi produk berhasil disimpan.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/promo/tambah-promo/show-promo/' . $ongoingPromo['id_promo'])->withInput();
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/promo/tambah-promo/show-promo/' . $ongoingPromo['id_promo'])->withInput();
        }
    }

    public function delete($id)
    {
        $promoBatchModel = new PromoBatchModel();
        $promoBatch = $promoBatchModel->find($id);

        if ($promoBatch) {
            $deleted = $promoBatchModel->delete($id);
            if ($deleted) {
                $alert = [
                    'type' => 'success',
                    'title' => 'Berhasil',
                    'message' => 'Promo item produk berhasil di hapus.'
                ];
                session()->setFlashdata('alert', $alert);
                return redirect()->to('dashboard/promo/tambah-promo/show-promo/' . $promoBatch['id_promo'])->withInput();
            } else {
                $alert = [
                    'type' => 'error',
                    'title' => 'Error',
                    'message' => 'Terdapat kesalahan pada penghapusan data'
                ];
                session()->setFlashdata('alert', $alert);
                return redirect()->to('dashboard/promo/tambah-promo')->withInput();
            }
        }
    }

    public function deleteBatch($id)
    {
        // dd($this->request->getVar());
        $promoBatchModel = new PromoBatchModel();
        $item = $this->request->getVar('promo_id');

        foreach ($item as $promoId) {
            $promo = $promoBatchModel->find($promoId);

            // Check if 'img' key exists and is not null
            if (isset($promo['img']) && $promo['img'] != 'default.png') {
                $gambarLamaPath = 'assets/img/produk/main/' . $promo['img'];
                if (file_exists($gambarLamaPath)) {
                    unlink($gambarLamaPath);
                }
            }
            $deleted = $promoBatchModel->delete($promoId);
        }

        if ($deleted) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Produk berhasil dihapus.'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/promo/tambah-promo/show-promo/' . $this->request->getVar('id_promo'))->withInput();
        }
    }
}
