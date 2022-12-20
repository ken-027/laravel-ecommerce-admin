<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogPostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_post_tag')->insert([
            ['name' => 'General'], 
            ['name' => 'Samsung'],
            ['name' => 'Apple']
        ]);
    }
}
