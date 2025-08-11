<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function allWithCounts()
    {
        return Category::query()->withCount('products')->orderBy('name')->get();
    }

    public function findBySlugWithProducts(string $slug, int $perPage = 6)
    {
        $category = Category::query()->where('slug', $slug)->firstOrFail();
        $products = $category->products()->orderBy('name')->paginate($perPage);
        return [$category, $products];
    }

    public function paginateProducts(Category $category, int $perPage = 6)
    {
        return $category->products()->orderBy('name')->paginate($perPage);
    }
}
