<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// Website
Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/products', 'products')->name('products');
    Route::permanentRedirect('/shop', '/products');
    Route::get('/faqs', 'faqs')->name('faqs');
    Route::get('/about-us', 'about')->name('about');
    Route::get('/contact-us', 'contact')->name('contact');
    Route::post('/contact-us', 'submitContact')->name('contact.submit')->middleware('throttle:10,1');
    Route::get('/become-a-dealer', 'dealer')->name('dealer');
    Route::post('/become-a-dealer', 'submitDealer')->name('dealer.submit')->middleware('throttle:5,1');
    Route::get('/privacy-policy', 'privacy')->name('privacy');
    Route::get('/terms', 'terms')->name('terms');
    Route::get('/sitemap.xml', 'sitemap')->name('sitemap');
});

// Old WordPress URLs still in Google's index -> 301 to their new home
foreach (['hello-world', 'category/blog', 'author/paknamak', 'feed', 'comments/feed', 'blog', 'cart', 'checkout', 'my-account'] as $old) {
    Route::permanentRedirect($old, '/');
}
Route::get('wp-content/uploads/{path}', function (string $path) {
    $map = [
        'URDU-Logo' => 'images/logo-480.png',
        'Untitled-design-1' => 'images/hero-bg.jpg',
        'Untitled-design' => 'images/og-image.jpg',
        '50kg' => 'images/salt-50kg.jpeg',
        '10kg' => 'images/salt-10kg.jpeg',
        'WhatsApp-Image-2026-03-11' => 'images/salt-5kg.jpeg',
        'WhatsApp-Image-2025-08-20' => 'images/packet-salt-800.jpg',
        '74413083' => 'images/team-ghazanfar-480.jpg',
        '490994514' => 'images/team-safdar-480.jpg',
        '80218615' => 'images/team-mudassar-480.jpg',
    ];
    foreach ($map as $needle => $target) {
        if (str_contains($path, $needle)) {
            return redirect(asset($target), 301);
        }
    }

    return redirect('/', 301);
})->where('path', '.*');

// Dashboard
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [Admin\AuthController::class, 'showLogin'])->name('login');
        Route::post('login', [Admin\AuthController::class, 'login'])->middleware('throttle:5,1');
    });

    Route::middleware('auth')->group(function () {
        Route::post('logout', [Admin\AuthController::class, 'logout'])->name('logout');
        Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

        Route::resource('inquiries', Admin\InquiryController::class)->only(['index', 'show', 'destroy']);
        Route::resource('dealers', Admin\DealerController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::resource('products', Admin\ProductController::class)->except('show');
        Route::resource('categories', Admin\CategoryController::class)->except('show');
        Route::resource('team', Admin\TeamMemberController::class)->except('show')->parameters(['team' => 'member']);
        Route::resource('faqs', Admin\FaqController::class)->except('show');

        Route::get('seo', [Admin\SeoController::class, 'edit'])->name('seo.edit');
        Route::put('seo', [Admin\SeoController::class, 'update'])->name('seo.update');
        Route::get('settings', [Admin\SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [Admin\SettingController::class, 'update'])->name('settings.update');
        Route::get('account', [Admin\AccountController::class, 'edit'])->name('account.edit');
        Route::put('account', [Admin\AccountController::class, 'update'])->name('account.update');
    });
});
