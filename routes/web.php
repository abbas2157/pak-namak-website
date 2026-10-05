<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// Website
Route::controller(SiteController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/shop', 'shop')->name('shop');
    Route::get('/about-us', 'about')->name('about');
    Route::get('/contact-us', 'contact')->name('contact');
    Route::post('/contact-us', 'submitContact')->name('contact.submit')->middleware('throttle:10,1');
});

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
        Route::resource('products', Admin\ProductController::class)->except('show');
        Route::resource('categories', Admin\CategoryController::class)->except('show');
        Route::resource('team', Admin\TeamMemberController::class)->except('show')->parameters(['team' => 'member']);
        Route::resource('faqs', Admin\FaqController::class)->except('show');

        Route::get('settings', [Admin\SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [Admin\SettingController::class, 'update'])->name('settings.update');
        Route::get('account', [Admin\AccountController::class, 'edit'])->name('account.edit');
        Route::put('account', [Admin\AccountController::class, 'update'])->name('account.update');
    });
});
