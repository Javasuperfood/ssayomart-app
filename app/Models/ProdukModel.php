<?php

namespace App\Models;

use CodeIgniter\Model;
use PhpParser\Node\Expr\List_;

class ProdukModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_produk';
    protected $primaryKey       = 'id_produk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_kategori',
        'nama',
        'slug',
        'sku',
        // 'stok',
        'deskripsi',
        'img',
        'is_active',
        'id_sub_kategori',
        'short',
        'created_by'
    ];

    // Dates
    protected $useTimestamps = true;
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

        return $this->select('jsf_produk.*, MIN(CAST(vi.harga_item AS DECIMAL)) AS harga_min, MAX(CAST(vi.harga_item AS DECIMAL)) AS harga_max')
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
    public function getProdukWithVarianByID($id_produk, $id_varian)
    {
        return $this->db->table('jsf_produk')
            ->select('*')
            ->join('jsf_variasi_item', 'jsf_variasi_item.id_produk = jsf_produk.id_produk', 'INNER')
            ->where('jsf_produk.id_produk', $id_produk)
            ->where('id_variasi_item', $id_varian)
            ->get()
            ->getResultArray()[0];
    }

    public function getRandomProducts()
    {
        $products = $this->select('jsf_produk.*,vi.id_variasi_item, MIN(CAST(vi.harga_item AS DECIMAL)) AS harga_min, MAX(CAST(vi.harga_item AS DECIMAL)) AS harga_max')
            ->join('jsf_variasi_item vi', 'jsf_produk.id_produk = vi.id_produk', 'left')
            ->groupBy('jsf_produk.id_produk, jsf_produk.nama, vi.id_variasi_item')
            ->orderBy('RAND()')->findAll(10);
        return $products;
    }

    // public function getProductWithRange($k = false, $sk = false, $search = false, $page = 1, $limit = 10)
    // {
    //     $offset = ($page - 1) * $limit; // Calculate offset based on page

    //     // comment no idvarisaiitem produk List_
    //     // $getProduk = $this->db->table('jsf_produk p')
    //     //     ->select('p.*, MIN(CAST(vi.harga_item AS DECIMAL)) AS harga_min, MAX(CAST(vi.harga_item AS DECIMAL)) AS harga_max')
    //     //     ->join('jsf_variasi_item vi', 'p.id_produk = vi.id_produk', 'left')
    //     //     ->groupBy('p.id_produk, p.nama')
    //     //     ->where('deleted_at', null);
    //     $getProduk = $this->db->table('jsf_produk p')
    //         ->select('p.*, vi.id_variasi_item, MIN(CAST(vi.harga_item AS DECIMAL)) AS harga_min, MAX(CAST(vi.harga_item AS DECIMAL)) AS harga_max')
    //         ->join('jsf_variasi_item vi', 'p.id_produk = vi.id_produk', 'left')
    //         ->join('jsf_stock s', 'p.id_produk = s.id_produk', 'left')
    //         ->groupBy('p.id_produk, p.nama, vi.id_variasi_item')  // Include 'vi.id_variasi_item' in the GROUP BY clause
    //         ->where('p.deleted_at', null);

    //     if ($k != false) {
    //         $getProduk->where('id_kategori', $k);
    //     }

    //     if ($sk != false) {
    //         $getProduk->where('id_sub_kategori', $sk);
    //     }

    //     if ($search != false) {
    //         $getProduk->like('nama', $search);
    //     }

    //     $getProduk->orderBy('CASE WHEN s.stok >= 50 THEN 0 ELSE 1 END', 'ASC', false);

    //     // $getProduk->orderBy('s.stok', '>=', 100);

    //     // $getProduk->orderBy('created_at', 'ASC'); 

    //     $getProduk->limit($limit, $offset);

    //     return $getProduk->get()->getResultArray();
    // }

    // ...

    // public function getProductWithRange($k = false, $sk = false, $search = false, $page = 1, $limit = 10)
    // {
    //     $offset = ($page - 1) * $limit; // Hitung offset berdasarkan halaman

    //     $getProduk = $this->db->table('jsf_produk p')
    //         ->select('p.*, vi.id_variasi_item, MIN(CAST(vi.harga_item AS DECIMAL)) AS harga_min, MAX(CAST(vi.harga_item AS DECIMAL)) AS harga_max')
    //         ->join('jsf_variasi_item vi', 'p.id_produk = vi.id_produk', 'left')
    //         ->join('jsf_stock s', 'p.id_produk = s.id_produk', 'left')
    //         ->groupBy('p.id_produk, p.nama, vi.id_variasi_item')  // Sertakan 'vi.id_variasi_item' dalam klausa GROUP BY
    //         ->where('p.deleted_at', null);

    //     if ($k != false) {
    //         $getProduk->where('id_kategori', $k);
    //     }

    //     if ($sk != false) {
    //         $getProduk->where('id_sub_kategori', $sk);
    //     }

    //     if ($search != false) {
    //         $getProduk->like('nama', $search);
    //     }

    //     // Tambahkan klausa orderBy untuk mengurutkan berdasarkan nama produk
    //     $getProduk->orderBy('p.nama', 'ASC');

    //     $getProduk->orderBy('CASE WHEN s.stok >= 50 THEN 0 ELSE 1 END', 'ASC', false);
    //     $getProduk->limit($limit, $offset);

    //     return $getProduk->get()->getResultArray();
    // }

    // ...

    public function getProductWithRange($k = false, $sk = false, $search = false, $page = 1, $limit = 10)
    {
        $offset = ($page - 1) * $limit; // Hitung offset berdasarkan halaman

        $getProduk = $this->db->table('jsf_produk p')
            ->select('p.*, vi.id_variasi_item, MIN(CAST(vi.harga_item AS DECIMAL)) AS harga_min, MAX(CAST(vi.harga_item AS DECIMAL)) AS harga_max')
            ->join('jsf_variasi_item vi', 'p.id_produk = vi.id_produk', 'left')
            ->join('jsf_stock s', 'p.id_produk = s.id_produk', 'left')
            ->groupBy('p.id_produk, p.nama, vi.id_variasi_item')  // Sertakan 'vi.id_variasi_item' dalam klausa GROUP BY
            ->where('p.deleted_at', null);

        if ($k != false) {
            $getProduk->where('id_kategori', $k);
        }

        if ($sk != false) {
            $getProduk->where('id_sub_kategori', $sk);
        }

        if ($search != false) {
            $getProduk->like('nama', $search);
        }

        // Tambahkan klausa orderBy untuk mengurutkan berdasarkan urutan angka dalam nama produk
        $getProduk->orderBy("CAST(SUBSTRING(p.nama FROM 1 FOR 5) AS UNSIGNED)", 'ASC');
        // Mengasumsikan bahwa angka dalam nama produk tidak melebihi panjang 5 karakter. Sesuaikan sesuai kebutuhan.

        $getProduk->orderBy('CASE WHEN s.stok >= 50 THEN 0 ELSE 1 END', 'ASC', false);
        $getProduk->limit($limit, $offset);

        return $getProduk->get()->getResultArray();
    }

    public function getHistoryTransaction($keyword, $page = 1)
    {
        return $this->table('jsf_produk')->where('deleted_at', null)->like('nama', 'sku', $keyword);
    }

    public function adminProdukSearch($keyword)
    {
        return $this->table('jsf_produk')->where('deleted_at', null)->like('nama', '%' . $keyword . '%')->orLike('sku', '%' . $keyword . '%');
    }

    public function adminProdukCategorySearch($categoryKeyword)
    {
        return $this->table('jsf_produk')
            ->where('deleted_at', null)
            ->join('jsf_kategori', 'jsf_kategori.id_kategori = jsf_produk.id_kategori')
            ->like('jsf_kategori.nama_kategori', '%' . $categoryKeyword . '%');
    }

    public function insertCategoryAssociation($productId, $categoryId)
    {
        $data = [
            'id_produk' => $productId,
            'id_kategori' => $categoryId,
        ];
        return $this->db->table('jsf_kategori_produk')->insert($data);
    }

    public function insertSubcategoryAssociation($productId, $subcategoryId)
    {
        $data = [
            'id_produk' => $productId,
            'id_sub_kategori' => $subcategoryId,
        ];
        return $this->db->table('jsf_sub_kategori_produk')->insert($data);
    }

    // jika parameter yang akan dibuat kondisi wajib mempunya value null di setiap parameter
    public function getFeaturedProductsByCategory($slug1 = null, $slug2 = null)
    {

        $query = $this->select('jsf_produk.*, vi.id_variasi_item, MIN(CAST(vi.harga_item AS DECIMAL)) AS harga_min, MAX(CAST(vi.harga_item AS DECIMAL)) AS harga_max, SUM(p.qty) AS total_qty')
            ->join('jsf_kategori', 'jsf_kategori.id_kategori = jsf_produk.id_kategori', 'left')
            ->join('jsf_variasi_item vi', 'jsf_produk.id_produk = vi.id_produk', 'left')
            ->join('jsf_checkout_produk p', 'jsf_produk.id_produk = p.id_produk', 'left');

        if ($slug1 != null) {
            $query->where('jsf_kategori.slug', $slug1);
        }

        if ($slug2 != null) {
            $query->join('jsf_sub_kategori', 'jsf_sub_kategori.id_sub_kategori = jsf_produk.id_sub_kategori', 'left');
            $query->where('jsf_sub_kategori.slug', $slug2);
        }

        $query->where('p.id_produk IS NOT NULL')->where('jsf_produk.deleted_at', null);

        // jsf_produk.id_produk & p.qty harus masuk pada group
        $query->groupBy('jsf_produk.id_produk, vi.id_variasi_item')
            ->orderBy('total_qty', 'DESC')
            ->limit(3);
        $result = $query->get()->getResultArray();
        // dd($result);
        return $result;
    }

    public function getProdukHome($short = null)
    {
        $getProduk = $this->select('jsf_produk.*, vi.id_variasi_item, MIN(CAST(vi.harga_item AS DECIMAL)) AS harga_min, MAX(CAST(vi.harga_item AS DECIMAL)) AS harga_max')
            ->join('jsf_variasi_item vi', 'jsf_produk.id_produk = vi.id_produk', 'left')
            ->where('jsf_produk.deleted_at', null);
        if ($short == 'rekomendasi') {
            $getProduk->join('jsf_produk_rekomendasi', 'jsf_produk.id_produk = jsf_produk_rekomendasi.id_produk')
                ->groupBy('jsf_produk.id_produk, jsf_produk.nama, vi.id_variasi_item, jsf_produk_rekomendasi.short')
                ->orderBy('jsf_produk_rekomendasi.short', 'ASC')->limit(6);
        }
        if ($short == 'produk_terbaru') {
            $getProduk->groupBy('jsf_produk.id_produk, jsf_produk.nama, vi.id_variasi_item')
                ->orderBy('jsf_produk.id_produk', 'DESC')->limit(6);
        }
        // if ($short == 'kimchi') {
        //     $getProduk->groupBy('jsf_produk.id_produk, jsf_produk.nama, vi.id_variasi_item')
        //         ->orderBy('jsf_produk.id_produk', 'desc')->limit(6);
        // }
        $result = $getProduk->get()->getResultArray();
        return $result;
    }

    public function getLatestProducts($limit = 6)
    {
        return $this->select('*')
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->where('deleted_at', null)
            ->findAll();
    }

    public function getProdukById($id)
    {
        return $this->find($id);
    }

    public function getFeaturedProducts()
    {

        $query = $this->select('jsf_produk.*, vi.id_variasi_item, MIN(CAST(vi.harga_item AS DECIMAL)) AS harga_min, MAX(CAST(vi.harga_item AS DECIMAL)) AS harga_max, SUM(p.qty) AS total_qty')
            ->join('jsf_variasi_item vi', 'jsf_produk.id_produk = vi.id_produk', 'left')
            ->join('jsf_checkout_produk p', 'jsf_produk.id_produk = p.id_produk', 'left');

        $query->where('p.id_produk IS NOT NULL')->where('jsf_produk.deleted_at', null);

        // jsf_produk.id_produk & p.qty harus masuk pada group
        $query->groupBy('jsf_produk.id_produk, vi.id_variasi_item')
            ->orderBy('total_qty', 'DESC')
            ->limit(3);
        $result = $query->get()->getResultArray();
        // dd($result);
        return $result;
    }
}
