<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_kategori';
    protected $primaryKey       = 'id_kategori';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
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
        'nama_kategori' => 'required',
        'deskripsi' => 'required',
        'slug' => 'required',
        'img' => 'required'
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

    public function getKategori($slug = false)
    {
        if ($slug == false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
    public function getGambarKategori($slug)
    {
        return $this->where(['slug' => $slug])->select('img')->first();
    }

    public function delKategori($id)
    {
        $subKategoriModel = new SubKategoriModel();
        $produkModel = new ProdukModel();
        $builder = $produkModel->builder();
        $builder->where('id_kategori', $id);
        $builder->update(['id_kategori' => null]);
        $builder = $subKategoriModel->builder();
        $builder->where('id_kategori', $id);
        $builder->update(['id_kategori' => null]);
        return $this->delete($id);
    }
}
