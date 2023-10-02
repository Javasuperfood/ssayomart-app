<?php

namespace App\Models;

use CodeIgniter\Model;

class PromoItemModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_promo_item';
    protected $primaryKey       = 'id_promo_item';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
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
        $query = $db->table('jsf_promo_item')
            ->select('jsf_promo_item.*, jsf_promo.*, jsf_produk.*, jsf_promo.title as title, MIN(vi.harga_item) AS harga_min, MAX(vi.harga_item) AS harga_max')
            ->join('jsf_promo', 'jsf_promo_item.id_promo = jsf_promo.id_promo')
            ->join('jsf_produk', 'jsf_promo_item.id_produk = jsf_produk.id_produk')
            ->join('jsf_variasi_item vi', 'jsf_produk.id_produk = vi.id_produk', 'left')
            ->groupBy('jsf_promo_item.id_promo_item')
            ->where(['jsf_promo.slug' => $slug])
            ->orderBy('jsf_promo_item.created_at', 'DESC')
            ->get();

        $result = $query->getResultArray();
        return $result;
    }
}
