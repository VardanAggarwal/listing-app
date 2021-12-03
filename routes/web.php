<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\ResiliencyController;
use \App\Http\Controllers\AgriserviceController;
use \App\Http\Controllers\ListingController;
use \App\Http\Controllers\StoryController;
use \App\Http\Controllers\ProfileController;
use \App\Http\Livewire\FeedList;
use \App\Http\Livewire\CropList;
use \App\Http\Livewire\AgrimodelList;
use \App\Http\Livewire\AgriserviceList;
use \App\Http\Livewire\ListingList;
use \App\Http\Livewire\PracticeList;
use \App\Http\Livewire\StoryList;
use \App\Http\Livewire\Search;
use \App\Http\Livewire\CreateResiliency;

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
//main page
Route::get('/',FeedList::class)->name('feed');
Route::get('/search',Search::class)->name('search');
//listing pages
Route::get('/crops',CropList::class)->name('crops');
Route::get('/agrimodels',AgrimodelList::class)->name('agrimodels');
Route::get('/agriservices',AgriserviceList::class)->name('agriservices');
Route::get('/listings',ListingList::class)->name('listings');
Route::get('/practices',PracticeList::class)->name('practices');
Route::get('/stories',StoryList::class)->name('stories');
Route::get('/categories',[CategoryController::class,'index'])->name('categories');
//create pages
Route::get('/crops/new',CreateResiliency::class)->middleware(['auth']);
Route::get('/agrimodels/new',CreateResiliency::class)->middleware(['auth']);
Route::get('/practices/new',CreateResiliency::class)->middleware(['auth']);
Route::get('/listings/new',[ListingController::class,'create'])->middleware(['auth']);
Route::get('/agriservices/new',[AgriserviceController::class,'create'])->middleware(['auth']);
Route::get('/stories/new',[StoryController::class,'create'])->middleware(['auth']);

//detail pages
Route::get('/crops/{crop}',[ResiliencyController::class,'showCrop']);
Route::get('/practices/{practice}',[ResiliencyController::class,'showPractice']);
Route::get('/agrimodels/{agrimodel}',[ResiliencyController::class,'showAgrimodel']);
Route::get('/agriservices/{agriservice}',[AgriserviceController::class,'show']);
Route::get('/listings/{listing}',[ListingController::class,'show']);
Route::get('/stories/{story}',[StoryController::class,'show']);
Route::get('/profiles/{profile}',[ProfileController::class,'show']);
Route::get('/categories/{category}',[CategoryController::class,'show']);

//Onboarding
Route::get('/profile',[ProfileController::class,'create'])->middleware(['auth']);
Route::post('/profiles',[ProfileController::class,'store'])->middleware(['auth']);
Route::get('/profile/interests',[ProfileController::class,'interests'])->middleware(['auth']);



Route::get('/agrimodel/new',[AgrimodelController::class,'create'])->middleware(['auth'])->name('addAgrimodel');
Route::post('/crops',[CropController::class,'store']);
Route::get('/categories/new',[CategoryController::class,'create'])->middleware(['auth'])->name('addCategory');
Route::post('/categories',[CategoryController::class,'store']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
require __DIR__.'/auth.php';


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
