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
        'id_variasi',
        'id_produk',
        'value_item',
        'harga_item',
        'berat'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'value_item' => [
            'rules'  => 'required',
            'errors' => [
                'required' => 'Tampilan Varian wajib diisi.',
            ],
        ],
        'harga_item' => [
            'rules'  => 'required|numeric',
            'errors' => [
                'required' => 'Harga wajib diisi.',
                'numeric' => 'Harga wajib diisi dengan nomor.',
            ],
        ],
        'berat' => [
            'rules'  => 'required|numeric',
            'errors' => [
                'required' => 'Gramasi wajib diisi.',
                'numeric' => 'Gramasi wajib diisi dengan nomor.',
            ],
        ],
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
        $builder->where('jsf_variasi_item.id_produk', $id);
        // $builder->where('id_produk', $id);
        $query = $builder->get();

        $results = $query->getResultArray();
        // dd($results);
        return $results;
    }
    public function getHargaByProdukId($id_produk)
    {
        // Misalkan Anda ingin mengambil harga dari variasi item yang terkait dengan produk tertentu
        $query = $this->select('harga_item')
            ->where('id_produk', $id_produk)
            ->first(); // Kita hanya perlu satu hasil, karena satu produk mungkin memiliki satu harga utama

        if ($query) {
            return $query['harga_item']; // Mengembalikan harga jika ditemukan
        } else {
            return 0; // Mengembalikan 0 jika tidak ada harga yang ditemukan
        }
    }
}
