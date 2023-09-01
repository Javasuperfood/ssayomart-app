<?php

namespace App\Models;

use CodeIgniter\Model;

class CheckoutModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_checkout';
    protected $primaryKey       = 'id_checkout';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_user',
        'id_kupon',
        'id_alamat_users',
        // 'id_payment',
        'id_status_pesan',
        'id_status_kirim',
        'total',
        'invoice'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'id_user'               => 'required',
        'id_kupon'              => 'required',
        'id_alamat_users'       => 'required',
        'id_status_pesan'       => 'required',
        'id_status_kirim'       => 'required',
        // 'id_payment'            => 'required',
        'total'                 => 'required',
        'invoice'               => 'required'
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

    public function getCheckout($id_user)
    {
        return $this->db->table('jsf_checkout')
            ->join('jsf_alamat_users', 'jsf_alamat_users.id_alamat_users = jsf_checkout.id_alamat_users')
            ->where('jsf_checkout.id_user', $id_user)
            ->get()->getResultArray();
    }
}
