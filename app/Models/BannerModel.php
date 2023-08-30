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
    protected $allowedFields    = ['title', 'img'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'title' => 'required|min_length[2]|max_length[50]',
        'img' => 'max_size[img_profile,3124]|is_image[img_profile]|mime_in[img_profile,image/jpg,image/jpeg,image/png]'
    ];
    protected $validationMessages   = [
        'img' => [
            'max_size' => 'Image size is too large',
            'is_image' => 'What you select is not an image',
            'mime_in' => 'What you select is not an image'
        ]
    ];
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
