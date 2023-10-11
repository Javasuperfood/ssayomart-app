<?php

namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_blog';
    protected $primaryKey       = 'id_blog';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'judul_blog',
        'tanggal_dibuat',
        'isi_blog',
        'img_thumbnail',
        'created_by',
        'slug',
        'created_at',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'judul_blog'        => 'required',
        'tanggal_dibuat'    => 'required',
        'img_thumbnail'     => 'required',
        'created_by'        => 'required',
        'slug'              => 'required'
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

    public function getAllBlog()
    {
        $db = \Config\Database::connect();
        $query = $db->table('jsf_blog')
            ->select(
                'jsf_blog.*, users.*'
            )
            ->join('users', 'users.id = jsf_blog.created_by')
            ->get();

        $result = $query->getResultArray();
        return $result;
    }
}
