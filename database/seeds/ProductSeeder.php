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
            // Смартфоны (12)
            ['Смартфоны', 'Смартфон Xiaomi Redmi Note 12', 19990],
            ['Смартфоны', 'Смартфон Xiaomi Redmi Note 12 Pro', 25990],
            ['Смартфоны', 'Смартфон Samsung Galaxy A34', 27990],
            ['Смартфоны', 'Смартфон Samsung Galaxy A54', 34990],
            ['Смартфоны', 'Смартфон Samsung Galaxy S21 FE', 44990],
            ['Смартфоны', 'Смартфон realme 10', 17990],
            ['Смартфоны', 'Смартфон POCO X5 Pro', 27990],
            ['Смартфоны', 'Смартфон Apple iPhone SE (2022)', 49990],
            ['Смартфоны', 'Смартфон Apple iPhone 11 64GB', 55990],
            ['Смартфоны', 'Смартфон HUAWEI P Smart 2021', 16990],
            ['Смартфоны', 'Смартфон Nokia G21', 12990],
            ['Смартфоны', 'Смартфон Tecno Spark 10', 11990],
            // Ноутбуки (12)
            ['Ноутбуки', 'Ноутбук Lenovo ThinkPad E15', 58990],
            ['Ноутбуки', 'Ноутбук Lenovo IdeaPad 3 15', 42990],
            ['Ноутбуки', 'Ноутбук ASUS VivoBook 15', 42990],
            ['Ноутбуки', 'Ноутбук ASUS TUF Gaming F15', 84990],
            ['Ноутбуки', 'Ноутбук Acer Aspire 5', 41990],
            ['Ноутбуки', 'Ноутбук HP Pavilion 15', 52990],
            ['Ноутбуки', 'Ноутбук Dell Inspiron 15', 49990],
            ['Ноутбуки', 'Ноутбук MSI Modern 14', 57990],
            ['Ноутбуки', 'Ноутбук Apple MacBook Air 13', 89990],
            ['Ноутбуки', 'Ноутбук Apple MacBook Pro 13', 119990],
            ['Ноутбуки', 'Ноутбук HUAWEI MateBook D14', 54990],
            ['Ноутбуки', 'Ноутбук Xiaomi RedmiBook 15', 46990],
            // Бытовая техника (12)
            ['Бытовая техника', 'Пылесос Xiaomi Mi Vacuum Cleaner', 9990],
            ['Бытовая техника', 'Микроволновая печь Samsung', 6990],
            ['Бытовая техника', 'Холодильник Atlant 2-камерный', 34990],
            ['Бытовая техника', 'Стиральная машина LG Direct Drive', 32990],
            ['Бытовая техника', 'Электрический чайник Bosch', 2990],
            ['Бытовая техника', 'Утюг Philips', 3490],
            ['Бытовая техника', 'Кофеварка De\'Longhi', 12990],
            ['Бытовая техника', 'Мультиварка Redmond', 6990],
            ['Бытовая техника', 'Блендер Braun', 5990],
            ['Бытовая техника', 'Тостер Tefal', 3990],
            ['Бытовая техника', 'Увлажнитель воздуха Xiaomi Mi', 6990],
            ['Бытовая техника', 'Посудомоечная машина Bosch', 44990],
            // Аксессуары (12)
            ['Аксессуары', 'Наушники Sony WH-CH510', 3990],
            ['Аксессуары', 'Повербанк Xiaomi 10000 мА·ч', 2490],
            ['Аксессуары', 'Кабель USB-C Baseus', 590],
            ['Аксессуары', 'Флешка SanDisk 64GB', 990],
            ['Аксессуары', 'Карта памяти Samsung EVO 128GB', 1590],
            ['Аксессуары', 'Мышь Logitech M185', 1290],
            ['Аксессуары', 'Клавиатура A4Tech KV-300H', 1490],
            ['Аксессуары', 'Беспроводная зарядка Anker', 2990],
            ['Аксессуары', 'Чехол для смартфона', 790],
            ['Аксессуары', 'Защитное стекло 2.5D', 490],
            ['Аксессуары', 'USB‑Hub Orico 4‑port', 1990],
            ['Аксессуары', 'Рюкзак для ноутбука Xiaomi', 2990],
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
