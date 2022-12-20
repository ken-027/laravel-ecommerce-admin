<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            AffiliateSeeder::class,
            BlogCatsSeeder::class,
            BlogPostSeeder::class,
            BlogPostSeoSeeder::class,
            BlogPostCategorySeeder::class,
            BlogPostCatsSeeder::class,
            BlogPostTagSeeder::class,
            BrandSeeder::class,
            CategoriesSeeder::class,
            CategoriesAccessoriesSeeder::class,
            CategoryCaseMaterialSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
