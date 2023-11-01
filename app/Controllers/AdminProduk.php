<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\VariasiModel;
use App\Models\KategoriModel;
use App\Models\SubKategoriModel;
use App\Controllers\BaseController;
use App\Models\AdminTokoModel;
use App\Models\StockModel;
use App\Models\VariasiItemModel;

class AdminProduk extends BaseController
{
    protected $imageModel;
    public function produk()
    {
        $produkModel = new ProdukModel();
        $kategoriModel = new KategoriModel();
        $subKategoriModel = new SubKategoriModel();
        $variasiItemModel = new VariasiItemModel();
        $stokModel = new StockModel();
        $adminTokoModel = new AdminTokoModel();

        $admin = $adminTokoModel->getAdminToko(user_id());
        $getStok = false;
        $pa['stok'] = [];
        if (isset($admin[0]['id_toko'])) {
            $getStok = true;
        }

        $perPage = 10;

        $currentPage = $this->request->getVar('page_produk') ? $this->request->getVar('page_produk') : 1;

        $keyword = $this->request->getVar('search');
        if ($keyword) {
            $produk = $produkModel->orderBy('id_produk', 'DESC')->adminProdukSearch($keyword);
        } else {
            $produk = $produkModel->orderBy('id_produk', 'DESC');
        }
        $produk_list = $produk->paginate($perPage, 'produk');
        //optimasi agar hanya mengamnil data dari 1 halaman
        foreach ($produk_list as $key => $p) {
            $pa['kategori'][$key] = $kategoriModel->find($p['id_kategori']);
            $pa['sub_kategori'][$key] = $subKategoriModel->find($p['id_sub_kategori']);
            $pa['variasi_item'][$key] = $variasiItemModel->select('*')
                ->join('jsf_variasi', 'jsf_variasi.id_variasi = jsf_variasi_item.id_variasi')
                ->where('id_produk', $p['id_produk'])->findAll();
            if ($getStok) {
                $pa['stok'][$key] = $stokModel->getStockOnly($p['id_produk'], $admin[0]['id_toko']);
            }
        }
        // dd($pa);
        $data = [
            'title' => 'Daftar Produk',
            'produk' => $produk_list,
            'kategori' => $pa['kategori'],
            'subKategori' => $pa['sub_kategori'],
            'variasiItem' => $pa['variasi_item'],
            'stok' => $pa['stok'],
            'pager' => $produkModel->pager,
            'iterasi' => ($currentPage - 1) * $perPage + 1,
        ];
        // dd($data['stok'][0][0]);
        // dd($data);
        return view('dashboard/produk/produk', $data);
    }


