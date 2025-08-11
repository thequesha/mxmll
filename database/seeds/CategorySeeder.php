<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $names = [
            'Смартфоны',
            'Ноутбуки',
            'Бытовая техника',
            'Аксессуары',
        ];

        foreach ($names as $name) {
            Category::updateOrCreate(
                ['name' => $name],
                ['slug' => Str::slug($name, '-')]
            );
        }
    }
}
