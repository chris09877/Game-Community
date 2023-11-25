<?php

use App\Http\Controllers\CreatePostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


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
Route::get("/createPost", [App\Http\Controllers\CreatePostController::class,"index"]);
Route::get("/profile", [App\Http\Controllers\ProfileController::class, "index"]);
Route::get("/home", function(){
    return view('home');
});
//sans ca pas de login ni register sur root page
// Route::get('/login', [App\Http\Controllers\HomeController::class])->name("login");
Auth::routes();


//Route::post("/createPost", )


