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

//ROUTE HOME
Route::get("/home", [App\Http\Controllers\HomeController::class, "index"])->name('home');

//ROUTE CATEGORIES


// ROUTES FAQ
Route::get("/faq",[App\Http\Controllers\FaqController::class,"index"])->name('faq');
Route::delete('/faq/{id}', [App\Http\Controllers\FaqController::class,"destroy"])->name('faq.destroy');
Route::put('/faq/{id}', [App\Http\Controllers\FaqController::class,"show"])->name('faq.show');
Route::get("/faq/create",[App\Http\Controllers\FaqController::class,"create"])->name('faq.create');
Route::post("/faq/create",[App\Http\Controllers\FaqController::class,"store"])->name('submitFaq');


//SETTINGS ROUTE
Route::get("/settings", [App\Http\Controllers\SettingsController::class, "index"])->name('settings');
// Route::get("/updateUser", [App\Http\Controllers\UpdateUserController::class, "index"])->name('updateUser');
// Route::post("/updateUser", [App\Http\Controllers\UpdateUserController::class, "update"])->name('submitUser');

Auth::routes();

//Route::post("/createPost", )


