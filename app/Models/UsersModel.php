<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'username',
        'status',
        'status_message',
        'active',
        'last_active',
        'img',
        'fullname',
        'telp'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'username'  => 'required',
        'fullname'  => 'required',
        'telp'      => 'required',
        'img'       => 'required'
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

    public function getStatus($slug)
    {
        $db = \Config\Database::connect();
        $query = $db->table('jsf_checkout_produk')
            ->select('jsf_checkout_produk.*, jsf_checkout.*, jsf_checkout.id_status_pesan AS pesan_status, jsf_checkout.id_status_kirim AS kirim_status, jsf_produk.*, jsf_status_pesan.status AS pesan_status_text, jsf_status_kirim.status AS kirim_status_text')
            ->join('jsf_checkout', 'jsf_checkout_produk.id_checkout = jsf_checkout.id_checkout')
            ->join('jsf_produk', 'jsf_checkout_produk.id_produk = jsf_produk.id_produk')
            ->join('jsf_status_pesan', 'jsf_checkout.id_status_pesan = jsf_status_pesan.id_status_pesan')
            ->join('jsf_status_kirim', 'jsf_checkout.id_status_kirim = jsf_status_kirim.id_status_kirim')
            ->where('invoice', $slug)
            ->get();

        $result = $query->getResult()[0];
        return $result;
    }
    public function getTransaksi($slug)
    {
        $db = \Config\Database::connect();
        $query = $db->table('jsf_checkout_produk')
            ->select('jsf_checkout_produk.*, jsf_checkout.*, jsf_produk.*')
            ->join('jsf_checkout', 'jsf_checkout_produk.id_checkout = jsf_checkout.id_checkout')
            ->join('jsf_produk', 'jsf_checkout_produk.id_produk = jsf_produk.id_produk')
            ->where('invoice', $slug)
            ->get();

        $result = $query->getResult();
        return $result;
    }

    public function getEmail($id)
    {
        $db = \Config\Database::connect();
        $query = $db->table('auth_identities')
            ->select('secret')
            ->where('user_id', $id)
            ->get();

        $result = $query->getResultArray()[0]['secret'];
        return $result;
    }
}
