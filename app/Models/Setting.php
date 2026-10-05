<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function all_cached(): array
    {
        return Cache::rememberForever('settings', fn () => static::pluck('value', 'key')->all());
    }

    public static function get(string $key, ?string $default = null): ?string
    {
        return static::all_cached()[$key] ?? $default;
    }

    public static function put(array $values): void
    {
        foreach ($values as $key => $value) {
            static::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        Cache::forget('settings');
    }
}
