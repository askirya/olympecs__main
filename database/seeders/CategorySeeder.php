<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Проблемы с компьютером',
            'Проблемы с принтером',
            'Проблемы с программным обеспечением',
            'Другое'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}