<?php

namespace App\Models;

use CodeIgniter\Commands\Utilities\Publish;
use CodeIgniter\Model;

class AdminTokoModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_admin_toko';
    protected $primaryKey       = 'id_admin_toko';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_user', 'id_toko', 'created_by', 'updated_by'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'id_user' => [
            'rule' => 'required',
            'errors' => [
                'required' => 'Admin harus dipilih',
            ]
        ],
        'id_toko' => [
            'rule' => 'required',
            'errors' => [
                'required' => 'Market harus dipilih',
            ]
        ]
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

    public function getAdminToko($user_id = null)
    {
        $query = $this->select('jsf_admin_toko.*, jsf_toko.zip_code, jsf_toko.city')
            ->join('jsf_toko', 'jsf_toko.id_toko = jsf_admin_toko.id_toko');

        if ($user_id != null) {
            $query->where('jsf_admin_toko.id_user', $user_id);
        }
        return $query->get()->getResultArray();
    }
}
