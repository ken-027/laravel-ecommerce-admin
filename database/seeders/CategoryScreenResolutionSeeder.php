<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryScreenResolutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("
            INSERT INTO `category_screen_resolution` (`id`, `cat_id`, `screen_resolution_name`, `screen_resolution_price`) VALUES
            (1, 17, 'FULL HD', '9'),
            (2, 17, '4K UHD', '8');
        ");
    }
}
