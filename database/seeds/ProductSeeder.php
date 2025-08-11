<?php

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Option A: use public/placeholder.png via asset()

        $categories = Category::all()->keyBy('name');

        $data = [
            ['Смартфоны', 'Смартфон Яндекс.Телефон 2', 19990],
            ['Смартфоны', 'Смартфон Xiaomi Redmi Note 9', 14990],
            ['Смартфоны', 'Смартфон Samsung Galaxy A52', 25990],
            ['Ноутбуки', 'Ноутбук Lenovo ThinkPad E15', 58990],
            ['Ноутбуки', 'Ноутбук ASUS VivoBook 15', 42990],
            ['Ноутбуки', 'Ноутбук Apple MacBook Air 13', 89990],
            ['Бытовая техника', 'Пылесос Xiaomi Mi Vacuum Cleaner', 9990],
            ['Бытовая техника', 'Микроволновая печь Samsung', 6990],
            ['Бытовая техника', 'Холодильник Atlant 2-камерный', 34990],
            ['Аксессуары', 'Наушники Sony WH-CH510', 3990],
            ['Аксессуары', 'Повербанк Xiaomi 10000 мА·ч', 2490],
            ['Аксессуары', 'Кабель USB-C Baseus', 590],
        ];

        foreach ($data as [$catName, $name, $price]) {
            $category = $categories[$catName] ?? Category::first();
            Product::updateOrCreate(
                ['name' => $name],
                [
                    'category_id' => $category->id,
                    'slug' => '', // observer will fill
                    'price' => $price,
                    'image' => 'placeholder.png',
                    'description' => 'Описание товара: '.$name.'. Качественный и надёжный продукт для ежедневного использования.',
                ]
            );
        }
    }
}
