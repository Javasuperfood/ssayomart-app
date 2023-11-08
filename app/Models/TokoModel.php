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
        'telp2',
        'latitude',
        'longitude',
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
                'required' => 'Deskripsi harus diisi',
            ]
        ],
        'alamat_1' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Alamat harus diisi',
            ]
        ],
        'id_province' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Provinsi harus dipilih',
            ]
        ],
        'id_city' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Kabupaten harus dipilih',
            ]
        ],
        'zip_code' => [
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Kode pos harus diisi',
                'numeric' => 'Kode pos harus berupa angka',
            ]
        ],
        'telp' => [
            'rules' => 'required|numeric',
            'errors' => [
                'required' => 'Nomor telepon harus diisi',
                'numeric' => 'Nomor telepon harus berupa angka',
            ]
        ],
        'telp2' => [
            'rules' => 'permit_empty|numeric',
            'errors' => [
                'numeric' => 'Nomor telepon harus berupa angka',
            ]
        ],
        'latitude' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Lokasi harus diisi',
            ]
        ],
        'longitude' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Lokasi harus diisi',
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
