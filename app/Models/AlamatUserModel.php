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
        'penerima',
        'alamat_1',
        'alamat_2',
        'id_province',
        'province',
        'id_city',
        'city',
        'zip_code',
        'telp',
        'telp2',
        'alamat_3',
        'latitude',
        'longitude',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'id_user' => 'required',
        'label' => 'required',
        'penerima' => 'required',
        'alamat_1' => 'required',
        'id_province' => 'required',
        'province' => 'required',
        'id_city' => 'required',
        'city' => 'required',
        'zip_code' => 'required',
        'telp' => 'required',
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

    public function getAlamatUser()
    {
        return $this->findAll();
    }
}
