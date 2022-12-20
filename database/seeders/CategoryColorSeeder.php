<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("
            INSERT INTO `category_color` (`id`, `cat_id`, `color_name`, `color_code`, `plus_minus`, `fixed_percentage`, `color_price`, `storage_ids`) VALUES
            (4, 6, 'White', '#f34121', '', '', '', ''),
            (5, 6, 'Black', '#678d54', '', '', '', ''),
            (6, 7, 'White', '#ffffff', '', '', '1', ''),
            (7, 7, 'Black', '#000000', '', '', '3', ''),
            (8, 17, 'White', '#eefcfd', '', '', '1', ''),
            (9, 17, 'Blank', '#000000', '', '', '4', ''),
            (10, 13, 'SPACE BLACK', '#000000', '', '', '0', ''),
            (11, 13, 'SPACE GRAY', '#3f4145', '', '', '0', ''),
            (12, 13, 'SAPPHIRE CRYSTAL', '#747474', '', '', '0', ''),
            (13, 13, 'GOLD', '#dfccb7', '', '', '0', ''),
            (14, 13, 'ROSE GOLD', '#e6bec2', '', '', '0', ''),
            (15, 13, 'SILVER', '#ebebe9', '', '', '0', '');
        ");
    }
}
