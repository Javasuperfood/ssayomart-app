<?php

namespace App\Models;

use CodeIgniter\Model;

class BannerPromotionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_banner_promotion';
    protected $primaryKey       = 'id_banner_promotion';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title',
        'img',
        'img_promo',
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
                'mime_in' => 'Format gambar tidak sesuai. iamge/jpg/jpeg/png'
            ]
        ],
        'img_promo' => [
            'rules' => 'max_size[img,3124]',
            'errors' => [
                'max_size' => 'Ukuran gambar terlalu besar.',
                'mime_in' => 'Format gambar tidak sesuai. iamge/jpg/jpeg/png'
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
