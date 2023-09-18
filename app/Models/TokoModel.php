<?php

namespace App\Models;

use CodeIgniter\Model;

class TokoModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_toko';
    protected $primaryKey       = 'id_toko';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_user',
        'deskripsi',
        'alamat_1',
        'alamat_2',
        'id_province',
        'province',
        'id_city',
        'city',
        'zip_code',
        'telp',
        'telp2'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'deskripsi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Deskripsi market harus diisi.',
            ]
        ],
        'alamat_1' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Alamat market harus diisi.',
            ]
        ],
        // 'provinsi' => [
        //     'rules' => 'required',
        //     'errors' => [
        //         'required' => 'provinsi market harus diisi.',
        //     ]
        // ],
        // 'kabupaten' => [
        //     'rules' => 'required',
        //     'errors' => [
        //         'required' => 'Kabupaten market harus diisi.',
        //     ]
        // ],
        'zip_code' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kode Pos market harus diisi.',
            ]
        ],
        'telp' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Telephone market harus diisi.',
            ]
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
}
