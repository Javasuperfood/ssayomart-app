<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_banner';
    protected $primaryKey       = 'id_banner';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title',
        'img',
        'img_konten',
        'deskripsi'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'title' => [
            'rules' => 'required|min_length[2]|max_length[50]',
            'errors' => [
                'required' => 'Judul banner wajib diisi.',
                'min_length' => 'Judul banner minimal 2 karakter.',
                'max_length' => 'Judul banner maksimal 50 karakter.',
            ],
        ],
        'img' => [
            'rules' => 'max_size[img,3124]',
            'errors' => [
                'max_size' => 'Ukuran gambar terlalu besar.',
                'mime_in' => 'Format gambar tidak sesuai. Format harus dalam bentuk jpg/jpeg/png',
            ]
        ],
        'img_konten' => [
            'rules' => 'max_size[img_konten,3124]',
            'errors' => [
                'max_size' => 'Ukuran gambar terlalu besar.',
                'mime_in' => 'Format gambar tidak sesuai. Format harus dalam bentuk jpg/jpeg/png',
            ]
        ]
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
}
