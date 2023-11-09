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
        'id_toko',
        'id_kupon',
        'id_status_pesan',
        'id_status_kirim',
        'kirim',
        'kurir',
        'service',
        'harga_service',
        'resi',
        'catatan',
        'kupon',
        'discount',
        'total_1',
        'total_2',
        'invoice',
        'zip_code',
        'telp',
        'snap_token',
        'city'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'id_user'               => 'required',
        'id_toko'               => 'required',
        // 'id_kupon'              => 'required',
        // 'id_alamat_users'       => 'required',
        'id_status_pesan'       => 'required',
        'id_status_kirim'       => 'required',
        // 'id_payment'            => 'required',
        // 'total'                 => 'required',
        // 'kirim' => 'required',
        // 'kurir' => 'required',
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
            ->join('users', 'users.id_alamat_users = jsf_checkout.id_alamat_users')
            ->where('jsf_checkout.id_user', $id_user)
            ->get()->getResultArray();
    }

    public function getCheckoutWithProduk()
    {
        $builder = $this->db->table('jsf_stock');
        $builder->join('jsf_toko', 'jsf_toko.id_toko = jsf_stock.id_toko');
        $builder->join('jsf_variasi_item', 'jsf_variasi_item.id_variasi_item = jsf_stock.id_variasi_item');
        $builder->join('jsf_produk', 'jsf_produk.id_produk = jsf_variasi_item.id_produk');
        $builder->select('jsf_toko.lable, jsf_produk.nama, jsf_variasi_item.value_item, jsf_stock.created_at, jsf_stock.id_toko, jsf_stock.stok');
        $query = $builder->get();

        return $query->getResult();
    }
}
