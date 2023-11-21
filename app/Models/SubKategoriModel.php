<?php

namespace App\Models;

use CodeIgniter\Model;

class SubKategoriModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_sub_kategori';
    protected $primaryKey       = 'id_sub_kategori';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_kategori',
        'nama_kategori',
        'deskripsi',
        'slug',
        'img',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'id_kategori' => 'required',
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
    public function getSubKategori($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function getSubKategoriByKategoriId($id)
    {
        return $this->select('jsf_kategori.slug as slugK, jsf_sub_kategori.slug as slugS , jsf_sub_kategori.nama_kategori')
            ->join('jsf_kategori', 'jsf_kategori.id_kategori = jsf_sub_kategori.id_kategori', 'inner')
            ->where('jsf_sub_kategori.id_kategori', $id)->findAll();
    }
    public function getSubKategoriByProdukId($id_produk)
    {
        return $this->select('nama_kategori')
            ->join('jsf_produk', 'jsf_produk.id_sub_kategori = jsf_sub_kategori.id_sub_kategori')
            ->where('jsf_produk.id_produk', $id_produk)
            ->first();
    }

    public function joinTable()
    {
        $db = \Config\Database::connect();
        $query = $db->table('jsf_kategori')
            ->select(
                'jsf_kategori.*, 
            jsf_sub_kategori.id_kategori AS id_kategori_sub,
            jsf_sub_kategori.id_sub_kategori AS id_sub_kategori,
            jsf_sub_kategori.nama_kategori AS nama_sub_kategori,
            jsf_sub_kategori.img AS img_sub_kategori,
            jsf_sub_kategori.slug AS slug_sub_kategori'
            )
            ->join('jsf_sub_kategori', 'jsf_sub_kategori.id_kategori = jsf_kategori.id_kategori', 'left')
            ->get();

        $result = $query->getResult();
        return $result;
    }

    public function delSubKategori($id)
    {
        $produkModel = new ProdukModel();
        $builder = $produkModel->builder();
        $builder->where('id_sub_kategori', $id);
        $builder->update(['id_sub_kategori' => null]);
        return  $this->delete($id);
    }
}
