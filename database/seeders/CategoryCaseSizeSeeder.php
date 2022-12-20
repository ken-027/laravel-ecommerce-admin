<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryCaseSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("
            INSERT INTO `category_case_size` (`id`, `cat_id`, `case_size`, `case_size_price`) VALUES
            (43, 79, '32', '0'),
            (44, 79, '321', '0'),
            (49, 13, '38 MM', '0'),
            (50, 13, '40 MM', '0'),
            (51, 13, '42 MM', '0'),
            (52, 13, '44 MM', '0');
        ");
    }
}
