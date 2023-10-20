<?php

namespace App\Controllers;


use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\VariasiItemModel;
use App\Models\VariasiModel;

class AdminVariasiController extends BaseController
{
    public function index()
    {
        $variasiModel = new VariasiModel();
    }
    // Variasi Produk
    public function tambahVariasi()
    {
        $variasiModel = new VariasiModel();
        $variasiList = $variasiModel->findAll();
        $data = [
            'variasi' => $variasiList
        ];
        // dd($data);
        return view('dashboard/produk/tambahVariasi', $data);
    }
    // Save
    public function saveVariasi()
    {
        // ambil gambar
        $variasiModel = new VariasiModel();

        $data = [
            'nama_varian' => $this->request->getVar('nama_varian'),
        ];

        if (!$this->validateData($data, $variasiModel->validationRules) || !$this->validateData($data, [
            'nama_varian' => [
                'rules' => 'is_unique[jsf_variasi.nama_varian]',
                'errors' => [
                    'is_unique' => 'Nama varian sudah ada dalam database.',
                ]
            ]
        ])) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to(base_url('dashboard/produk/tambah-variasi'))->withInput();
        }
        // swet alert
        if ($variasiModel->save($data)) {
            session()->setFlashdata('success', 'Variasi produk berhasil disimpan.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Variasi Produk berhasil disimpan.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/produk/tambah-variasi')->withInput();
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/produk/tambah-variasi')->withInput();
        }
    }
    // Delete
    public function deleteVariasi($id)
    {
        $variasiModel = new VariasiModel();
        $variasi = $variasiModel->find($id);

        $deleted = $variasiModel->delete($id);
        // dd($id);
        if ($deleted) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Variasi berhasil dihapus.'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/produk/tambah-variasi');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada penghapusan variasi'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/produk/tambah-variasi')->withInput();
        }
    }
    // Update Produk
    public function updateVariasi($id)
    {
        session();

        $variasiModel = new VariasiModel();

        $v = $variasiModel->find($id);
        $data = [
            'title' => 'Edit Produk',
            'v' => $v,
            'back'  => 'dashboard'
        ];
        return view('dashboard/produk/updateVariasi', $data);
    }
    public function editVariasi($id)
    {
        $variasiModel = new VariasiModel();

        $data = [
            'id_variasi' => $id,
            'nama_varian' => $this->request->getVar('nama_varian'),
        ];
        if (!$this->validateData($data, $variasiModel->validationRules)) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to('dashboard/produk/tambah-variasi/update-variasi/' . $id)->withInput();
        }
        if ($variasiModel->save($data)) {
            session()->setFlashdata('success', 'Variasi berhasil diubah.');
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Variasi berhasil diubah.'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/produk/tambah-variasi');
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);

            return redirect()->to('dashboard/produk/tambah-variasi/update-variasi/' . $id)->withInput();
        }
    }

    public function detail($slug)
    {
        session();
        $produkModel = new ProdukModel();
        $variasiModel = new VariasiModel();
        $variasiItemModel = new VariasiItemModel();
        $produk = $produkModel->getProduk($slug);
        $variasi = $variasiModel->findAll();
        $varianList = $variasiItemModel->getByIdProduk($produk['id_produk']);
        // dd($varianList);
        $data = [
            'produk' => $produk,
            'variasi' => $variasi,
            'varian' => $varianList
        ];
        // dd($data);
        return view('dashboard/produk/detailPorduk', $data);
    }

    public function saveVarianItem()
    {
        // dd($this->request->getVar());
        $variasiItemModel = new VariasiItemModel();
        if ($this->request->getVar('selectVariant') == '') {
            $data = [
                'id_variasi' => null,
                'id_produk' => $this->request->getVar('id_produk'),
                'value_item' => $this->request->getVar('valueItem'),
                'harga_item' => $this->request->getVar('harga'),
                'berat' => $this->request->getVar('berat'),
            ];
        } else {
            $data = [
                'id_variasi' => $this->request->getVar('selectVariant'),
                'id_produk' => $this->request->getVar('id_produk'),
                'value_item' => $this->request->getVar('valueItem'),
                'harga_item' => $this->request->getVar('harga'),
                'berat' => $this->request->getVar('berat'),
            ];
        }
        //validate
        if (!$this->validateData($data, $variasiItemModel->validationRules) || !$this->validateData($data, [
            'id_variasi' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'Variasi wajib dipilih.',
                    'numeric' => 'Variasi wajib dipilih.',
                ],
            ]
        ])) {
            $alert = [
                'type' => 'error',
                'title' => 'Error',
                'message' => 'Terdapat kesalahan pada pengisian formulir'
            ];
            session()->setFlashdata('alert', $alert);
            session()->setFlashdata('gagal', true);
            return redirect()->to(base_url('dashboard/produk/detail-varian/' . $this->request->getVar('slug')))->withInput();
        }

        $variasiItemModel->save($data);
        $alert = [
            'type' => 'success',
            'title' => 'Berhasil',
            'message' => 'Berhasi Menambahkan Varian'
        ];
        session()->setFlashdata('alert', $alert);
        return redirect()->to(base_url('dashboard/produk/detail-varian/' . $this->request->getVar('slug')));
    }

    public function deleteVarianItem($id)
    {
        $variasiItemModel = new VariasiItemModel();
        if (!$variasiItemModel->delete($id)) {
            return 'Gagal';
        }
        return redirect()->to(base_url('dashboard/produk/detail-varian/' . $this->request->getVar('slug')));
    }

    public function updateVarianItem()
    {
        $variasiItemModel = new VariasiItemModel();
        $data = [
            'id_variasi_item' => $this->request->getVar('id_vi'),
            'value_item' => $this->request->getVar('valueItem'),
            'harga_item' => $this->request->getVar('harga'),
            'berat' => $this->request->getVar('berat'),
        ];
        //validation
        if ($variasiItemModel->save($data)) {
            $alert = [
                'type' => 'success',
                'title' => 'Berhasil',
                'message' => 'Berhasi Menupdate Varian'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to(base_url('dashboard/produk/detail-varian/' . $this->request->getVar('slug')));
        } else {
            $alert = [
                'type' => 'error',
                'title' => 'Gagal',
                'message' => 'Gagal Menupdate Varian'
            ];
            session()->setFlashdata('alert', $alert);
            return redirect()->to(base_url('dashboard/produk/detail-varian/' . $this->request->getVar('slug')))->withInput();
        }
    }
}
