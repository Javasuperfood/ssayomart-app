<?php

namespace App\Models;

use CodeIgniter\Model;

class PromoBatchModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_promo_batch';
    protected $primaryKey       = 'id_promo_batch';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_promo',
        'id_produk',
        'discount',
        'min',
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
        'discount' => 'required',
        'min' => 'required'
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

    public function getPromo($slug)
    {
        $db = \Config\Database::connect();
        $query = $db->table('jsf_promo_batch')
            ->select('jsf_promo_batch.*, jsf_promo.*, jsf_produk.*, jsf_promo.title as title, MIN(CAST(vi.harga_item AS DECIMAL)) AS harga_min, MAX(CAST(vi.harga_item AS DECIMAL)) AS harga_max')
            ->join('jsf_promo', 'jsf_promo_batch.id_promo = jsf_promo.id_promo')
            ->join('jsf_produk', 'jsf_promo_batch.id_produk = jsf_produk.id_produk')
            ->join('jsf_variasi_item vi', 'jsf_produk.id_produk = vi.id_produk', 'left')
            ->groupBy('jsf_promo_batch.id_promo_item_batch')
            ->where('jsf_produk.deleted_at', null)
            ->where(['jsf_promo.slug' => $slug])
            ->orderBy('jsf_promo_batch.created_at', 'DESC')
            ->get();

        $result = $query->getResultArray();
        return $result;
    }

    public function getOngoingPromoItems()
    {
        $currentDate = date('Y-m-d H:i:s'); // Waktu saat ini

        $query = $this->table('jsf_promo_batch')
            ->select('jsf_promo_batch.*, jsf_promo.title as promo_title, jsf_produk.nama as produk_nama')
            ->join('jsf_promo', 'jsf_promo_batch.id_promo = jsf_promo.id_promo')
            ->join('jsf_produk', 'jsf_promo_batch.id_produk = jsf_produk.id_produk')
            ->where('jsf_promo.start_at <=', $currentDate)
            ->where('jsf_promo.end_at >=', $currentDate)
            ->get();

        return $query->getResultArray();
    }
}
