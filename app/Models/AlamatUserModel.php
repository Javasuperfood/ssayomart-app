<?php

namespace App\Models;

use CodeIgniter\Model;

class AlamatUserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_alamat_users';
    protected $primaryKey       = 'id_alamat_users';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_user',
        'label',
        'alamat_1',
        'alamat_2',
        'id_province',
        'province',
        'id_city',
        'city',
        'zip_code',
        'telp',
        'telp2'
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

    public function getAlamatUser()
    {
        return $this->findAll();
    }
    public function updateAlamatUser()
    {
    }
}
