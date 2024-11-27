<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SortRollback extends Seeder
{
    public function run()
    {
        $this->db->table('jsf_produk')->update(['sort' => null]);
    }
}
