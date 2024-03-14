<?php

namespace App\Models;

use CodeIgniter\Model;

class PromoProdukBundle extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_promo_produk_bundle';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_promo_produk',
        'id_main_produk',
        'id_produk_bundle'
    ];

    // Dates
    protected $useTimestamps = false;
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

    // public function getBundlingProduct()
    // {
    //     $query = $this->table('jsf_promo_produk_bundle')
    //         ->select('jsf_promo_produk_bundle.*, jsf_produk.*')
    //         ->join('jsf_produk', 'jsf_promo_produk_bundle.id_produk = jsf_produk.id_produk')
    //         ->join('jsf_promo_produk', 'jsf_promo_produk_bundle.id_promo_produk = jsf_promo_produk.id')
    //         ->orderBy('jsf_promo_produk_bundle.id_produk', 'ASC')
    //         ->get();
    //     // dd($query);

    //     return $query->getResultArray();
    // }

    public function getOngoingPromoItems()
    {
        $query = $this->table('jsf_promo_produk_bundle')
            ->select('jsf_promo_produk_bundle.*, jsf_produk.*')
            ->join('jsf_produk', 'jsf_promo_produk_bundle.id_main_produk = jsf_produk.id_produk')
            ->join('jsf_promo_produk', 'jsf_promo_produk_bundle.id_promo_produk = jsf_promo_produk.id')
            ->get();
        // dd($query);

        return $query->getResultArray();
    }
}
