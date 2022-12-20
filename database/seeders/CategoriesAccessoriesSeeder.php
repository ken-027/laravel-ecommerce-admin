<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesAccessoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("
            INSERT INTO `category_accessories` (`id`, `cat_id`, `accessories_name`, `plus_minus`, `fixed_percentage`, `accessories_price`) VALUES
            (1, 6, 'ORIGINAL BOX', '', '', ''),
            (2, 6, 'HEADPHONES', '', '', ''),
            (3, 6, 'CHARGER', '', '', ''),
            (4, 7, 'ORIGINAL BOX', '', '', '0'),
            (5, 7, 'CHARGER', '', '', '0'),
            (6, 17, 'CHARGER', '', '', '5'),
            (8, 13, 'ORIGINAL BOX', '', '', '0'),
            (9, 17, 'ORIGINAL BOX', '', '', '0'),
            (10, 13, 'CHARGER', '', '', '0'),
            (11, 6, 'PHONE CASE', '', '', ''),
            (12, 7, 'TABLET CASE', '', '', '0'),
            (13, 13, 'EXTRA BANDS', '', '', '0');        
        ");
    }
}
