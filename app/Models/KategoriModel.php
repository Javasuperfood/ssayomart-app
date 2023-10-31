<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_kategori';
    protected $primaryKey       = 'id_kategori';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_kategori',
        'deskripsi',
        'slug',
        'img',
        'short'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nama_kategori' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Nama kategori wajib diisi.',
            ],
        ],
        'deskripsi' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Deskripsi kategori wajib diisi.',
            ],
        ],
        'img' => [
            'rules' => 'max_size[img,1024]',
            'errors' => [
                'max_size' => 'Ukuran gambar terlalu besar',
                'is_image' => 'Yang anda pilih bukan gambar'
            ]
        ]
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getKategori($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function getKategoriByProdukId($id_produk)
    {
        return $this->select('nama_kategori')
            ->join('jsf_produk', 'jsf_produk.id_kategori = jsf_kategori.id_kategori')
            ->where('jsf_produk.id_produk', $id_produk)
            ->first();
    }

    public function getGambarKategori($slug)
    {
        return $this->where(['slug' => $slug])->select('img')->first();
    }

    public function delKategori($id)
    {
        $subKategoriModel = new SubKategoriModel();
        $produkModel = new ProdukModel();
        $builder = $produkModel->builder();
        $builder->where('id_kategori', $id);
        $builder->update(['id_kategori' => null]);
        $builder = $subKategoriModel->builder();
        $builder->where('id_kategori', $id);
        $builder->update(['id_kategori' => null]);
        return $this->delete($id);
    }
}
