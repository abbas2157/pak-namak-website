<?php

namespace App\Providers;

use App\Models\DealerApplication;
use App\Models\Inquiry;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::defaultView('admin.partials.pagination');

        View::composer(['layouts.site', 'site.*'], function ($view) {
            $view->with('settings', Schema::hasTable('settings') ? Setting::all_cached() : []);
        });

        View::composer('layouts.admin', function ($view) {
            $view->with([
                'unreadInquiries' => Inquiry::where('is_read', false)->count(),
                'newDealers' => DealerApplication::where('status', 'new')->count(),
            ]);
        });
    }
}
