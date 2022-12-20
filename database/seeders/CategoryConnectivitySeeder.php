<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryConnectivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("
            INSERT INTO `category_connectivity` (`id`, `cat_id`, `connectivity_name`, `connectivity_price`) VALUES
            (1, 7, 'Wi-Fi Cellular', '111'),
            (2, 7, 'Wi-Fi Only', '222');
        ");
    }
}
