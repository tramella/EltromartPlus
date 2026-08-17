<?php

namespace Database\Seeders;

use App\Models\Brands;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['id' => 1, 'brand_name' => 'Apple', 'brand_img' => 'AppleLogo.jpg', 'status' => 1],
            ['id' => 2, 'brand_name' => 'Samsung', 'brand_img' => 'Samsung-Logo-06.jpg', 'status' => 1],
            ['id' => 3, 'brand_name' => 'Asus', 'brand_img' => 'LogoAsus.jpg', 'status' => 1],
            ['id' => 4, 'brand_name' => 'Dell', 'brand_img' => 'DellLogo.jpg', 'status' => 1],
            ['id' => 5, 'brand_name' => 'Lenovo', 'brand_img' => 'LevonoLogo.jpg', 'status' => 1],
            ['id' => 6, 'brand_name' => 'Xiaomi', 'brand_img' => 'XiaomiLogo.jpg', 'status' => 1],
            ['id' => 7, 'brand_name' => 'Baseus', 'brand_img' => 'sp1.jpg', 'status' => 1],
            ['id' => 8, 'brand_name' => 'JBL', 'brand_img' => 'sp1.jpg', 'status' => 1],
        ];

        foreach ($brands as $brand) {
            Brands::updateOrCreate(['id' => $brand['id']], $brand);
        }
    }
}
