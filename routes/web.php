<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\catalogController;
use App\Http\Controllers\companyController;
use App\Http\Controllers\invoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\taxController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //company
    Route::get('/company/create', [CompanyController::class, 'create'])->name('company.create');
    Route::post('/company', [CompanyController::class, 'store'])->name('company.store');
    Route::patch('/company/{slug}/update', [CompanyController::class, 'update'])->name('company.update');
    Route::delete('/company', [CompanyController::class, 'destroy'])->name('company.destroy');
    Route::get('/dashboard', [CompanyController::class, 'userAndCompany'])->name('dashboard');
    Route::get('/company/{slug}', [CompanyController::class, 'show'])->name('company.show');
    Route::patch('/company/{slug}/finance', [CompanyController::class, 'financial'])->name('company.financial');
    Route::patch('/company/{slug}/preference', [CompanyController::class, 'preference'])->name('company.preference');
    //business profile
    Route::get('/{slug}/profile', [CompanyController::class, 'profile'])->name('company.profile');
    Route::patch('/{slug}/info', [CompanyController::class, 'info'])->name('company.info');

    //catalog/items
    Route::get('/company/{company_id}/catalog/create', [CatalogController::class, 'create'])->name('catalog.create');
    Route::post('/company/{company_id}/catalog', [CatalogController::class, 'store'])->name('catalog.store');

    //invoice
    Route::get('/{slug}/all-invoices', [InvoiceController::class, 'index'])->name('invoice.index');
    Route::post('/{slug}/invoice', [invoiceController::class, 'store'])->name('invoice.store');
    Route::get('/{slug}/invoice', [invoiceController::class, 'create'])->name('invoice.create');
    Route::get('/invoice/{id}', [invoiceController::class, 'show'])->name('invoice.show');
    Route::get('/get-price', [invoiceController::class, 'getPrice'])->name('getPrice');
    Route::delete('/invoice/{id}/delete', [invoiceController::class, 'destroy'])->name('invoice.delete');

    //terms of invoice .i.e. the duration of the invoice
    Route::get('{slug}/invoice/terms', [invoiceController::class, 'showTerms'])->name('invoice.show_terms');
    Route::post('{slug}/invoice/create_terms', [invoiceController::class, 'terms'])->name('invoice.store_terms');

    //tax
    Route::get('tax/index', [taxController::class, 'index'])->name('tax.index');
    Route::get('/tax/{slug}/create', [taxController::class, 'create'])->name('tax.create');
    Route::post('/tax/{slug}/store', [taxController::class, 'store'])->name('tax.store');
    Route::get('tax/edit/{id}', [taxController::class, 'edit'])->name('tax.edit');
    Route::patch('/tax/update/{id}', [taxController::class, 'update'])->name('tax.update');
    Route::delete('/tax/delete/{id}', [taxController::class, 'destroy'])->name('tax.destroy');

    //download Invoice
    Route::get('/download-pdf/{id}', [invoiceController::class, 'downloadPDF'])->name('invoice.download_pdf');
});

require __DIR__.'/auth.php';
