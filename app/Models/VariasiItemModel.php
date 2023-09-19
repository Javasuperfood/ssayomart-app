<?php

namespace App\Models;

use CodeIgniter\Model;

class VariasiItemModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_variasi_item';
    protected $primaryKey       = 'id_variasi_item';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_variasi', 'id_produk', 'value_item', 'harga_item', 'berat'
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

    public function getVariasiItem()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('jsf_variasi_item');
        $builder->join('jsf_variasi', 'jsf_variasi_item.id_variasi = jsf_variasi.id_variasi', 'inner');
        $query = $builder->get();

        $results = $query->getResultArray();

        return $results;
    }
    public function getByIdProduk($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('jsf_variasi_item');
        $builder->join('jsf_variasi', 'jsf_variasi_item.id_variasi = jsf_variasi.id_variasi', 'inner');
        $builder->where('id_produk', $id);
        $query = $builder->get();

        $results = $query->getResultArray();

        return $results;
    }
}
