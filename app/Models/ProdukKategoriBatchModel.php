<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukKategoriBatchModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_produk_batch';
    protected $primaryKey       = 'id_produk_batch';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama',
        'slug',
        'sku',
        'deskripsi',
        'img',
        'is_active',
        'created_by'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'nama' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Nama produk wajib diisi.',
            ],
        ],
        'sku'    => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'SKU wajib diisi.',
            ],
        ],
        'deskripsi'    => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Deskripsi wajib diisi.',
            ],
        ],
    ];
    protected $validationMessages   = [
        'nama' => [
            'required' => 'Nama produk wajib diisi.',
        ],
        'sku' => [
            'required' => 'SKU wajib diisi.',
        ],
        'deskripsi' => [
            'required' => 'Deskripsi wajib diisi.',
        ],
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
            return $this->where('deleted_at', null)->findAll();
        }

        return $this->select('jsf_produk_batch.*, MIN(CAST(vi.harga_item AS DECIMAL)) AS harga_min, MAX(CAST(vi.harga_item AS DECIMAL)) AS harga_max')
            ->join('jsf_variasi_item vi', 'jsf_produk.id_produk_batch = vi.id_produk_batch', 'left')
            ->groupBy('jsf_produk.id_produk, jsf_produk.nama')->where(['slug' => $slug1])->first();
    }

    public function getSubKategoriByKategori($kategoriId)
    {
        return $this->db->table('jsf_sub_kategori')
            ->where('id_kategori', $kategoriId)
            ->get()
            ->getResultArray();
    }
    public function getNamaKategori($produkId)
    {
        // Query untuk mengambil nama kategori berdasarkan ID produk
        return $this->db->table('jsf_produk_batch')
            ->join('jsf_sub_kategori', 'jsf_sub_kategori.id_sub_kategori = jsf_produk_batch.id_sub_kategori')
            ->join('jsf_kategori', 'jsf_kategori.id_kategori = jsf_sub_kategori.id_kategori')
            ->where('jsf_produk_batch.id_produk_batch', $produkId)
            ->select('jsf_kategori.nama_kategori')
            ->get()
            ->getRowArray();
    }

    public function getProdukWithVarianBySlug($slug, $id_varian)
    {
        return $this->db->table('jsf_produk_batch')
            ->select('*')
            ->join('jsf_variasi_item', 'jsf_variasi_item.id_produk_batch = jsf_produk.id_produk_batch', 'INNER')
            ->where('slug', $slug)
            ->where('id_variasi_item', $id_varian)
            ->get()
            ->getResultArray()[0];
    }

    public function getRandomProducts()
    {
        $products = $this->select('jsf_produk.*, MIN(CAST(vi.harga_item AS DECIMAL)) AS harga_min, MAX(CAST(vi.harga_item AS DECIMAL)) AS harga_max')
            ->join('jsf_variasi_item vi', 'jsf_produk.id_produk = vi.id_produk_batch', 'left')
            ->groupBy('jsf_produk.id_produk, jsf_produk.nama')
            ->orderBy('RAND()')->findAll(10);
        return $products;
    }

    public function getProductWithRange($k = false, $sk = false, $search = false, $page = 1, $limit = 5)
    {
        $offset = ($page - 1) * $limit; // Menghitung offset berdasarkan halaman
        $getProduk = $this->db->table('jsf_produk_batch p')
            ->select('p.*, MIN(CAST(vi.harga_item AS DECIMAL)) AS harga_min, MAX(CAST(vi.harga_item AS DECIMAL)) AS harga_max')
            ->join('jsf_variasi_item vi', 'p.id_produk_batch = vi.id_produk_batch', 'left')
            ->groupBy('p.id_produk_batch, p.nama')
            ->where('deleted_at', null);
        if ($k != false) {
            $getProduk->where('id_kategori', $k);
            if ($sk != false) {
                $getProduk->where('id_sub_kategori', $sk);
            }
        }
        if ($search != false) {
            $getProduk->like('nama', $search);
        }
        $getProduk->limit($limit, $offset);
        return $getProduk->get()->getResultArray();
    }
    public function adminProdukSearch($keyword)
    {
        return $this->table('jsf_produk_batch')->where('deleted_at', null)->like('nama', $keyword);
    }

    public function insertCategoryAssociation($productId, $categoryId)
    {
        $data = [
            'id_produk_batch' => $productId,
            'id_kategori' => $categoryId,
        ];
        return $this->db->table('jsf_kategori_produk')->insert($data);
    }

    public function insertSubcategoryAssociation($productId, $subcategoryId)
    {
        $data = [
            'id_produk_batch' => $productId,
            'id_sub_kategori' => $subcategoryId,
        ];
        return $this->db->table('jsf_sub_kategori_produk')->insert($data);
    }
}
