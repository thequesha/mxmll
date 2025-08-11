<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        // Ensure placeholder image exists in storage/app/public/products
        $disk = Storage::disk('public');
        $dir = 'products';
        if (!$disk->exists($dir)) {
            $disk->makeDirectory($dir);
        }
        $placeholderPath = $dir.'/placeholder.png';
        if (!$disk->exists($placeholderPath)) {
            $png = base64_decode(
                'iVBORw0KGgoAAAANSUhEUgAAAEAAAAAQCAYAAABYz1ZKAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAtElEQVR4nO2XMQ6CMBBFv9bGQ5p0g7gkFQf8x2h8bI0Q1i7mS6rG1t3nG1k8ZlC8k0bqR1gXyqf6Qp0vT1b8Z9r8oF9p9kU1C8bW1b5CS8Q/4v8R0Z9QkJt2f2nq2uwhvX3kQmO3b0GzX0t9r5FZ8h7Qf4r3yG7KcS1m7k4k1m3p9d2E6w2O1lqLwMZ1eJ3C6uQwqgWk0g9C8y8J3G0Yx1g1s3aP0aQHqg2cN0t0QkV3g0v1nqg2uN4wH7xwS+L4mQ8mU+Y3e0jQ5+qgAAAAAElFTkSuQmCC'
            );
            $disk->put($placeholderPath, $png);
        }

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
                    'image' => $placeholderPath,
                    'description' => 'Описание товара: '.$name.'. Качественный и надёжный продукт для ежедневного использования.',
                ]
            );
        }
    }
}
