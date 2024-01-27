<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\VariasiModel;
use App\Models\KategoriModel;
use App\Models\SubKategoriModel;
use App\Controllers\BaseController;
use App\Models\AdminTokoModel;
use App\Models\ProdukRekomendasiModel;
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
        $totalProduk = $produkModel->countAllResults();

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
        $pa['kategori'] = [];
        $pa['sub_kategori'] = [];
        $pa['variasi_item'] = [];
        $pa['stok'] = [];
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
            'totalProduk' => $totalProduk,
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
            ],
            // 'parent_kategori_id'    => [
            //     'rules'  => 'required',
            //     'errors' => [
            //         'required' => 'Kategori wajib diisi.',
            //     ],
            // ]
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
        // dd($data2);

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

        if ($variasiItemList == null) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Varian harus diisi terlebih dahulu.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/produk');
        }

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

    public function saveUpdateProduk($id)
    {
        // dd($this->request->getVar());
        $id = $this->request->getVar('id_produk');
        $id_variasi_item = $this->request->getVar('id_variasi_item');
        $produkModel = new ProdukModel();
        $variasItemiModel = new VariasiItemModel();
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
            'id_produk' => $id,
            'slug' => $slug,
            'nama' => $this->request->getVar('nama'),
            'sku' => $this->request->getVar('sku'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'img' => $namaProdukImage,
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
        // dd($id_varian);
        $data2 = [
            'id_variasi_item' => $id_variasi_item,
            'id_variasi' => $id_varian,
            'value_item' => $this->request->getVar('valueItem'),
            'harga_item' => $this->request->getVar('harga'),
            'berat' => $this->request->getVar('berat'),
        ];
        // dd($data2);

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
        if (!$this->validateData($data, $ruleData) || !$this->validateData($data2, $variasItemiModel->validationRules)) {
            return redirect()->to('dashboard/produk/update-produk/' . $id)->withInput();
        }
        // Pembaruan data produk
        if ($produkModel->update($id, $data)) {
            if ($variasItemiModel->save($data2)) {
                session()->setFlashdata('success', 'Produk berhasil diubah.');
                $alert = [
                    'type' => 'success',
                    'title' => 'Berhasil',
                    'message' => 'Produk berhasil diubah.'
                ];
                session()->setFlashdata('alert', $alert);

                return redirect()->to('dashboard/produk?page_produk=' . $this->request->getVar('page'));
            }
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
    // ============================================
    // Ubah Urutan Produk Controller //
    // ============================================
    public function managementFetching()
    {
        $data = [
            'title' => 'Management Fetching Produk',
        ];
        return view('dashboard/produk/produkContent/managementFetching', $data);
    }

    public function pilihProdukTerbaru()
    {
        $produkModel = new ProdukModel();


        $produkTerbaru = $produkModel->orderBy('short', 'ASC')->getLatestProducts(6);

        $data = [
            'produkTerbaru' => $produkTerbaru,
            'kategori' => $produkModel->findAll()
        ];

        return view('dashboard/produk/produkContent/pilihProdukTerbaru', $data);
    }

    public function saveProdukTerbaru()
    {
        $produkModel = new ProdukModel();
        $idProduk = $this->request->getVar('id_produk');
        $originalOrder = $this->request->getVar('original_order');

        // Memulai transaksi
        $produkModel->transStart();

        try {
            foreach ($idProduk as $key => $id) {
                $produkModel->update($id, ['short' => $key + 1]); // Memperbarui 'short' berdasarkan urutan baru
            }

            $produkModel->transComplete();

            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Urutan Produk berhasil diubah.'
            ];
        } catch (\Exception $e) {
            $produkModel->transRollback();

            $alert = [
                'type' => 'error',
                'title' => 'Gagal',
                'message' => 'Terjadi kesalahan saat menyimpan urutan produk.'
            ];
        }

        session()->setFlashdata('alert', $alert);
        return redirect()->to('dashboard/produk/pilih-produk-terbaru');
    }

    // ============================================
    // Produk Rekomendasi //
    // ============================================

    public function pilihProdukRekomendasi()
    {
        $produkModel = new ProdukModel();
        $rekomendasiModel = new ProdukRekomendasiModel();

        // Ambil data 6 produk terbaru dan urutkan berdasarkan 'short'
        $produkTerbaru = $produkModel->orderBy('short', 'ASC')->getLatestProducts(6);
        $produkRekomendasi = $rekomendasiModel->orderBy('short', 'ASC')->getLatestProducts(6);

        // Menyisipkan detail produk ke dalam array produkRekomendasi
        foreach ($produkRekomendasi as $key => $produk) {
            $produkDetail = $produkModel->getProdukById($produk['id_produk']);
            $produkRekomendasi[$key]['img'] = $produkDetail['img'];
            $produkRekomendasi[$key]['nama'] = $produkDetail['nama'];
        }

        $data = [
            'produkTerbaru' => $produkTerbaru,
            'produkRekomendasi' => $produkRekomendasi,
            'kategori' => $produkModel->findAll(),
            'produkModel' => $produkModel, // Pass $produkModel to the view
        ];

        return view('dashboard/produk/produkContent/pilihProdukRekomendasi', $data);
    }

    public function savePilihProdukRekomendasi()
    {
        if ($this->request->getMethod() === 'post') {
            // Mendapatkan data produk yang dipilih dari form
            $produkIds = $this->request->getPost('produk_id');

            // Memastikan setidaknya satu produk dipilih
            if (empty($produkIds)) {
                // Menampilkan pesan error jika tidak ada produk yang dipilih
                return redirect()->to('dashboard/produk/pilih-produk-rekomendasi')->withInput()->with('alert', [
                    'type'    => 'error',
                    'title'   => 'Error',
                    'message' => 'Pilih Produk Terlebih Dahulu!'
                ]);
            }

            // Menyimpan produk rekomendasi jika sudah memilih setidaknya satu produk
            $this->saveRekomendasiProduk($produkIds);

            return redirect()->to('dashboard/produk/pilih-produk-rekomendasi')->with('alert', [
                'type'    => 'success',
                'title'   => 'Berhasil',
                'message' => 'Pilihan Produk Rekomendasi berhasil disimpan.'
            ]);
        }

        return redirect()->back();
    }

    public function saveRekomendasiProduk($produkId)
    {
        $rekomendasiModel = new ProdukRekomendasiModel();

        $validationResult = $rekomendasiModel->validasiProduk($produkId);

        if ($validationResult['type'] === 'error') {
            // If there's an error, show an error message
            $alert = [
                'type' => 'error',
                'title' => 'Gagal',
                'message' => $validationResult['message']
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/produk/pilih-produk-rekomendasi');
        }

        // If validation is successful, show success message
        $alert = [
            'type' => 'success',
            'title' => 'Berhasil',
            'message' => $validationResult['message']
        ];
        session()->setFlashdata('alert', $alert);
        return redirect()->to('dashboard/produk/pilih-produk-rekomendasi');
    }

    // delete
    public function deleteProdukRekomendasi($id)
    {
        $rekomendasiModel = new ProdukRekomendasiModel();

        if ($rekomendasiModel->delete($id)) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Produk rekomendasi berhasil dihapus.'
            ];
            session()->setFlashdata('alert', $alert);
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terjadi kesalahan pada penghapusan produk rekomendasi.'
            ];
            session()->setFlashdata('alert', $alert);
        }

        return redirect()->to('dashboard/produk/pilih-produk-rekomendasi');
    }

    public function saveUrutanProdukRekomendasi()
    {
        $produkRekomendasiModel = new ProdukRekomendasiModel();
        $item = $this->request->getVar('id_rekomendasi');
        $j = 1;
        // dd($item);
        foreach ($item as $i) {
            $produkRekomendasiModel->save([
                'id_rekomendasi' => $i,
                'short' => $j++
            ]);
        }

        $alert = [
            'type' => 'success',
            'title' => 'Berhasil',
            'message' => 'Urutan Produk Rekomendasi berhasil di ubah.'
        ];
        session()->setFlashdata('alert', $alert);
        return redirect()->to('dashboard/produk/pilih-produk-rekomendasi');
    }
}
