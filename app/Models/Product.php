<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    public const PACK_SIZES = ['50g', '100g', '200g', '250g', '500g', '1kg', '2kg', '5kg', '10kg'];

    protected $fillable = ['category_id', 'name', 'name_ur', 'slug', 'description', 'image', 'price', 'pack_sizes', 'is_active', 'sort_order'];

    protected $casts = ['is_active' => 'boolean', 'price' => 'decimal:2', 'pack_sizes' => 'array'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function getImageUrlAttribute(): string
    {
        if (! $this->image) {
            return asset('images/product-placeholder.svg');
        }

        return str_starts_with($this->image, 'images/') ? asset($this->image) : asset('storage/'.$this->image);
    }
}
