<?php

namespace Database\Seeders;

use App\Models\Colors;
use Illuminate\Database\Seeder;

class ColorsTableSeeder extends Seeder
{
    public function run(): void
    {
        $colors = [
            ['id' => 1, 'color_name' => 'Titanium Black', 'status' => 1],
            ['id' => 2, 'color_name' => 'Silver Gray', 'status' => 1],
            ['id' => 3, 'color_name' => 'Midnight Blue', 'status' => 1],
            ['id' => 4, 'color_name' => 'Rose Gold', 'status' => 1],
            ['id' => 5, 'color_name' => 'Space White', 'status' => 1],
        ];

        foreach ($colors as $color) {
            Colors::updateOrCreate(['id' => $color['id']], $color);
        }
    }
}
