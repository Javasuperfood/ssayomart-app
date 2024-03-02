<?php

namespace App\Models;

use CodeIgniter\Model;

class CartProdukModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_cart_produk';
    protected $primaryKey       = 'id_cart_produk';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_cart',
        'id_produk',
        'id_variasi_item',
        'qty'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'id_cart'               => 'required',
        'id_produk'               => 'required',
        'id_variasi_item'               => 'required',
        'qty'               => 'required',
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


    public function getCartProduk($id_cart)
    {
        $query = $this->select('jsf_cart_produk.*, jsf_produk.nama, jsf_produk.nama_en, jsf_produk.nama_kr, jsf_produk.img, jsf_produk.slug, jsf_produk.deskripsi, jsf_produk.is_active, jsf_variasi_item.*')
            ->join('jsf_produk', 'jsf_produk.id_produk = jsf_cart_produk.id_produk', 'inner')
            ->join('jsf_variasi_item', 'jsf_variasi_item.id_variasi_item = jsf_cart_produk.id_variasi_item', 'inner')
            ->where('id_cart', $id_cart);

        $result = $query->findAll();

        return $result;
    }
}
