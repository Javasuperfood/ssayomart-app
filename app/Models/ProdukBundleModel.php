<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukBundleModel extends Model
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

    public function getProdukBundle()
    {
        $query = $this->db->table('jsf_promo_produk_bundle')
            ->select('jsf_promo_produk_bundle.*, main_produk.*, bundle_produk.nama as nama_produk')
            ->join('jsf_produk as main_produk', 'jsf_promo_produk_bundle.id_main_produk = main_produk.id_produk')
            ->join('jsf_produk as bundle_produk', 'jsf_promo_produk_bundle.id_produk_bundle = bundle_produk.id_produk')
            ->join('jsf_promo_produk', 'jsf_promo_produk_bundle.id_promo_produk = jsf_promo_produk.id')
            ->get();

        return $query->getResultArray();
    }
}
