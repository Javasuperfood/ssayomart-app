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
        'nama',
        'kode',
        'deskripsi',
        'discount',
        'total_buy',
        'is_active',
        'available_kupon',
        'created_by'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nama' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama kupon harus diisi',
            ]
        ],
        'kode' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kode kupon harus diisi',
            ]
        ],
        'deskripsi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Deskripsi kupon harus diisi',
            ]
        ],
        'discount' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Diskon kupon harus dipilih',
            ]
        ],
        'total_buy' => [
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Total Berbelanja kupon harus diisi',
                'numeric' => 'Total Berbelanja kupon harus berupa angka',
            ]
        ],
        'is_active' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Aktif kupon harus diisi',
            ]
        ],
        'created_by' => 'required'
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

    public function getKupon($kode)
    {
        if ($kode != '') {
            return $this->where(['kode' => $kode])->first();
        }
    }

    public function getAllKupon()
    {
        $db = \Config\Database::connect();
        $query = $db->table('jsf_kupon')
            ->select(
                'jsf_kupon.*, users.*'
            )
            ->join('users', 'users.id = jsf_kupon.created_by')
            ->get();

        $result = $query->getResultArray();
        return $result;
    }
}
