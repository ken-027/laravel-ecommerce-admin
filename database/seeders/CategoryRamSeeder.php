<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryRamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("
            INSERT INTO `category_ram` (`id`, `cat_id`, `ram_size`, `ram_size_postfix`, `ram_price`) VALUES
            (5, 17, 4, 'GB', '1'),
            (6, 17, 8, 'GB', '2'),
            (7, 17, 16, 'GB', '5'),
            (34, 87, 23, 'GB', '0'),
            (35, 88, 32, 'GB', '0'),
            (36, 88, 6, 'GB', '0');
        ");
    }
}
