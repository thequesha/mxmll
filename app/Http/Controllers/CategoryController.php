<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /** @var CategoryRepository */
    protected $categories;

    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Display products of a category (slug-bound).
     */
    public function show(Category $category)
    {
        $products = $this->categories->paginateProducts($category, 6);
        return view('category.show', compact('category', 'products'));
    }
}
