<?php

namespace App\Observers;

use App\Models\Product;
use App\Services\SlugService;

class ProductObserver
{
    /** @var SlugService */
    protected $slugService;

    public function __construct(SlugService $slugService)
    {
        $this->slugService = $slugService;
    }

    public function creating(Product $product): void
    {
        if (empty($product->slug)) {
            $product->slug = $this->slugService->generateUniqueSlug($product->name, Product::class);
        } else {
            // Normalize provided slug and ensure uniqueness
            $product->slug = $this->slugService->generateUniqueSlug($product->slug, Product::class);
        }
    }

    public function updating(Product $product): void
    {
        // Do not regenerate from name if slug provided; normalize provided slug instead
        if (empty($product->slug)) {
            $product->slug = $this->slugService->generateUniqueSlug($product->name, Product::class, $product->id);
        } else {
            $product->slug = $this->slugService->generateUniqueSlug($product->slug, Product::class, $product->id);
        }
    }
}
