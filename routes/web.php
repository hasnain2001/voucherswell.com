<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\Localization;


Route::get('/', function () {
    return view('welcome');
});
    Route::middleware(['auth','role:user'])->group(function () {
        Route::get('/dashboard', function () { return view('dashboard');})->name('dashboard');

    });
    Route::middleware([Localization::class])->group(function () {
        Route::controller(HomeController::class)->group(function () {
            Route::get('/{lang?}', 'index')->name('home');
            Route::get('/{lang?}/stores', 'stores')->name('stores');
            Route::get('store/{slug}', function($slug) {return app(HomeController::class)->StoreDetails('en', $slug, request());})->name('store.detail');
            Route::get('/{lang}/store/{slug}', [HomeController::class, 'StoreDetails'])->name('store_details.withLang');
            Route::get('{lang?}/category', 'category')->name('category');
            Route::get('/category/{slug}',function($slug) {return app(HomeController::class)->category_detail('en', $slug, request());})->name('category.detail');
        Route::get('{lang?}/category/{slug}', 'category_detail')->name('category.detail.withlang');
            Route::get('{lang?}/coupon', 'coupons')->name('coupons');
            Route::get('{lang?}/deal', 'deal')->name('deals');
            Route::get('{lang?}/coupon/{slug}', 'coupon_detail')->name('coupon.detail');
            Route::get('{lang?}/blog', 'blog')->name('blog');
            Route::get('/blog/{slug}',function($slug) {return app(HomeController::class)->blog_detail('en', $slug, request());})->name('blog.detail');
            Route::get('/{lang}/blog/{slug}', 'blog_detail')->name('blog-details.withLang');
        });
    });
require __DIR__.'/admin.php';
require __DIR__.'/employee.php';
require __DIR__.'/auth.php';
