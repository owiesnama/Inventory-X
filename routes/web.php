<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Route::resource('customers', App\Http\Controllers\CustomersController::class)->only('index', 'store');


Route::middleware(['auth:sanctum'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::view('/items','items.index')->middleware(['auth:sanctum'])->name('items');
Route::view('/customers','customers.index')->middleware(['auth:sanctum'])->name('customers');
Route::view('/warehouses','warehouses.index')->middleware(['auth:sanctum'])->name('warehouses');
Route::get('/warehouses/{warehouse}', \App\Http\Livewire\WarehouseItems::class)->middleware(['auth:sanctum',]);
Route::get('purchasements', \App\Http\Livewire\Purchasements::class)->middleware(['auth:sanctum',])->name('purchasements');        
Route::get('sales', \App\Http\Livewire\SalesInvoices::class)->middleware(['auth:sanctum',])->name('sales');        