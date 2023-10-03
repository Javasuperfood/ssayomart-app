<?php

namespace App\Models;

use CodeIgniter\Model;

class PromoModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_promo';
    protected $primaryKey       = 'id_promo';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title',
        'slug',
        'img',
        'start_at',
        'end_at',
        'deskripsi'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'title'      => 'required',
        'slug'       => 'required',
        'img'        => 'required',
        'start_at'   => 'required',
        'end_at'     => 'required',
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

    public function getPromo($now)
    {
        return $this->where("'$now' >= start_at AND '$now' <= end_at")
            ->findAll();
    }
}
