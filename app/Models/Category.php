<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public const LAYOUTS = [
        'cards' => 'Cards — one card per product',
        'table' => 'Size table — one photo with a row per product',
    ];

    protected $fillable = ['name', 'name_ur', 'slug', 'layout', 'sort_order'];

    public function products(): HasMany
    {
        return $this->hasMany(Product::class)->orderBy('sort_order');
    }
}
