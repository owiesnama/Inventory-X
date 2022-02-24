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
    return view('welcome');
});


Route::resource('customers', App\Http\Controllers\CustomersController::class)->only('index', 'store');


Route::resource('customers', App\Http\Controllers\CustomersController::class)->only('index', 'store');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::view('/items','items.index')->middleware(['auth:sanctum', 'verified'])->name('items');


Route::middleware(['auth:sanctum', 'verified'])->get('/customers', function () {
    return view('dashboard-customers');
})->name('customers');
Route::middleware(['auth:sanctum', 'verified'])->get('/storage', function () {
    return view('dashboard-storage');
})->name('storage');
