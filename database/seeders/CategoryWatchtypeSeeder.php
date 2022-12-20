<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryWatchtypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("
            INSERT INTO `category_watchtype` (`id`, `cat_id`, `watchtype_name`, `watchtype_price`, `disabled_network`) VALUES
            (28, 79, 'aloy', '0', 1),
            (31, 13, 'GPS', '0', 0),
            (32, 13, 'GPS + CELLULAR', '0', 1),
            (35, 7, 'WiFi', '0', 0),
            (36, 7, 'WiFi + CELLULAR', '0', 1),
            (37, 17, 'Series 1', '0', 1),
            (38, 17, 'Series 2', '0', 1),
            (39, 17, 'Series 3', '0', 1),
            (40, 17, 'Series 4', '0', 1),
            (41, 17, 'Series 5', '0', 1);
        ");
    }
}
