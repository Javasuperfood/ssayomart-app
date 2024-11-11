<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Brand extends Seeder
{
    public function run()
    {
        $produkList = $this->db->table('jsf_produk')->get()->getResultArray();

        foreach ($produkList as $produk) {
            $data = [
                'brand' => 'GS'
            ];

            $this->db->table('jsf_produk')
                ->where('id_produk', $produk['id_produk'])
                ->where('brand', null)
                ->update($data);
        }
    }
}
