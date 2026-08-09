<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/locale/{locale}', function (string $locale) {
    abort_unless(in_array($locale, ['uk', 'es'], true), 404);
    session(['locale' => $locale]);
    return back();
})->name('locale');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/technology', 'technology')->name('technology');
Route::get('/catalog', [ProductController::class, 'catalog'])->name('catalog');
Route::get('/catalog/{product:slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/dashboard', function () {
    return view('dashboard', [
        'stats' => [
            'products' => \App\Models\Product::count(),
            'categories' => \App\Models\Category::count(),
            'partners' => \App\Models\Partner::count(),
        ],
        'recentProducts' => \App\Models\Product::with('categories')->latest()->take(5)->get(),
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('admin/products', ProductController::class)->except('show')->names('products');
    Route::resource('admin/categories', CategoryController::class)->except('show')->names('categories');
    Route::resource('admin/partners', PartnerController::class)->except('show')->names('partners');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
