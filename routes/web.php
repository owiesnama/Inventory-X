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


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::view('/items','items.index')->middleware(['auth:sanctum', 'verified'])->name('items');
Route::view('/customers','customers.index')->middleware(['auth:sanctum', 'verified'])->name('customers');
Route::view('/storages','storages.index')->middleware(['auth:sanctum', 'verified'])->name('storages');


Route::get('/storages/{storage}', \App\Http\Livewire\StorageItems::class)->middleware(['auth:sanctum', 'verified']);


