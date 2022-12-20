<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProcessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("
            INSERT INTO `category_processor` (`id`, `cat_id`, `processor_name`, `processor_price`) VALUES
            (1, 17, 'INTEL CORE M3', '8'),
            (2, 17, 'INTERL CORE i5', '9'),
            (3, 17, 'INTEL CORE i7', '7'),
            (4, 17, 'INTEL CORE DUO', ''),
            (5, 17, 'INTEL CORE M5', ''),
            (6, 17, 'INTEL CORE M7', ''),
            (18, 87, '4ghz', '0'),
            (19, 88, '4ghz', '0'),
            (20, 88, '4.2ghz', '0');
        ");
    }
}
