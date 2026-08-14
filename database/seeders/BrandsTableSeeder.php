<?php

namespace Database\Seeders;

use App\Models\Brands;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['id' => 1, 'brand_name' => 'Apple', 'status' => 1],
            ['id' => 2, 'brand_name' => 'Samsung', 'status' => 1],
            ['id' => 3, 'brand_name' => 'Asus', 'status' => 1],
            ['id' => 4, 'brand_name' => 'Dell', 'status' => 1],
            ['id' => 5, 'brand_name' => 'Lenovo', 'status' => 1],
            ['id' => 6, 'brand_name' => 'Xiaomi', 'status' => 1],
            ['id' => 7, 'brand_name' => 'Baseus', 'status' => 1],
            ['id' => 8, 'brand_name' => 'JBL', 'status' => 1],
        ];

        foreach ($brands as $brand) {
            Brands::updateOrCreate(['id' => $brand['id']], $brand);
        }
    }
}
