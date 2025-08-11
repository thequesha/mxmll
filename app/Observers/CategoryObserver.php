<?php

namespace App\Observers;

use App\Models\Category;
use App\Services\SlugService;

class CategoryObserver
{
    /** @var SlugService */
    protected $slugService;

    public function __construct(SlugService $slugService)
    {
        $this->slugService = $slugService;
    }

    public function creating(Category $category): void
    {
        if (empty($category->slug)) {
            $category->slug = $this->slugService->generateUniqueSlug($category->name, Category::class);
        } else {
            // Normalize provided slug and ensure uniqueness
            $category->slug = $this->slugService->generateUniqueSlug($category->slug, Category::class);
        }
    }

    public function updating(Category $category): void
    {
        // Do not regenerate from name if slug provided; normalize provided slug instead
        if (empty($category->slug)) {
            $category->slug = $this->slugService->generateUniqueSlug($category->name, Category::class, $category->id);
        } else {
            $category->slug = $this->slugService->generateUniqueSlug($category->slug, Category::class, $category->id);
        }
    }
}
