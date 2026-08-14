<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['id' => 1, 'cate_name' => 'Mobile Phones', 'group_cate' => 'Electronics', 'status' => 1],
            ['id' => 2, 'cate_name' => 'Laptops & MacBooks', 'group_cate' => 'Computers', 'status' => 1],
            ['id' => 3, 'cate_name' => 'Accessories', 'group_cate' => 'Accessories', 'status' => 1],
            ['id' => 4, 'cate_name' => 'Tablets & iPads', 'group_cate' => 'Electronics', 'status' => 1],
            ['id' => 5, 'cate_name' => 'PCs & Workstations', 'group_cate' => 'Computers', 'status' => 1],
            ['id' => 6, 'cate_name' => 'Audio & Headphones', 'group_cate' => 'Audio', 'status' => 1],
        ];

        foreach ($categories as $cat) {
            Categories::updateOrCreate(['id' => $cat['id']], $cat);
        }
    }
}
