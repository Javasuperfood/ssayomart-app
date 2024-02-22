<?php

namespace App\Models;

use CodeIgniter\Model;

class PromoModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'jsf_promo';
    protected $primaryKey       = 'id_promo';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title',
        'slug',
        'img',
        'img_2',
        'start_at',
        'end_at',
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
            'rules' => 'required|max_size[img, 1024]',
            'errors' => [
                'max_size' => 'Ukuran gambar terlalu besar.',
            ]
        ],
        'slug'       => 'required',
        'start_at'   => 'required',
        'end_at'     => 'required',
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

    public function getPromo($now)
    {
        return $this->where("'$now' >= start_at AND '$now' <= end_at")
            ->findAll();
    }

    public function getOngoingPromoItems()
    {
        $currentDate = date('Y-m-d H:i:s'); // Waktu saat ini

        $query = $this->table('jsf_promo')
            ->select('jsf_promo.*, jsf_promo.title as promo_title, jsf_produk.nama as produk_nama')
            ->join('jsf_promo_item', 'jsf_promo.id_promo_item = jsf_promo_item.id_promo')
            ->join('jsf_produk', 'jsf_promo.id_produk = jsf_produk.id_produk')
            ->where('jsf_promo.start_at <=', $currentDate)
            ->where('jsf_promo.end_at >=', $currentDate)
            ->get();

        return $query->getResultArray();
    }
}
