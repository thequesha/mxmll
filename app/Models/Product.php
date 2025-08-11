<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'slug', 'price', 'image', 'description'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * Category relation
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
