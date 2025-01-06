<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware(['guest']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// invoices routes
Route::resource('invoices',InvoiceController::class)->middleware(['auth']);
// sections routes
Route::resource('sections',SectionController::class)->except(['update','destroy'])->middleware(['auth']);
Route::patch('sections/updates',[SectionController::class,'update'])->middleware(['auth']);
Route::delete('sections/destroy',[SectionController::class,'destroy'])->middleware(['auth']);
Route::get('/section/{id}', [InvoiceController::class,'getProducts'])->name('section.getProduct');
//  products routes
Route::resource('products', ProductController::class)->except(['update','destroy'])->middleware(['auth']);
Route::patch('products/updates',[ProductController::class,'update'])->middleware(['auth']);
Route::delete('products/destroy',[ProductController::class,'destroy'])->middleware(['auth']);
// invoices details
Route::get('InvoicesDetails/{id}',[InvoicesDetailsController::class,'edit'])->middleware('auth');
Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'get_file'])->middleware('auth');
Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class,'open_file'])->middleware('auth');
Route::post('delete_file', [InvoicesDetailsController::class,'destroy'])->name('delete_file')->middleware('auth');
// invoices
Route::get('/{page}', [AdminController::class,'index']);