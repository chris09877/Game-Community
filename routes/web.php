<?php

use App\Http\Controllers\CreatePostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;



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
Route::get("/login", [\App\Http\Controllers\Auth\LoginController::class, "index"]);

//ROUTE TO CREATE POST
Route::get("/createPost", [App\Http\Controllers\CreatePostController::class,"index"]);
Route::post("/createPost", [App\Http\Controllers\CreatePostController::class, "store"])->name('submitPost');

//ROUTE PROFILE
Route::get("/profile", [App\Http\Controllers\ProfileController::class, "index"])->name('profile');
Route::get("/profile/update/{id}", [App\Http\Controllers\ProfileController::class, "show"])->name('profile.update');
Route::post("/profile/update", [App\Http\Controllers\ProfileController::class, "update"])->name('submitUser');


//ROUTE HOME
Route::get("/home", [App\Http\Controllers\HomeController::class, "index"])->name('home');


// ROUTES FAQ
Route::get("/faq",[App\Http\Controllers\FaqController::class,"index"])->name('faq');
Route::delete('/faq/{id}', [App\Http\Controllers\FaqController::class,"destroy"])->name('faq.destroy');
Route::get('/faq/{id}', [App\Http\Controllers\FaqController::class,"show"])->name('faq.show');
Route::get("/faq/create",[App\Http\Controllers\FaqController::class,"create"])->name('faq.create');
Route::post("/faq/create",[App\Http\Controllers\FaqController::class,"store"])->name('submitFaq');
Route::post("/faq/{id}",[App\Http\Controllers\FaqController::class,"store"])->name('faq.update');



Auth::routes();

//Route::post("/createPost", )
//ROUTE CONTACT 
Route::get('/contact', [App\Http\Controllers\ContactController::class,"index"])->name('contact');
Route::post('/contact', [App\Http\Controllers\ContactController::class,"sendEmail"])->name('sendEmail');



//RESTRICTED ROUTES 
Route::middleware(['auth', 'admin'])->group(function () {
    // ROUTES SETTINGS
    Route::get("/settings", [App\Http\Controllers\SettingsController::class, "index"])->name('settings');
//ROUTE CATEGORIES
    Route::get("/categories", [App\Http\Controllers\CategoryController::class, "index"])->name('category');
    Route::post("/categories", [App\Http\Controllers\CategoryController::class, "store"])->name('category.store');
    Route::post('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');
    Route::delete('/categories/{id}', [App\Http\Controllers\CategoryController::class, 'delete'])->name('category.delete');
});