    public function tambahProduk()
    {
        $produkModel = new ProdukModel();
        $kategoriModel = new KategoriModel();
        $subKategoriModel = new SubKategoriModel();
        $variasiModel = new VariasiModel();
        $variasiItemModel = new VariasiItemModel();

        $variasList = $variasiModel->findAll();
        $variasiItemList = $variasiItemModel->getVariasiItem();
        $produk_list = $produkModel->findAll();
        $kategori_list = $kategoriModel->findAll();
        $sub_kategori_list = $subKategoriModel->findAll();
        $data = [
            'produk_Model' => $produk_list,
            'kategori' => $kategori_list,
            'subKategori' => $sub_kategori_list,
            'variasi' => $variasList,
            'variasiItem' => $variasiItemList,
            'vali' => $produkModel->errors()
        ];
        // dd($data);
        return view('dashboard/produk/tambahProduk', $data);
    }
    // save produk
    public function save()
    {
        $produkModel = new ProdukModel();
        $variasItemiModel = new VariasiItemModel();
        $fotoProduk = $this->request->getFile('img');
        if ($fotoProduk->getError() == 4) {
            $namaProduk = 'default.png';
        } else {
            $namaProduk = $fotoProduk->getRandomName();
            $fotoProduk->move('assets/img/produk/main/', $namaProduk);
        }
        $slug = url_title($this->request->getVar('nama'), '-', true);
        $cekSlug = $produkModel->where('slug', $slug)->first();
        if ($cekSlug != null) {
            $slug = $slug . '-' . time();
        }
        $data = [
            'slug' => $slug,
            'nama' => $this->request->getVar('nama'),
            'sku' => $this->request->getVar('sku'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'img' => $namaProduk,
            'id_kategori' => $this->request->getVar('parent_kategori_id'),
            'id_sub_kategori' => $this->request->getVar('sub_kategori')
        ];
        // dd($data);
        $id_varian = $this->request->getVar('selectVariant');
        if ($id_varian != '') {
            $id_varian = $id_varian;
        } else {
            $id_varian = null;
        }
        $data2 = [
            'id_variasi' => $id_varian,
            'value_item' => $this->request->getVar('valueItem'),
            'harga_item' => $this->request->getVar('harga'),
            'berat' => $this->request->getVar('berat'),
        ];

        $ruleData = [
            'nama' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama produk wajib diisi.',
                ],
            ],
            'sku'    => [
                'rules'  => 'required|is_unique[jsf_produk.sku]',
                'errors' => [
                    'required' => 'SKU wajib diisi.',
                    'is_unique' => 'SKU wajib unik, tidak boleh sama dengan produk yang sudah dimasukan.'
                ],
            ],
            'deskripsi'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Deskripsi wajib diisi.',
                ],
            ]
        ];
        if (!$this->validateData($data, $ruleData) || !$this->validateData($data2, $variasItemiModel->validationRules)) {
            return redirect()->to('dashboard/produk/tambah-produk')->withInput();
        }


        $produk = $produkModel->insert($data);
        // if validate success replace data2
        $data2 = [
            'id_variasi' => $id_varian,
            'id_produk' => $produk,
            'value_item' => $this->request->getVar('valueItem'),
            'harga_item' => $this->request->getVar('harga'),
            'berat' => $this->request->getVar('berat'),
        ];

        $varian = $variasItemiModel->insert($data2);

        // swet alert
        if ($produk && $varian) {
            session()->setFlashdata('success', 'Produk berhasil disimpan.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Produk berhasil disimpan.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/produk');
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

    // Update Produk
    public function updateProduk($id)
    {
        session();
        $produkModel = new ProdukModel();

        $kategoriModel = new KategoriModel();
        $subKategoriModel = new SubKategoriModel();
        $variasiModel = new VariasiModel();
        $variasiItemModel = new VariasiItemModel();

        $variasList = $variasiModel->findAll();
        $variasiItemList = $variasiItemModel->getByIdProduk($id);
        $kategori_list = $kategoriModel->findAll();
        $sub_kategori_list = $subKategoriModel->findAll();
        $produk = $produkModel->find($id);

        $data = [
            'title' => 'Edit Produk',
            'p' => $produk,
            'kategori' => $kategori_list,
            'subKategori' => $sub_kategori_list,
            'variasi' => $variasList,
            'variasiItem' => $variasiItemList[0],
            'vali' => $produkModel->errors(),

        ];
        // dd($data);
        return view('dashboard/produk/updateProduk', $data);
    }
    public function saveUpdateProduk()
    {
        // dd($this->request->getVar());
        $id = $this->request->getVar('id_produk');
        $produkModel = new ProdukModel();
        $image = $this->request->getFile('img');
        if (!$this->validate($produkModel->validationRules)) {
            return redirect()->to('dashboard/produk/update-produk/' . $id)->withInput();
        }
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
        $slug = url_title($this->request->getVar('nama'), '-', true);
        $cekSlug = $produkModel->where('slug', $slug)->first();
        if ($cekSlug != null) {
            $slug = $slug . '-' . time();
        }
        $data = [
            'slug' => $slug,
            'nama' => $this->request->getVar('nama'),
            'sku' => $this->request->getVar('sku'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'img' => $namaProdukImage,
            'id_kategori' => $this->request->getVar('parent_kategori_id'),
            'id_sub_kategori' => $this->request->getVar('sub_kategori')
        ];
        // dd($data);
        $ruleData = [
            'nama' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Nama produk wajib diisi.',
                ],
            ],
            'deskripsi'    => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Deskripsi wajib diisi.',
                ],
            ]
        ];
        if (!$this->validateData($data, $ruleData)) {
            return redirect()->to('dashboard/produk/update-produk/' . $id)->withInput();
        }

        // Pembaruan data produk
        if ($produkModel->update($id, $data)) {
            session()->setFlashdata('success', 'Produk berhasil diubah.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Produk berhasil diubah.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/produk?page_produk=' . $this->request->getVar('page'));
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/produk/update-produk/' . $id)->withInput();
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
        $produkModel->save([
            'id_produk' => $id,
            'slug' => $produk['slug'] . '-deleted-' . time(),
            'sku' => $produk['sku'] . '-deleted-' . time(),
        ]);

        $deleted = $produkModel->delete($id);
        // dd($id);
        if ($deleted) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Produk berhasil di hapus.'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/produk?page_produk=' . $this->request->getVar('pager'));
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada penghapusan produk'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/produk?page_produk=' . $this->request->getVar('pager'))->withInput();
        }
    }

    //delete batch
    public function deleteBatch()
    {
        $produkModel = new ProdukModel();
        $item = $this->request->getVar('produk_id');
        foreach ($item as $id) {
            $produk = $produkModel->find($id);

            if ($produk['img'] != 'default.png') {
                $gambarLamaPath = 'assets/img/produk/main/' . $produk['img'];
                if (file_exists($gambarLamaPath)) {
                    unlink($gambarLamaPath);
                }
            }
            $produkModel->save(['id_produk' => $id, 'slug' => $produk['slug'] . '-deleted-' . time()]);
            $deleted = $produkModel->delete($id);
        }
        if ($deleted) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Produk berhasil di hapus.'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/produk?page_produk=' . $this->request->getVar('pager'));
        }
    }
}
