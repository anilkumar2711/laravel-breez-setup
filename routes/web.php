<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\StockTransactionController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{product}/transactions', [ProductController::class, 'transactions'])->name('products.transactions');

    
    Route::get('/transactions', [StockTransactionController::class, 'index'])->name('transactions.index');
    Route::get('/products/{product}/transactions/{transaction}', [StockTransactionController::class, 'show'])->name('products.transactions.show');
    Route::post('/products/{product}/transactions', [StockTransactionController::class, 'store'])->name('products.transactions.store');
    Route::delete('/products/{product}/transactions/{transaction}', [StockTransactionController::class, 'destroy'])->name('products.transactions.destroy');
    Route::get('/products/{product}/transactions/{transaction}/edit', [StockTransactionController::class, 'edit'])->name('products.transactions.edit');
    Route::put('/products/{product}/transactions/{transaction}', [StockTransactionController::class, 'update'])->name('products.transactions.update');
    Route::get('/products/{product}/transactions/create', [StockTransactionController::class, 'create'])->name('products.transactions.create');
    Route::get('/products/{product}/transactions/{transaction}/edit', [StockTransactionController::class, 'edit'])->name('products.transactions.edit');

});

Route::get('/translate/{locale}', function ($locale) {
    session(['locale' => $locale]);
    // dd($locale);
    app()->setLocale($locale);
    if (session()->has('url.intended')) {
        return redirect(session('url.intended'));
    }
    // If no intended URL, redirect to the dashboard or home page
    return redirect()->back();
})->name('locale');

require __DIR__.'/auth.php';
