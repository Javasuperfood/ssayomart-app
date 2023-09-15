<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_produk';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_kategori',
        'nama',
        'slug',
        'sku',
        'harga',
        // 'stok',
        'deskripsi',
        'img',
        // 'id_sub_kategori',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'nama' => 'required',
        // 'slug'    => 'required',
        'sku'    => 'required',
        'harga'    => 'required',
        // 'stok'    => 'required',
        'deskripsi'    => 'required',
        'img'    => 'required',
        // 'id_kategori' => 'required',
        // 'id_sub_kategori' => 'required',
    ];
    protected $validationMessages   = [
        'sku' => [
            'errors' => [
                'is_unique' => '{field} SKU sudah terdaftar.',
                'required' => '{field} buku harus diisi.',
            ]
        ]
    ];
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

    public function getProduk($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function getSubKategoriByKategori($kategoriId)
    {
        return $this->db->table('jsf_subkategori')
            ->where('id_kategori', $kategoriId)
            ->get()
            ->getResultArray();
    }
    public function getNamaKategori($produkId)
    {
        // Query untuk mengambil nama kategori berdasarkan ID produk
        return $this->db->table('jsf_produk')
            ->join('jsf_subkategori', 'jsf_subkategori.id_sub_kategori = jsf_produk.id_sub_kategori')
            ->join('jsf_kategori', 'jsf_kategori.id_kategori = jsf_subkategori.id_kategori')
            ->where('jsf_produk.id_produk', $produkId)
            ->select('jsf_kategori.nama_kategori')
            ->get()
            ->getRowArray();
    }
}
