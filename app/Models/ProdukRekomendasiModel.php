<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukRekomendasiModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_produk_rekomendasi';
    protected $primaryKey       = 'id_rekomendasi';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_produk',
        'short',
        'created_at',
        'updated_at'
    ];

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

    public function getLatestProducts($limit = 6)
    {
        return $this->select('*')
            ->orderBy('created_at', 'DESC')
            ->limit($limit)
            ->findAll();
    }
}
