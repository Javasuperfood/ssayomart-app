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
        'id_destination',
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

    public function getCheckoutWithProduct()
    {
        $builder = $this->db->table('jsf_checkout');
        $builder->select('users.fullname, jsf_produk.nama, jsf_checkout.created_at, jsf_checkout.total_2, jsf_checkout_produk.qty');
        $builder->join('users', 'users.id = jsf_checkout.id_user');
        $builder->join('jsf_checkout_produk', 'jsf_checkout_produk.id_checkout = jsf_checkout.id_checkout');
        $builder->join('jsf_produk', 'jsf_produk.id_produk = jsf_checkout_produk.id_produk');
        $query = $builder->get();

        return $query->getResult();
    }

    public function getOrderByInvoice($invoice)
    {
        return $this->db->table('jsf_checkout')
            ->where('invoice', $invoice)
            ->get()
            ->getRowArray();
    }

    public function getProdukDetailByIdCheckout($id_checkout)
    {
        $query = $this->select('jsf_checkout_produk.id_produk, jsf_produk.nama, jsf_checkout_produk.id_variasi_item, jsf_checkout_produk.qty, jsf_checkout_produk.harga')
            ->join('jsf_produk', 'jsf_checkout_produk.id_produk = jsf_produk.id_produk')
            ->where('jsf_checkout_produk.id_checkout', $id_checkout);

        return $query->findAll();
    }
}
