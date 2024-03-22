<?php

namespace App\Models;

use CodeIgniter\Model;

class PromoProduk extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_promo_produk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_promo',
        'id_produk',
        'promo_img',
        'promo_deskripsi'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'id_promo' => 'required',
        'id_produk' => 'required',
        'promo_img' => 'required',
        'promo_deskripsi' => 'required',
    ];
    protected $validationMessages   = [
        'id_promo' => [
            'required' => 'Promo wajib diisi.',
        ],
        'id_produk' => [
            'required' => 'Produk wajib diisi.',
        ],
        'promo_img' => [
            'required' => 'Foto Promo wajib diisi.',
        ],
        'promo_deskripsi' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Deskripsi promosi bundling wajib diisi.',
            ],
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

    public function getPromo($slug)
    {
        $db = \Config\Database::connect();
        $query = $db->table('jsf_promo_produk')
            ->select('jsf_promo_produk.*, jsf_promo.*, vi.*, jsf_produk.*, jsf_promo.title as title, MIN(CAST(vi.harga_item AS DECIMAL)) AS harga_min, MAX(CAST(vi.harga_item AS DECIMAL)) AS harga_max, pb.id_promo_produk')
            ->join('jsf_promo', 'jsf_promo_produk.id_promo = jsf_promo.id_promo')
            ->join('jsf_produk', 'jsf_promo_produk.id_produk = jsf_produk.id_produk')
            ->join('jsf_variasi_item vi', 'jsf_produk.id_produk = vi.id_produk', 'left')
            ->join('jsf_promo_produk_bundle pb', 'jsf_promo_produk.id = pb.id_promo_produk')
            ->where('jsf_produk.deleted_at', null)
            ->where(['jsf_promo.slug' => $slug])
            ->orderBy('jsf_promo_produk.created_at', 'DESC')
            ->get();

        $result = $query->getResultArray();
        // dd($result);
        return $result;
    }

    public function getDetailProduct($id)
    {
        $query = $this->table('jsf_promo_produk')
            ->select('jsf_promo_produk.*, jsf_promo.*, vi.*, jsf_produk.*, jsf_promo.title as title, MIN(CAST(vi.harga_item AS DECIMAL)) AS harga_min, MAX(CAST(vi.harga_item AS DECIMAL)) AS harga_max, pb.id_promo_produk')
            ->join('jsf_promo', 'jsf_promo_produk.id_promo = jsf_promo.id_promo')
            ->join('jsf_produk', 'jsf_promo_produk.id_produk = jsf_produk.id_produk')
            ->join('jsf_variasi_item vi', 'jsf_produk.id_produk = vi.id_produk', 'left')
            ->join('jsf_promo_produk_bundle pb', 'jsf_promo_produk.id = pb.id_promo_produk')
            ->where('jsf_produk.deleted_at', null)
            ->where('jsf_promo_produk.id', $id)
            ->orderBy('jsf_promo_produk.created_at', 'DESC')
            ->first();

        // $result = $query->getResultArray();

        // dd($result);
        return $query;
    }

    public function promoProduk($id)
    {
        $currentDate = date('Y-m-d H:i:s'); // Waktu saat ini

        $query = $this->table('jsf_promo_produk')
            ->select('jsf_promo_produk.*, jsf_promo.title as promo_title, jsf_produk.*')
            ->join('jsf_promo', 'jsf_promo_produk.id_promo = jsf_promo.id_promo')
            ->join('jsf_produk', 'jsf_promo_produk.id_produk = jsf_produk.id_produk')
            ->orderBy('jsf_promo_produk.id_produk', 'ASC')
            ->where('jsf_promo_produk.id_promo', $id)
            ->where('jsf_promo.start_at <=', $currentDate)
            ->where('jsf_promo.end_at >=', $currentDate)
            ->get();

        return $query->getResultArray();
    }

    public function getPromoDetailsByIdProduk($id)
    {
        $query = $this->select('*')
            ->where('id_produk', $id)->findAll();

        return $query;
    }
}
