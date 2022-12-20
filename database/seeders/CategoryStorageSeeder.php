<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryStorageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("
            INSERT INTO `category_storage` (`id`, `cat_id`, `storage_size`, `storage_size_postfix`, `top_seller`, `storage_price`) VALUES
            (25, 34, 12, 'GB', 1, '0'),
            (26, 34, 1, 'TB', 0, '0'),
            (35, 35, 2, 'GB', 1, '0'),
            (36, 35, 3, 'MB', 1, '0'),
            (122, 79, 23, 'GB', 1, '0'),
            (127, 13, 16, 'GB', 0, '0'),
            (128, 13, 32, 'GB', 0, '0'),
            (129, 13, 64, 'GB', 0, '0'),
            (130, 13, 128, 'GB', 0, '0'),
            (137, 7, 16, 'GB', 0, '0'),
            (138, 7, 32, 'GB', 0, '0'),
            (139, 7, 64, 'GB', 0, '0'),
            (140, 7, 128, 'GB', 0, '0'),
            (141, 7, 256, 'GB', 0, '0'),
            (142, 7, 512, 'GB', 0, '0'),
            (153, 17, 20, 'GB', 0, '0'),
            (154, 17, 20, 'GB', 0, '0'),
            (155, 17, 20, 'TB', 0, '0'),
            (156, 17, 20, 'TB', 0, '0'),
            (157, 17, 20, 'GB', 0, '0'),
            (158, 17, 50, 'GB', 0, '0'),
            (159, 6, 32, 'GB', 0, '0'),
            (160, 6, 64, 'TB', 0, '0'),
            (161, 6, 128, 'GB', 0, '0'),
            (162, 6, 256, 'GB', 0, '0'),
            (163, 6, 512, 'GB', 0, '0');        
        ");
    }
}
