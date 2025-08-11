<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    /** @var ProductRepository */
    protected $products;

    public function __construct(ProductRepository $products)
    {
        $this->products = $products;
    }

    /**
     * Display a product (slug-bound).
     */
    public function show(Product $product)
    {
        $product = $this->products->findBySlugWithCategory($product->slug);
        return view('product.show', compact('product'));
    }
}
