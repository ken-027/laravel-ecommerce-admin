<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryScreenSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("
            INSERT INTO `category_screen_size` (`id`, `cat_id`, `screen_size_name`, `screen_size_price`) VALUES
            (5, 67, '23\"', '0'),
            (6, 67, '22\"', '0'),
            (7, 67, '11\"', '0'),
            (34, 79, '23 \"', '0'),
            (35, 17, '11\"', '0'),
            (36, 17, '13\"', '0'),
            (37, 17, '15\"', '0'),
            (38, 17, '17\"', '0');
        ");
    }
}
