<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with core ecommerce collection data.
     */
    public function run(): void
    {
        // Execute seeders for categories, brands, colors, products, blogs, and demo users
        $this->call([
            CategoriesTableSeeder::class,
            BrandsTableSeeder::class,
            ColorsTableSeeder::class,
            ProductsTableSeeder::class,
            BlogSeeder::class,
            UserSeeder::class,
        ]);
    }
}
