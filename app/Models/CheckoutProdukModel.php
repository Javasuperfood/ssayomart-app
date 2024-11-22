<?php

namespace App\Models;

use CodeIgniter\Model;
use PhpParser\Node\Identifier;

class CheckoutProdukModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'jsf_checkout_produk';
    protected $primaryKey = 'id_checkout_produk';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'id_checkout',
        'id_produk',
        'id_variasi_item',
        'qty',
        'harga'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function getHistoryTransaksi($id, $keyword = null, $status = null)
    {
        $db = \Config\Database::connect();
        $query = $db->table('jsf_checkout_produk')
            ->select('*, jsf_checkout.updated_at AS last_update')
            ->join('jsf_checkout', 'jsf_checkout_produk.id_checkout = jsf_checkout.id_checkout')
            ->join('jsf_produk', 'jsf_checkout_produk.id_produk = jsf_produk.id_produk')
            ->where('jsf_checkout.id_user', $id)
            ->orderBy('jsf_checkout_produk.created_at', 'DESC');

        if ($keyword != null) {
            $query->like('jsf_produk.nama', '%' . $keyword . '%');
            $query->orLike('jsf_produk.sku', '%' . $keyword . '%');
        }
        if ($status == 'waiting-payment') {
            $query->where('jsf_checkout.id_status_pesan', '1');
        }
        if ($status == 'on-process') {
            $query->where('jsf_checkout.id_status_pesan', '2');
        }
        if ($status == 'delivered') {
            $query->where('jsf_checkout.id_status_pesan', '3');
        }
        if ($status == 'complited') {
            $query->where('jsf_checkout.id_status_pesan', '4');
        }
        if ($status == 'failed') {
            $query->where('jsf_checkout.id_status_pesan', '5');
        }
        if ($status == 'canceled') {
            $query->where('jsf_checkout.id_status_pesan', '6');
        }
        $result = $query->get()->getResult();
        return $result;
    }

    // public function getHistoryTransaction($keyword, $page = 1)
    // {
    //     $db = \Config\Database::connect();
    //     $query = $db->table('jsf_checkout_produk')
    //         ->select('*, jsf_checkout.updated_at AS last_update')
    //         ->join('jsf_checkout', 'jsf_checkout_produk.id_checkout = jsf_checkout.id_checkout')
    //         ->join('jsf_produk', 'jsf_checkout_produk.id_produk = jsf_produk.id_produk')
    //         ->where('jsf_checkout.id_user', user_id())
    //         ->groupStart()
    //         ->like('jsf_produk.nama', $keyword) // Search by product name
    //         ->orLike('jsf_produk.sku', $keyword) // Search by SKU
    //         ->groupEnd()
    //         ->orderBy('jsf_checkout_produk.created_at', 'DESC')
    //         ->get();

    //     $result = $query->getResult();
    //     return $result;
    // }

    public function getAllTransaksi($toko = null, $perPage, $currentPage)
    {
        $db = \Config\Database::connect();
        $query = $db->table('jsf_checkout_produk')
            ->select('jsf_checkout_produk.*, jsf_checkout.*, jsf_checkout.id_status_pesan AS pesan_status, jsf_checkout.id_status_kirim AS kirim_status, jsf_produk.*, jsf_status_pesan.status AS pesan_status_text, jsf_status_kirim.status AS kirim_status_text')
            ->join('jsf_checkout', 'jsf_checkout_produk.id_checkout = jsf_checkout.id_checkout')
            ->join('jsf_produk', 'jsf_checkout_produk.id_produk = jsf_produk.id_produk')
            ->join('jsf_status_pesan', 'jsf_checkout.id_status_pesan = jsf_status_pesan.id_status_pesan')
            ->join('jsf_status_kirim', 'jsf_checkout.id_status_kirim = jsf_status_kirim.id_status_kirim')
            ->orderBy('jsf_checkout_produk.created_at', 'DESC');
        if ($toko != null) {
            foreach ($toko as $key => $t) {
                if ($key == 0) {
                    $query->Like('id_toko', $t['id_toko']);
                } else {
                    $query->orLike('id_toko', $t['id_toko']);
                }
            }
        }

        $result = $query->get()->getResultArray();
        // dd($result);
        // Apply pagination manually
        $start = ($currentPage - 1) * $perPage;
        $paginatedResults = array_slice($result, $start, $perPage);

        return $paginatedResults;
    }
    public function getAllTransaksiWithStatus($toko = null, $perPage, $currentPage, $status = null)
    {
        $db = \Config\Database::connect();

        $query = $db->table('jsf_checkout_produk')
            ->select('jsf_checkout_produk.*, jsf_checkout.*, jsf_checkout.id_status_pesan AS pesan_status, jsf_checkout.id_status_kirim AS kirim_status, jsf_produk.*, jsf_status_pesan.status AS pesan_status_text, jsf_status_kirim.status AS kirim_status_text')
            ->join('jsf_checkout', 'jsf_checkout_produk.id_checkout = jsf_checkout.id_checkout')
            ->join('jsf_produk', 'jsf_checkout_produk.id_produk = jsf_produk.id_produk')
            ->join('jsf_status_pesan', 'jsf_checkout.id_status_pesan = jsf_status_pesan.id_status_pesan')
            ->join('jsf_status_kirim', 'jsf_checkout.id_status_kirim = jsf_status_kirim.id_status_kirim')
            ->orderBy('jsf_checkout_produk.created_at', 'DESC');

        if ($status != null) {
            $query->where('jsf_checkout.id_status_pesan', $status);
        }
        if ($toko != null) {
            foreach ($toko as $key => $t) {
                if ($key == 0) {
                    $query->Like('id_toko', $t['id_toko']);
                } else {
                    $query->orLike('id_toko', $t['id_toko']);
                }
            }
        }

        $result = $query->get()->getResultArray();

        // Apply pagination manually
        $start = ($currentPage - 1) * $perPage;
        $paginatedResults = array_slice($result, $start, $perPage);

        return $paginatedResults;
    }
    public function getAllPrint($toko = null)
    {
        $db = \Config\Database::connect();

        $query = $db->table('jsf_checkout_produk')
            ->select('*')
            ->join('jsf_checkout', 'jsf_checkout_produk.id_checkout = jsf_checkout.id_checkout')
            ->join('jsf_produk', 'jsf_checkout_produk.id_produk = jsf_produk.id_produk')
            ->join('jsf_variasi_item', 'jsf_variasi_item.id_variasi_item = jsf_checkout_produk.id_variasi_item', 'inner')
            ->where('jsf_checkout.id_status_pesan', '2')
            ->orderBy('jsf_checkout_produk.created_at', 'DESC');
        if ($toko != null) {
            foreach ($toko as $key => $t) {
                if ($key == 0) {
                    $query->Like('id_toko', $t['id_toko']);
                } else {
                    $query->orLike('id_toko', $t['id_toko']);
                }
            }
        };

        $result = $query->get()->getResultArray();

        return $result;
    }

    public function getTransaksi($inv)
    {
        $db = \Config\Database::connect();
        $query = $db->table('jsf_checkout_produk')
            ->select('jsf_checkout_produk.*, jsf_checkout.*, jsf_checkout.id_status_pesan AS pesan_status, jsf_checkout.id_status_kirim AS kirim_status, jsf_produk.*, jsf_status_pesan.status AS pesan_status_text, jsf_status_kirim.status AS kirim_status_text')
            ->join('jsf_checkout', 'jsf_checkout_produk.id_checkout = jsf_checkout.id_checkout')
            ->join('jsf_produk', 'jsf_checkout_produk.id_produk = jsf_produk.id_produk')
            ->join('jsf_status_pesan', 'jsf_checkout.id_status_pesan = jsf_status_pesan.id_status_pesan')
            ->join('jsf_status_kirim', 'jsf_checkout.id_status_kirim = jsf_status_kirim.id_status_kirim')
            ->where('invoice', $inv)
            ->get();

        $result = $query->getResultArray();
        return $result;
    }
    public function getProdukByIdCheckout($id)
    {
        $db = \Config\Database::connect();
        $query = $db->table('jsf_checkout_produk')
            ->select('*')
            ->join('jsf_produk', 'jsf_produk.id_produk = jsf_checkout_produk.id_produk', 'inner')
            ->join('jsf_variasi_item', 'jsf_variasi_item.id_variasi_item = jsf_checkout_produk.id_variasi_item', 'inner')
            ->where('id_checkout', $id)
            ->get();

        $result = $query->getResultArray();
        return $result;
    }

    public function getAllProdukByIdCheckout($id_checkout)
    {
        $query = $this->select('*')
            ->join('jsf_produk', 'jsf_checkout_produk.id_produk = jsf_produk.id_produk')
            ->join('jsf_variasi_item', 'jsf_variasi_item.id_variasi_item = jsf_checkout_produk.id_variasi_item')
            ->where('jsf_checkout_produk.id_checkout', $id_checkout);


        return $query->findAll();
    }

    public function getProdukDetailByIdCheckout($id_checkout)
    {
        $query = $this->select('jsf_checkout_produk.id_produk, jsf_checkout_produk.id_variasi_item, jsf_checkout_produk.qty, jsf_checkout_produk.harga, jsf_produk.nama')
            ->join('jsf_produk', 'jsf_checkout_produk.id_produk = jsf_produk.id_produk')
            ->where('jsf_checkout_produk.id_checkout', $id_checkout);

        return $query->findAll();
    }
}
