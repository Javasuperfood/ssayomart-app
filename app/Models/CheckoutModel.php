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
        'status_transaction',
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
        'city',
        'gosend',
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

    public function getCheckoutWithProduct($perPage = null)
    {
        $query = $this->select('jsf_checkout.id_checkout, jsf_checkout_produk.id_checkout_produk, jsf_checkout.invoice, jsf_checkout.total_1, jsf_checkout.total_2, jsf_checkout.created_at, jsf_checkout_produk.qty, jsf_toko.lable, users.fullname')
            ->join('jsf_toko', 'jsf_toko.id_toko = jsf_checkout.id_toko')
            ->join('jsf_checkout_produk', 'jsf_checkout_produk.id_checkout = jsf_checkout.id_checkout')
            ->join('users', 'users.id = jsf_checkout.id_user')
            ->groupBy('jsf_checkout_produk.id_checkout,')
            ->orderBy('created_at', 'DESC')
            ->where('jsf_checkout.id_toko', 1);
        $data = $query->paginate($perPage, 'checkout');
        // dd($data);
        return $data;
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

    public function getOrder($perPage = null, $toko = null, $status = null, $shipment = null, $refund = null)
    {
        $query = $this->select('jsf_checkout.id_checkout, jsf_checkout.invoice,jsf_checkout.kirim,jsf_checkout.kurir,jsf_checkout.service, jsf_checkout.id_status_pesan,jsf_checkout.gosend, jsf_checkout.id_status_pesan as status_pesan_id, jsf_status_pesan.status as status')
            ->join('jsf_status_pesan', 'jsf_status_pesan.id_status_pesan = jsf_checkout.id_status_pesan')
            ->join('jsf_refunds', 'jsf_refunds.order_id = jsf_checkout.invoice', 'left');
        $query->where('id_toko', $toko)
            ->orderBy('jsf_checkout.id_checkout', 'DESC');
        if ($status != null) {
            $query->where('jsf_checkout.id_status_pesan', $status);
        }
        if ($shipment == 1) {
            $query->where('jsf_checkout.gosend', $shipment);
        }
        if ($shipment == 0) {
            $query->where('jsf_checkout.gosend', null);
        }

        if ($refund != null) {
            $query->where('id_refund !=', null);
        } else {
            $query->where('id_refund', null);
        }
        $result = $query->paginate($perPage, 'order');
        // dd($result);
        return $result;
    }

    // public function getOrderByUserIdFromPayload($userId)
    // {
    //     return $this->db->table('jsf_checkout')
    //         ->select('jsf_checkout.*, users.uuid as user_uuid')
    //         ->join('users', 'users.id = jsf_checkout.id_user') // Sesuaikan dengan kolom yang sesuai di tabel users
    //         ->where('jsf_checkout.id_user', $userId) // Sesuaikan dengan kolom yang sesuai di tabel jsf_checkout
    //         ->get()
    //         ->getRowArray();
    // }
}
