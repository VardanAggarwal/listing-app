<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CropController;

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

Route::redirect('/','crops');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/crops',[CropController::class,'index'])->name('crops');
Route::get('/crops/new',[CropController::class,'create'])->name('addCrop');
Route::get('/crops/{crop}',[CropController::class,'show']);
Route::post('/crops',[CropController::class,'store']);
require __DIR__.'/auth.php';
