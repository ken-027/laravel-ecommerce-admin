<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryLyearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("
            INSERT INTO `category_lyear` (`id`, `cat_id`, `lyear_name`, `lyear_price`) VALUES
            (1, 17, 'Early 2015 (MacBook8,1)', '10'),
            (2, 17, 'Early 2016 (MacBook9,1)', '11'),
            (3, 17, '2017 (MacBook10,1)', '12');
        ");
    }
}
