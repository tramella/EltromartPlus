<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['id' => 1, 'cate_name' => 'Mobile Phones', 'cate_img' => 'mobilephone.png', 'group_cate' => 'Electronics', 'status' => 1],
            ['id' => 2, 'cate_name' => 'Laptops & MacBooks', 'cate_img' => 'Laptop.png', 'group_cate' => 'Computers', 'status' => 1],
            ['id' => 3, 'cate_name' => 'Accessories', 'cate_img' => 'Accessories.png', 'group_cate' => 'Accessories', 'status' => 1],
            ['id' => 4, 'cate_name' => 'Tablets & iPads', 'cate_img' => 'iPad.png', 'group_cate' => 'Electronics', 'status' => 1],
            ['id' => 5, 'cate_name' => 'PCs & Workstations', 'cate_img' => 'PCs.png', 'group_cate' => 'Computers', 'status' => 1],
            ['id' => 6, 'cate_name' => 'Audio & Headphones', 'cate_img' => 'Services.png', 'group_cate' => 'Audio', 'status' => 1],
        ];

        foreach ($categories as $cat) {
            $cat['slug'] = Str::slug($cat['cate_name']);
            Categories::updateOrCreate(['id' => $cat['id']], $cat);
        }
    }
}
