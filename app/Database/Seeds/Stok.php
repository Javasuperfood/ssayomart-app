<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Stok extends Seeder
{
    public function run()
    {
        $produkList = $this->db->table('jsf_produk')->get()->getResultArray();

        $variasiItem = $this->db->table('jsf_variasi_item')->get()->getRow();

        $toko = $this->db->table('jsf_toko')->get()->getRow();

        if (!$variasiItem || !$toko) {
            echo "No valid id_variasi_item or id_toko found.";
            return;
        }

        foreach ($produkList as $produk) {
            $data = [
                'id_produk'      => $produk['id_produk'],
                'id_variasi_item' => $variasiItem->id_variasi_item,
                'id_toko'        => $toko->id_toko,
                'stok'           => 1000
            ];
            $this->db->table('jsf_stock')->insert($data);
        }
    }
}
