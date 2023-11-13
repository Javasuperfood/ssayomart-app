<?php

namespace App\Models;

use CodeIgniter\Model;

class DeleteRequestUsersModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_request_delete';
    protected $primaryKey       = 'id_request_delete';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_user',
        'alasan',
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

    public function getAllRequests()
    {
        // Fetch all records from the table
        return $this->findAll();
    }
    public function getByIdUser($id)
    {
        // Fetch all records from the table based on user ID
        return $this->where('id_user', $id)->findAll();
    }

    public function getUserInfo($id)
    {
        $db = \Config\Database::connect();
        $query = $db->table('jsf_request_delete')
            ->select('users.username, users.fullname, users.telp, users.img, auth_identities.secret AS email') // Include email from auth_identities
            ->join('auth_identities', 'auth_identities.user_id = users.id', 'inner')
            ->where('users.id', $id)
            ->get();

        $result = $query->getRowArray();
        return $result;
    }
}
