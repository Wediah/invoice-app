<?php

use App\Http\Controllers\cartController;
use App\Http\Controllers\catalogController;
use App\Http\Controllers\companyController;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\ProfileController;
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

    //company
    Route::get('/company/create', [CompanyController::class, 'create'])->name('company.create');
    Route::post('/company', [CompanyController::class, 'store'])->name('company.store');
    Route::patch('/company', [CompanyController::class, 'update'])->name('company.update');
    Route::delete('/company', [CompanyController::class, 'destroy'])->name('company.destroy');
    Route::get('/show/companies', [CompanyController::class, 'userAndCompany'])->name('company.user');
    Route::get('/company/{slug}', [CompanyController::class, 'show'])->name('company.show');

    //catalog/items
    Route::get('/company/{company_id}/catalog/create', [CatalogController::class, 'create'])->name('catalog.create');
    Route::post('/company/{company_id}/catalog', [CatalogController::class, 'store'])->name('catalog.store');

    Route::post('/{slug}/cart', [CartController::class, 'addToCart'])->name('cart.store');

    Route::get('/{slug}/invoice', [invoiceController::class, 'create'])->name('invoice.create');
});

require __DIR__.'/auth.php';
