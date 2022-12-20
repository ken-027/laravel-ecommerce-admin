<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryCaseMaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("
            INSERT INTO `category_case_material` (`id`, `cat_id`, `case_material_name`, `case_material_price`) VALUES
            (24, 79, 'aluminum', '0'),
            (25, 79, 'bronze', '0'),
            (29, 13, 'ALUMINIUM', '0'),
            (30, 13, 'STAINLESS STEEL', '0'),
            (31, 13, 'PLASTIC', '0');
        ");
    }
}
