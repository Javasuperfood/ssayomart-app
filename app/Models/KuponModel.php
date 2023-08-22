<?php

namespace App\Models;

use CodeIgniter\Model;

class KuponModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_kupon';
    protected $primaryKey       = 'id_kupon';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_kupon',
        'code_kupon',
        'deskripsi_kupon',
        'masa_berlaku',
        // 'created_by'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nama_kupon' => 'required',
        'code_kupon' => 'required',
        'deskripsi_kupon' => 'required',
        'masa_berlaku' => 'required',
        // 'created_by' => 'required',
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
}
