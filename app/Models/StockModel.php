<?php

namespace App\Models;

use CodeIgniter\Model;

class StockModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_stock';
    protected $primaryKey       = 'id_stock';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_produk',
        'id_variasi_item',
        'id_toko',
        'stok',
        'update_by'
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

    public function getStock($id_produk, $id_toko)
    {
        $query = $this->select('*')
            ->join('jsf_variasi_item', 'jsf_variasi_item.id_variasi_item = jsf_stock.id_variasi_item')
            ->where('jsf_stock.id_produk', $id_produk)
            ->where('jsf_stock.id_toko', $id_toko)->findAll();

        return $query;
    }

    public function getStockOnly($id_produk, $id_toko)
    {
        $query = $this->select('*')
            ->where('jsf_stock.id_produk', $id_produk)
            ->where('jsf_stock.id_toko', $id_toko)->findAll();

        return $query;
    }

    public function getStockWithProduct($perPage = null)
    {
        $query = $this->select('jsf_toko.lable, jsf_produk.nama, jsf_variasi_item.value_item, jsf_stock.created_at, jsf_stock.id_toko, jsf_stock.stok')
            ->join('jsf_toko', 'jsf_toko.id_toko = jsf_stock.id_toko')
            ->join('jsf_variasi_item', 'jsf_variasi_item.id_variasi_item = jsf_stock.id_variasi_item')
            ->join('jsf_produk', 'jsf_produk.id_produk = jsf_variasi_item.id_produk');
        $data = $query->paginate($perPage, 'stock');

        return $data;
    }
}
