<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StokRollback extends Seeder
{
    public function run()
    {
        $this->db->table('jsf_stock')->where('stok', 1000)->delete();

        echo "Stok seeder data rolled back.";
    }
}
