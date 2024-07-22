<?php

use App\Http\Controllers\cartController;
use App\Http\Controllers\catalogController;
use App\Http\Controllers\companyController;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\taxController;
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

    //invoice
    Route::post('/{slug}/invoice', [invoiceController::class, 'store'])->name('invoice.store');
    Route::get('/{slug}/invoice', [invoiceController::class, 'create'])->name('invoice.create');
    Route::get('/invoice/{id}', [invoiceController::class, 'show'])->name('invoice.show');

    //tax
    Route::get('tax/index', [taxController::class, 'index'])->name('tax.index');
    Route::get('/tax/{slug}/create', [taxController::class, 'create'])->name('tax.create');
    Route::post('/tax/{slug}/store', [taxController::class, 'store'])->name('tax.store');
    Route::get('tax/edit/{id}', [taxController::class, 'edit'])->name('tax.edit');
    Route::patch('/tax/update/{id}', [taxController::class, 'update'])->name('tax.update');
    Route::delete('/tax/delete/{id}', [taxController::class, 'destroy'])->name('tax.destroy');
});

require __DIR__.'/auth.php';
