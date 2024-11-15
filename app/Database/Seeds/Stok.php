<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Stok extends Seeder
{
    public function run()
    {
        $produkList = $this->db->table('jsf_produk')->get()->getResultArray();
        $toko = $this->db->table('jsf_toko')->get()->getRow();

        if (!$toko) {
            echo "No valid id_toko found.";
            return;
        }

        foreach ($produkList as $produk) {
            $variasiItem = $this->db->table('jsf_variasi_item')
                ->where('id_produk', $produk['id_produk'])
                ->get()
                ->getRow();

            if (!$variasiItem) {
                echo "No valid id_variasi_item found for id_produk: {$produk['id_produk']}.";
                continue;
            }

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