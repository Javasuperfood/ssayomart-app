<?php

namespace App\Models;

use CodeIgniter\Model;

class SubKategoriModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_sub_kategori';
    protected $primaryKey       = 'id_sub_kategori';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_kategori',
        'nama_kategori',
        'deskripsi',
        'slug',
        'img'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'id_kategori' => 'required',
        'nama_kategori' => 'required',
        'deskripsi' => 'required',
        'slug' => 'required',
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
    public function getSubKategori($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }

    public function joinTable()
    {
        $db = \Config\Database::connect();
        $query = $db->table('jsf_sub_kategori')
            ->select('jsf_kategori.*, jsf_sub_kategori.*,  jsf_kategori.nama_kategori AS nama_kategori, jsf_sub_kategori.nama_kategori AS nama_sub_kategori')
            ->join('jsf_kategori', 'jsf_sub_kategori.id_kategori = jsf_kategori.id_kategori')
            ->get();

        $result = $query->getResult();
        return $result;
    }
}
