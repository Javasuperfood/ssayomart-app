<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\AuthIdentitesModel;

class UsersModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'username',
        'status',
        'status_message',
        'active',
        'last_active',
        'img',
        'fullname',
        'telp',
        'market_selected',
        'address_selected',
        'uuid'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'username'  => 'required',
        'fullname'  => 'required',
        'telp'      => 'required'
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

    public function getStatus($slug)
    {
        $db = \Config\Database::connect();
        $query = $db->table('jsf_checkout_produk')
            ->select('jsf_checkout_produk.*, jsf_checkout.*, jsf_checkout.id_status_pesan AS pesan_status, jsf_checkout.id_status_kirim AS kirim_status, jsf_produk.*, jsf_status_pesan.status AS pesan_status_text, jsf_status_kirim.status AS kirim_status_text, jsf_checkout.updated_at AS last_update')
            ->join('jsf_checkout', 'jsf_checkout_produk.id_checkout = jsf_checkout.id_checkout')
            ->join('jsf_produk', 'jsf_checkout_produk.id_produk = jsf_produk.id_produk')
            ->join('jsf_status_pesan', 'jsf_checkout.id_status_pesan = jsf_status_pesan.id_status_pesan')
            ->join('jsf_status_kirim', 'jsf_checkout.id_status_kirim = jsf_status_kirim.id_status_kirim')
            ->where('invoice', $slug)
            ->get();

        $result = $query->getResult()[0];
        return $result;
    }
    public function getTransaksi($slug)
    {
        $db = \Config\Database::connect();
        $query = $db->table('jsf_checkout_produk')
            ->select('jsf_checkout_produk.*, jsf_checkout.*, jsf_produk.*, jsf_variasi_item.*')
            ->join('jsf_checkout', 'jsf_checkout_produk.id_checkout = jsf_checkout.id_checkout')
            ->join('jsf_produk', 'jsf_checkout_produk.id_produk = jsf_produk.id_produk')
            ->join('jsf_variasi_item', 'jsf_variasi_item.id_variasi_item = jsf_checkout_produk.id_variasi_item')
            ->where('invoice', $slug)
            ->get();

        $result = $query->getResult();
        return $result;
    }

    public function getEmail($id)
    {
        $db = \Config\Database::connect();
        $query = $db->table('auth_identities')
            ->select('secret')
            ->where('user_id', $id)
            ->get();

        $result = $query->getResultArray()[0]['secret'];
        return $result;
    }

    public function getUserInfo($id)
    {
        $db = \Config\Database::connect();
        $query = $db->table('users')
            ->select('users.username, users.fullname, users.telp, users.img, auth_identities.secret AS email') // Include email from auth_identities
            ->join('auth_identities', 'auth_identities.user_id = users.id', 'inner')
            ->where('users.id', $id)
            ->get();

        $result = $query->getRowArray();
        return $result;
    }

    public function getUserWithRole()
    {
        $query = $this->select('users.id, users.username, auth_groups_users.group')
            ->join('auth_groups_users', 'users.id = auth_groups_users.user_id')
            ->where('auth_groups_users.group', 'admin')
            ->get();
        return $query->getResultArray();
    }

    public function getUser($perPage, $username = null, $isAdmin = false)
    {
        $query = $this->select('*')
            ->join('auth_groups_users', 'users.id = auth_groups_users.user_id');
        if ($isAdmin) {
            $query->where('group', 'admin');
        }

        if ($username != null) {
            $query->like('username', '%' . $username . '%');
        }

        $data = [
            'users'  => $this->paginate($perPage, 'user'),
            'pager' => $this->pager,
        ];
        return $data;
    }

    public function getAdminEmails()
    {
        $userModel = new \App\Models\UsersModel();
        $adminEmails = [];
        $admins = $userModel->getUserWithRole();

        foreach ($admins as $admin) {
            $email = $userModel->getEmail($admin['id']);

            if (!empty($email)) {
                $adminEmails[] = $email;
            }
        }
        return $adminEmails;
    }

    public function getDeviceToken($userId)
    {
        // Sesuaikan dengan struktur tabel Anda
        $user = $this->find($userId);

        // Pastikan user ditemukan dan memiliki kolom device_token
        if ($user && isset($user['uuid'])) {
            return $user['uuid'];
        }

        return null;
    }

    public function getUsersByTransactionStatus($status)
    {
        return $this->db->table('jsf_checkout')
            ->join('users', 'users.id = jsf_checkout.id_user')
            ->where('jsf_checkout.id_status_pesan', $status)
            ->get()
            ->getResultArray();
    }

    // File: UsersModel.php

    public function findUsersByCheckoutStatus()
    {
        $result = $this->db->table('users')
            ->join('jsf_checkout', 'jsf_checkout.id_user = users.id')
            ->where('jsf_checkout.id_status_pesan', 3)
            ->where('jsf_checkout.id_status_kirim', 2)
            ->get();

        if ($result->getNumRows() > 0) {
            return $result->getResultArray();
        } else {
            return false;
        }
    }

    public function saveUserFromAppleID($userData)
    {
        $userToSave = [
            'username' => $userData['username'] ?? '',
            'fullname' => $userData['fullname'] ?? '',
            'telp' => $userData['telp'] ?? '',
            'img' => $userData['img'] ?? '',
            'email' => $userData['email'], // Tambahkan email
            'uuid' => $userData['uuid'] ?? '',
        ];

        $result = $this->insert($userToSave);

        if ($result) {
            $userId = $this->getInsertID();
            $authIdentitiesModel = new AuthIdentitesModel();
            $identityData = [
                'user_id' => $userId,
                'type' => 'email',
                'name' => 'email',
                'secret' => $userData['email'],
            ];

            $authIdentitiesModel->insert($identityData);

            return $userId;
        }
        return false;
    }
}
