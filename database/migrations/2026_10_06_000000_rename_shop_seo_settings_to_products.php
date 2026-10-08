<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

// The Shop page became Products (/shop -> /products), so carry over any SEO overrides saved under the old route name.
return new class extends Migration
{
    public function up(): void
    {
        $this->rename('seo_shop_', 'seo_products_');
    }

    public function down(): void
    {
        $this->rename('seo_products_', 'seo_shop_');
    }

    private function rename(string $from, string $to): void
    {
        foreach (['title', 'description'] as $field) {
            DB::table('settings')->where('key', $from.$field)->update(['key' => $to.$field]);
        }
        Cache::forget('settings');
    }
};
