<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogCatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_cats')->insert([
            [
                'catTitle' => 'Newss',
                'catSlug' => 'newss',
            ],
            [
                'catTile' => 'iPhone News',
                'catSlug' => 'iphone-news',
            ],
        ]);
    }
}
