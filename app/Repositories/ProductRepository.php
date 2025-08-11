<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function findBySlugWithCategory(string $slug): Product
    {
        return Product::query()->with('category')->where('slug', $slug)->firstOrFail();
    }
}
