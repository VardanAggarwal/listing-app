<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CropController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\FeedController;
use \App\Http\Livewire\FeedList;

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

Route::get('/',FeedList::class)->name('feed');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/crops',[CropController::class,'index'])->name('crops');
Route::get('/crops/new',[CropController::class,'create'])->middleware(['auth'])->name('addCrop');
Route::get('/crops/{crop}',[CropController::class,'show']);
Route::post('/crops',[CropController::class,'store']);
Route::get('/categories',[CategoryController::class,'index'])->name('categories');
Route::get('/categories/new',[CategoryController::class,'create'])->middleware(['auth'])->name('addCategory');
Route::get('/categories/{category}',[CategoryController::class,'show']);
Route::post('/categories',[CategoryController::class,'store']);
require __DIR__.'/auth.php';
