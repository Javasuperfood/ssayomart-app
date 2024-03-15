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
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'id_promo' => 'required',
        'id_produk' => 'required',
    ];
    protected $validationMessages   = [
        'id_promo' => [
            'required' => 'Promo wajib diisi.',
        ],
        'id_produk' => [
            'required' => 'Produk wajib diisi.',
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
}
