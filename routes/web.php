<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\ResiliencyController;
use \App\Http\Controllers\ListingController;
use \App\Http\Controllers\StoryController;
use \App\Http\Controllers\ProfileController;
use \App\Http\Livewire\FeedList;
use \App\Http\Livewire\ListingList;
use \App\Http\Livewire\StoryList;
use \App\Http\Livewire\ResiliencyList;
use \App\Http\Livewire\StatementList;
use \App\Http\Livewire\Search;
use \App\Http\Livewire\InterestSearch;
use \App\Http\Livewire\CreateStory;
use \App\Http\Livewire\CreateListing;
use \App\Http\Livewire\CreateResiliency;
use \App\Models\Statement;

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
Route::get('/listings',ListingList::class)->name('listings');
Route::get('/stories',StoryList::class)->name('stories');
Route::get('/resiliencies',ResiliencyList::class)->name('resiliencies');
Route::get('/statements',StatementList::class)->name('statements');
Route::get('/categories',[CategoryController::class,'index'])->name('categories');
//create pages
Route::get('/listings/new',CreateListing::class)->middleware(['auth']);
Route::get('/stories/new',CreateStory::class)->middleware(['auth']);
Route::get('/resiliencies/new',CreateResiliency::class)->middleware(['auth']);
Route::get('/categories/new',[CategoryController::class,'create'])->middleware(['auth'])->name('addCategory');

//detail pages
Route::get('/listings/{listing}',[ListingController::class,'show']);
Route::get('/stories/{story}',[StoryController::class,'show']);
Route::get('/profiles/{profile}',[ProfileController::class,'show'])->name('showProfile');
Route::get('/categories/{category}',[CategoryController::class,'show']);
Route::get('/resiliencies/{resiliency}',[ResiliencyController::class,'show']);
Route::get('/statements/{statement}',function(Statement $statement){
    return view('statement',['statement'=>$statement]);
});

//Onboarding
Route::get('/profile',[ProfileController::class,'create'])->middleware(['auth']);
Route::post('/profiles',[ProfileController::class,'store'])->middleware(['auth']);
Route::get('/profile/interests',InterestSearch::class)->middleware(['auth']);




Route::post('/categories',[CategoryController::class,'store']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
require __DIR__.'/auth.php';


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
Route::get('auth/{provider}/redirect',function($provider){
    return Socialite::driver($provider)->redirect();
});
Route::get('auth/{provider}/callback',[AuthenticatedSessionController::class,'providerLogin']);
Route::get('auth/matrix/login',[AuthenticatedSessionController::class,'matrixLogin']);