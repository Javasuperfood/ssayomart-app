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

    public function getProduk($slug1 = false)
    {
        if ($slug1 == false) {
            return $this->findAll();
        }

        return $this->select('jsf_produk.*, MIN(vi.harga_item) AS harga_min, MAX(vi.harga_item) AS harga_max')
            ->join('jsf_variasi_item vi', 'jsf_produk.id_produk = vi.id_produk', 'left')
            ->groupBy('jsf_produk.id_produk, jsf_produk.nama')->where(['slug' => $slug1])->first();
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

    public function getProdukWithVarianBySlug($slug, $id_varian)
    {
        return $this->db->table('jsf_produk')
            ->select('*')
            ->join('jsf_variasi_item', 'jsf_variasi_item.id_produk = jsf_produk.id_produk', 'INNER')
            ->where('slug', $slug)
            ->where('id_variasi_item', $id_varian)
            ->get()
            ->getResultArray()[0];
    }

    public function getRandomProducts()
    {
        $products = $this->select('jsf_produk.*, MIN(vi.harga_item) AS harga_min, MAX(vi.harga_item) AS harga_max')
            ->join('jsf_variasi_item vi', 'jsf_produk.id_produk = vi.id_produk', 'left')
            ->groupBy('jsf_produk.id_produk, jsf_produk.nama')
            ->orderBy('RAND()')->findAll(10);
        return $products;
    }

    public function getProductWithRange($k = false, $sk = false, $keyword = false)
    {
        $getProduk = $this->db->table('jsf_produk p')
            ->select('p.*, MIN(vi.harga_item) AS harga_min, MAX(vi.harga_item) AS harga_max')
            ->join('jsf_variasi_item vi', 'p.id_produk = vi.id_produk', 'left')
            ->groupBy('p.id_produk, p.nama');
        if ($k != false) {
            $getProduk->where('id_kategori', $k);
            if ($sk != false) {
                $getProduk->where('id_sub_kategori', $sk);
            }
        }
        if ($keyword != false) {
            $getProduk->like('nama', $keyword);
        }
        return $getProduk->get()->getResultArray();
    }
}
