<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogPostSeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blog_posts_seo')->insert([
            'postTitle' => 'post title',
            'meta_title' => 'meta title',
            'meta_desc' => 'meta description',
            'meta_keywords' => 'meta keywords',
            'postSlug' => 'post-slug',
            'postDesc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo dolore esse quibusdam aspernatur neque repellat labore repudiandae soluta molestiae enim quos, facilis porro, ex veniam vel beatae non dolorum deserunt!',
            'postCont' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo dolore esse quibusdam aspernatur neque repellat labore repudiandae soluta molestiae enim quos, facilis porro, ex veniam vel beatae non dolorum deserunt!',
            'image' => 'MjAyMjAyMjE0Mzc0NA==.png',
            'postDate' => new \DateTime(),
        ]);
    }
}
