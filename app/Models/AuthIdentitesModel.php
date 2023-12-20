<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthIdentitesModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'auth_identities';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'type',
        'name',
        'secret',
        'secret2',
        'expires',
        'extra',
        'force_reset',
        'last_used_at'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'user_id'   => 'required',
        'type'   => 'required',
        'name'   => 'required',
        'secret'   => 'required',
        'secret2'   => 'required',
        'expires'   => 'required',
        'extra'   => 'required',
        'force_reset'   => 'required',
        'last_used_at'   => 'required'
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

    public function findUserByEmail($email)
    {
        return $this->where('secret', $email)->first();
    }
}
