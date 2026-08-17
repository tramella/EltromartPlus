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
        // Execute UserSeeder first so foreign key constraints in BlogSeeder are satisfied
        $this->call([
            UserSeeder::class,
            CategoriesTableSeeder::class,
            BrandsTableSeeder::class,
            ColorsTableSeeder::class,
            ProductsTableSeeder::class,
            BlogSeeder::class,
        ]);
    }
}
